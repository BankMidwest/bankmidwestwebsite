<?php
require_once("functions-typeregistration.php");

// Custom query vars
function bankmidwest_query_vars_event($qVars)
{
	$qVars[] = "event_filter"; // presented as string
	$qVars[] = "start_date"; // presented as unix timestamp
	$qVars[] = "end_date";	// presented as unix timestamp

	return $qVars;
}
add_filter('query_vars', 'bankmidwest_query_vars_event');

function amend_views($views)
{
	global $wp_query;
	if(!is_array($views))
	{
		$views = array();
	}

	if(isset($wp_query->query_vars['event_filter']) && $wp_query->query_vars['event_filter'] == "upcoming")
	{
		$newviews = array();
		// change our "selected" filter to this new one, and remove it from "all"
		foreach($views as $k => $v)
		{
			$newviews[$k] = preg_replace("/current/", "", $views[$k]);
		}
		$newviews["upcoming"] = "<a href=\"edit.php?post_status=publish&post_type=event&event_filter=upcoming\" class=\"current\">Upcoming</a>";

		$views = $newviews;
	}
	else
	{
		$views["upcoming"] = "<a href=\"edit.php?post_status=publish&post_type=event&event_filter=upcoming\">Upcoming</a>";
	}

	return $views;
}
add_filter("views_edit-event", "amend_views");

// This next part is responsible for manipulating the archive-events query.  We ONLY want to touch that one...
function fh_augment_events_query($query)
{
	if((($query->is_post_type_archive && $query->query['post_type'] == "event")
			|| ($query->is_archive && isset($query->query["event_categories"])))
		&& (
			!is_admin() 
			|| isset($query->query["event_filter"]))
		)
	{
		// Modify the query to support comparison against current date
		$today = strtotime(date("Y-m-d"));
		$tomorrow = ($today + (3600 * 24) - 1) . "000"; // One second shy of 24 hrs later...
		$today = $today . "000";

		$start_default = time();
		if(isset($query->query_vars["start_date"]) && is_numeric($query->query_vars["start_date"]))
		{
			$start_default = $query->query_vars["start_date"];
		}

		$end_default = $start_default;
		if(isset($query->query_vars["end_date"]) && is_numeric($query->query_vars["end_date"]))
		{
			$end_default = $query->query_vars["end_date"];
		}

		$first_of_month = strtotime(date("Y-m", $start_default) . "-01");
		if(intval(date("m", $start_default)) == 12)
		{
			$first_next_month = strtotime((date("Y", $start_default) + 1) . "-01-01");
		}
		else
		{
			$first_next_month = strtotime(date("Y-", $start_default) . (date("m", $start_default) + 1) . "-01");
		}

		// "upcoming" is the default filter for the events archive:
		if((!isset($query->query['event_filter']) && !is_admin()) || (isset($query->query['event_filter']) && $query->query['event_filter'] == "upcoming"))
		{
			$meta_query = array(
				'relation' => 'OR',
				array(
					'key' => slt_cf_field_key("event_date"),
					'value' => $today,
					'type' => "NUMERIC",
					'compare' => '>='
				),
				array(
					'key' => slt_cf_field_key("end_date"),
					'value' => $today,
					'type' => "NUMERIC",
					'compare' => '>='
				)
			);
			$query->query_vars['meta_query'] = $meta_query;
			// Affect our sort order here:
			add_filter('posts_clauses', "fh_events_posts_clauses");
		}
		else if($query->query['event_filter'] == "month")
		{
			// Prepare some parameters for use:
			$query->query_vars["_search_start"] = $first_of_month;
			$query->query_vars["_search_end"] = $first_next_month;

			// Getting a bit more aggressive here.  Going to completely modify the WHERE and JOIN clauses.
			add_filter("posts_clauses", "fh_events_search_clauses", 10, 2);
		}
		else if($query->query['event_filter'] == "range")
		{
			$start_date = time();
			if(isset($query->query_vars["start_date"]) && is_numeric($query->query_vars["start_date"]))
			{
				$start_date = $query->query_vars["start_date"];
			}
			$end_date = $start_date;
			if(isset($query->query_vars["end_date"]) && is_numeric($query->query_vars["end_date"]))
			{
				$end_date = $query->query_vars["end_date"];
				if($end_date <= $start_date)
				{
					$end_date = $start_date;
				}
			}

			// Temporary fix: add a day, minus a second, to the end date to get through the day:
			$end_date += (24*3600) - 1;

			$query->query_vars["_search_start"] = $start_date;
			$query->query_vars["_search_end"] = $end_date;

			// Getting a bit more aggressive here.  Going to completely modify the WHERE and JOIN clauses.
			add_filter("posts_clauses", "fh_events_search_clauses", 10, 2);
		}
	}
}
add_action("pre_get_posts", "fh_augment_events_query");

// The following will rewrite our SQL to a custom WHERE clause, because we can't have our two event date comparisons line up
// with an out-of-the-box WP_Query orderby without adversely affecting the results returned.  Obligatory regex here, since
// we can't be certain what SQL will be generated in the JOIN/WHERE clauses until runtime.
function fh_events_posts_clauses($obj)
{
	// Figure out which join has our event date.  could be wp_postmeta, could be mt1, who knows?  Pregger does:
	if(preg_match("/\b(?P<alias>[a-zA-Z_0-9]+)\.meta_key = '_slt_event_date'/", $obj['where'], $matches))
	{

		// Sort order is first by event date (ascending), and then by post title (ascending).
		$obj['orderby'] = "{$matches['alias']}.meta_value ASC, wp_posts.post_title ASC";
		$obj['where'] .= " AND {$matches['alias']}.meta_key = '_slt_event_date'";

		if(preg_match("/\b(?P<alias>[a-zA-Z_0-9]+)\.meta_key = '_slt_end_date'/", $obj['where'], $matches2))
		{
			//$obj['where'] .= " AND {$GLOBALS['fhmq_W']} > CASE WHEN {$matches['alias']} > {$matches2['alias']} THEN {";
		}
		else
		{
			$obj['where'] .= " AND {$matches['alias']}.meta_value < {$GLOBALS['fhmq_W']}";
		}

		/**** Including for sanity purposes.  Currently using above logic instead.
		// Sort order is first by event date (ascending), and then by menu order (ascending).
		$obj['orderby'] = "{$matches['alias']}.meta_value ASC, wp_posts.menu_order ASC";
		*/
	}
	return $obj;
}

function fh_events_search_clauses($obj, $query)
{
	global $wpdb;

	// Creating add'l joins for start and end date.  Not taking time of day into account in this one, since it's not implemented as strict UNIX time.
	$join = sprintf(<<<SQL
		INNER JOIN $wpdb->postmeta mDate
			ON {$wpdb->posts}.ID = mDate.post_id
				AND mDate.meta_key = '%s'
				AND CEIL(mDate.meta_value) > 0
		/*
		LEFT JOIN $wpdb->postmeta mTime
			ON {$wpdb->posts}.ID = mTime.post_id
				AND mTime.meta_key = '%s'
		*/
		LEFT JOIN $wpdb->postmeta mEndDate
			ON {$wpdb->posts}.ID = mEndDate.post_id
				AND mEndDate.meta_key = '%s'
				AND CEIL(mEndDate.meta_value) > 0
				AND CEIL(mEndDate.meta_value) > CEIL(mDate.meta_value)
		/*
		LEFT JOIN $wpdb->postmeta mEndTime
			ON {$wpdb->posts}.ID = mEndTime.post_id
				AND mEndTime.meta_key = '%s'
		*/
SQL
		, slt_cf_field_key("event_date")
		, slt_cf_field_key("event_time")
		, slt_cf_field_key("end_date")
		, slt_cf_field_key("end_time")
	);

	/* It takes 4 checks to confirm a match:
	 *	Assuming search start and end are s' and s"
	 *	Assuming event start and end are e' and e"
	 * s1: s' <= e' <= s"
	 * s2: s' <= e" <= s"
	 * s3: e' <= s' <= s" <= e"
	 * s4: s' <= e' <= e" <= s"
	 */

	// Assuming that if end date is not present that we just treat it as start date.
	$u_start = $query->query_vars["_search_start"];
	$u_end = $query->query_vars["_search_end"];
	$where = sprintf(<<<SQL
		AND (
			CEIL(mDate.meta_value) BETWEEN %d000 AND %d000
			OR CEIL(COALESCE(mEndDate.meta_value, mDate.meta_value)) BETWEEN %d000 and %d000
			OR (
				CEIL(mDate.meta_value) <= %d000
				AND CEIL(COALESCE(mEndDate.meta_value, mDate.meta_value)) >= %d000
			)
			OR (
				CEIL(mDate.meta_value) >= %d000
				AND CEIL(COALESCE(mEndDate.meta_value, mDate.meta_value)) <= %d000
			)
		)
SQL
		, $u_start, $u_end	// BETWEEN %d AND %d
		, $u_start, $u_end	// BETWEEN %d AND %d
		, $u_start		// %d >= CAST(mDate.meta_value AS UNSIGNED)
		, $u_end		// AND %d <= CAST(COALESCE(mEndDate.meta_value, mDate.meta_value) AS UNSIGNED) + 86399
		, $u_start		// %d <= CAST(mDate.meta_value AS UNSIGNED
		, $u_end		// AND %d >= CAST(COALESCE(mEndDate.meta_value, mDate.meta_value) AS UNSIGNED) + 86399
	);
	$obj["orderby"] = "mDate.meta_value ASC, {$wpdb->posts}.post_title ASC";
	$obj["where"] .= $where;
	$obj["join"] .= $join;


	// Done:
	return $obj;
}

/**
	CUSTOM REWRITE RULES:
 */
add_action("generate_rewrite_rules", "add_event_rewrite_rules");
function add_event_rewrite_rules()
{
	global $wp_rewrite;

	$addl = array(
		"events/page/([0-9]+)/?" => "index.php?post_type=event&paged=".$wp_rewrite->preg_index(1),
		"events/([^/]+)(/page/([0-9]+))?/?" => "index.php?post_type=event&event_categories=".$wp_rewrite->preg_index(1)."&paged=".$wp_rewrite->preg_index(3),
	);
	$wp_rewrite->rules = $addl + $wp_rewrite->rules;
}

add_action( 'init', 'register_cpt_event' );
function register_cpt_event() {

	$labels = array( 
		'name' => _x( 'Events', 'event' ),
		'singular_name' => _x( 'Event', 'event' ),
		'add_new' => _x( 'Add New', 'event' ),
		'add_new_item' => _x( 'Add New Event', 'event' ),
		'edit_item' => _x( 'Edit Event', 'event' ),
		'new_item' => _x( 'New Event', 'event' ),
		'view_item' => _x( 'View Event', 'event' ),
		'search_items' => _x( 'Search Events', 'event' ),
		'not_found' => _x( 'No events found', 'event' ),
		'not_found_in_trash' => _x( 'No events found in Trash', 'event' ),
		'parent_item_colon' => _x( 'Parent Event:', 'event' ),
		'menu_name' => _x( 'Events', 'event' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => 'events',
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'event'
	);

	register_post_type( 'event', $args );
	register_taxonomy_event_categories();
	//register_taxonomy_event_tags();

	// Verify capabilities
	fh_register_capabilities('event');
}
function register_taxonomy_event_categories() 
{
	$labels = array( 
		'name' => _x( 'Event Category', 'event_categories' ),
		'singular_name' => _x( 'Event Category', 'event_categories' ),
		'search_items' => _x( 'Search Event Categories', 'event_categories' ),
		'popular_items' => _x( 'Popular Event Categories', 'event_categories' ),
		'all_items' => _x( 'All Event Categories', 'event_categories' ),
		'parent_item' => _x( 'Parent Event Category', 'event_categories' ),
		'parent_item_colon' => _x( 'Parent Event Category:', 'event_categories' ),
		'edit_item' => _x( 'Edit Event Category', 'event_categories' ),
		'update_item' => _x( 'Update Event Category', 'event_categories' ),
		'add_new_item' => _x( 'Add New Event Category', 'event_categories' ),
		'new_item_name' => _x( 'New Event Category Name', 'event_categories' ),
		'separate_items_with_commas' => _x( 'Separate Event Categories with commas', 'event_categories' ),
		'add_or_remove_items' => _x( 'Add or remove Event Categories', 'event_categories' ),
		'choose_from_most_used' => _x( 'Choose from the most used Event Categories', 'event_categories' ),
		'menu_name' => _x( 'Event Category', 'event_categories' )
	);

	$args = array( 
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => false,
		'hierarchical' => true,
		'rewrite' => true,
		'query_var' => true
	);

	register_taxonomy( 'event_categories', array('event'), $args );
}

function register_taxonomy_event_tags() {

	$labels = array( 
		'name' => _x( 'Event Tags', 'event_tag' ),
		'singular_name' => _x( 'Event Tags', 'event_tag' ),
		'search_items' => _x( 'Search Event Tags', 'event_tag' ),
		'popular_items' => _x( 'Popular Event Tags', 'event_tag' ),
		'all_items' => _x( 'All Event Tags', 'event_tag' ),
		'parent_item' => _x( 'Parent Event Tag', 'event_tag' ),
		'parent_item_colon' => _x( 'Parent Event Tag:', 'event_tag' ),
		'edit_item' => _x( 'Edit Event Tag', 'event_tag' ),
		'update_item' => _x( 'Update Event Tag', 'event_tag' ),
		'add_new_item' => _x( 'Add New Event Tag', 'event_tag' ),
		'new_item_name' => _x( 'New Event Tag Name', 'event_tag' ),
		'separate_items_with_commas' => _x( 'Separate event tags with commas', 'event_tag' ),
		'add_or_remove_items' => _x( 'Add or remove event tags', 'event_tag' ),
		'choose_from_most_used' => _x( 'Choose from the most used event tags', 'event_tag' ),
		'menu_name' => _x( 'Event Tags', 'event_tag' )
	);

	$args = array( 
		'labels' => $labels,
		'public' => false,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => false,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'event-tags'),
		'query_var' => false
	);

	register_taxonomy( 'event_tag', array('event'), $args );
}

add_action( 'admin_head', 'event_cpt_icons' );
function event_cpt_icons() {
    ?>
<style type="text/css" media="screen">
	#menu-posts-event .wp-menu-image {
		background: url('<?php bloginfo('stylesheet_directory') ?>/images/icon-cpt-event2.png') no-repeat 7px -18px !important;
	}
	#menu-posts-event:hover .wp-menu-image, #menu-posts-event.wp-has-current-submenu .wp-menu-image {
		background-position: 7px 6px !important;
	}
</style>
<?php }

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_event_details',
		'title' => 'Event Details',
		'fields' => array(
			array(
				'name' => 'event_date',
				'datepicker_format' => 'mm/dd/yy',
				'label' => 'Event Date (start)',
				'description' => 'Provides the date of the event',
				'scope' => array('event'),
				'type' => 'date',
				'capabilities' => array('edit_events')
			),
			array(
				'name' => 'end_date',
				'datepicker_format' => 'mm/dd/yy',
				'label' => 'Event Date (end)',
				'description' => 'Provides the end date of the event [optional]',
				'scope' => array('event'),
				'type' => 'date',
				'capabilities' => array('edit_events')
			),
			array(
				'name' => 'event_time',
				'label' => 'Event Time of Day ',
				'description' => 'Free-form entry for time of day. Example: "10 AM"',
				'scope' => array('event'),
				'type' => 'text',
				'capabilities' => array('edit_events')
			),
			array(
				'name' => 'event_location',
				'label' => 'Event Location City/State',
				'description' => 'Enter the City/State of the event here.',
				'scope' => array('event'),
				'type' => 'text',
				'capabilities' => array('edit_events')
			),
			array(
				'name' => 'event_venue',
				'label' => 'Event Location Venue',
				'description' => 'Enter the location venue of the event here.',
				'scope' => array('event'),
				'type' => 'text',
				'capabilities' => array('edit_events')
			),
			array(
				'name' => 'event_description',
				'label' => 'Event description',
				'description' => 'This will be the description for the Event that shows up in the index page.',
				'scope' => array('event'),
				'type' => 'wysiwyg',
				'capabilities' => array('edit_events')
			),
			array(
				'name' => 'event_admission',
				'label' => 'Admission Details',
				'description' => 'This is additional information for admission that will show up on the listing page underneath the thumbnail.',
				'scope' => array('event'),
				'type' => 'wysiwyg',
				'capabilities' => array('edit_events')
			),
			array(
				'name' => 'eventespresso_link',
				'label' => 'Event Espresso Link',
				'description' => 'A link to the Event Espresso page',
				'scope' => array('event'),
				'type' => 'text',
				'capabilities' => array('edit_events')
			)

/*
			array(
				'name' => 'event_time',
				'label' => 'Event time',
				'description' => 'Free-form entry for time of day',
				'scope' => array('event'),
				'type' => 'text',
				'capabilities' => array('edit_events')
			),*/
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'event', "Developer's Custom Fields 0.7+");
}

?>