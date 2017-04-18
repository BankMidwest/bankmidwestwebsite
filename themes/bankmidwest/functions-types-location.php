<?php 
require_once("functions-typeregistration.php");

// Custom query vars
function bankmidwest_query_vars_location($qVars)
{
	$qVars[] = "selected_location"; // presented as string

	return $qVars;
}
add_filter('query_vars', 'bankmidwest_query_vars_location');


/* The goal of the following is to determine
 * whether a modification/creation (w/ respect to
 * location post type) has taken place.  If so,
 * let's create us a fresh set of KML files. */
add_action("wp_insert_post", "location_cache_refactor");
function location_cache_refactor($post_id)
{
	if($post_id)
	{
		$p = get_post($post_id);
		if($p->post_type === "location")
		{
			do_update_cache();
		}
	}
}

function do_update_cache()
{
	global $wpdb;

	$q = <<<SQL
		SELECT ta.taxonomy, t.term_id
			FROM wp_terms t
				INNER JOIN wp_term_taxonomy ta
					ON t.term_id = ta.term_id
				INNER JOIN wp_term_relationships rel
					ON rel.term_taxonomy_id = ta.term_taxonomy_id
				INNER JOIN wp_posts p
					ON p.ID = rel.object_id
			WHERE ta.taxonomy IN ('location_types'/*, 'location_categories'*/)
			GROUP BY ta.taxonomy, t.term_id;
SQL
	;
	$res = $wpdb->get_results($q);
	foreach($res as $term)
	{
		$filename = sprintf("%s/KML/maps-cat%d.xml", dirname(__FILE__), $term->term_id);
		$contents = kml_render_document_by_category($term->term_id);
		file_put_contents($filename, $contents);
	}
}

add_action( 'init', 'register_cpt_location' ,1);
function register_cpt_location() {

	$labels = array( 
		'name' => _x( 'Locations', 'location' ),
		'singular_name' => _x( 'Location', 'location' ),
		'add_new' => _x( 'Add New', 'location' ),
		'add_new_item' => _x( 'Add New Location', 'location' ),
		'edit_item' => _x( 'Edit Location', 'location' ),
		'new_item' => _x( 'New Location', 'location' ),
		'view_item' => _x( 'View Location', 'location' ),
		'search_items' => _x( 'Search Locations', 'location' ),
		'not_found' => _x( 'No locations found', 'location' ),
		'not_found_in_trash' => _x( 'No locations found in Trash', 'location' ),
		'parent_item_colon' => _x( 'Parent Location:', 'location' ),
		'menu_name' => _x( 'Locations', 'location' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array( 'title', 'thumbnail' ),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'location'
	);

	register_post_type( 'location', $args );

	// Verify capabilities
	fh_register_capabilities('location');
	//register_taxonomy_location_categories();
	register_taxonomy_location_types();
}

function register_taxonomy_location_categories() {

	$labels = array( 
		'name' => _x( 'Location Categories', 'location_categories' ),
		'singular_name' => _x( 'Location Category', 'location_categories' ),
		'search_items' => _x( 'Search Location categories', 'location_categories' ),
		'popular_items' => _x( 'Popular Location categories', 'location_categories' ),
		'all_items' => _x( 'All Location categories', 'location_categories' ),
		'parent_item' => _x( 'Parent Location Category', 'location_categories' ),
		'parent_item_colon' => _x( 'Parent Location Category:', 'location_categories' ),
		'edit_item' => _x( 'Edit Location Category', 'location_categories' ),
		'update_item' => _x( 'Update Location Category', 'location_categories' ),
		'add_new_item' => _x( 'Add New Location Category', 'location_categories' ),
		'new_item_name' => _x( 'New Location Category Name', 'location_categories' ),
		'separate_items_with_commas' => _x( 'Separate Location categories with commas', 'location_categories' ),
		'add_or_remove_items' => _x( 'Add or remove Location categories', 'location_categories' ),
		'choose_from_most_used' => _x( 'Choose from the most used Location categories', 'location_categories' ),
		'menu_name' => _x( 'Location Categories', 'location_categories' ),
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

	register_taxonomy( 'location_categories', array('location'), $args );
}

function register_taxonomy_location_types() {

	$labels = array( 
		'name' => _x( 'Location Types', 'location_types' ),
		'singular_name' => _x( 'Location Type', 'location_types' ),
		'search_items' => _x( 'Search location types', 'location_types' ),
		'popular_items' => _x( 'Popular location types', 'location_types' ),
		'all_items' => _x( 'All location types', 'location_types' ),
		'parent_item' => _x( 'Parent Location Type', 'location_types' ),
		'parent_item_colon' => _x( 'Parent Location Type:', 'location_types' ),
		'edit_item' => _x( 'Edit Location Type', 'location_types' ),
		'update_item' => _x( 'Update Location Type', 'location_types' ),
		'add_new_item' => _x( 'Add New Location Type', 'location_types' ),
		'new_item_name' => _x( 'New Location Type Name', 'location_types' ),
		'separate_items_with_commas' => _x( 'Separate location types with commas', 'location_types' ),
		'add_or_remove_items' => _x( 'Add or remove location types', 'location_types' ),
		'choose_from_most_used' => _x( 'Choose from the most used location types', 'location_types' ),
		'menu_name' => _x( 'Location Types', 'location_types' ),
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

	register_taxonomy( 'location_types', array('location'), $args );
}

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',
		'id' => 'location_summary',
		'context' => 'normal',
		'priority' => 'high',
		'title' => 'Location Summary',
		'fields' => array(
			array(
				'name' => 'address',
				'label' => 'Address',
				'scope' =>  array( 'location' ),
				'type' => 'textarea'
			),
			array(
				'name' => 'phone',
				'label' => 'Phone',
				'scope' =>  array( 'location' ),
				'type' => 'text'
			),
			array(
				'name' => 'fax',
				'label' => 'Fax',
				'scope' =>  array( 'location' ),
				'type' => 'text'
			),
			array(
				"name" => "email",
				"label" => "Location Email Address",
				"scope" => array("location"),
				"type" => "text"
			),
			array(
				'name' => 'marker_coords',
				'label' => 'Map Marker',
				'scope' =>  array( 'location' ),
				'type' => 'gmap',
				'default' => array(
					'centre_latlng' => '41.58383,-93.643088',	// Iowa
					'marker_latlng' => '41.58383,-93.643088',	// Iowa
					'bounds_ne' => '46.325326,-82.656759',
					'bounds_sw' => '36.466816,-104.629416',
					'zoom' => 6
				)
			)
		)
	));
	slt_cf_register_box(array(
		'type' => 'post',
		'id' => 'location_hours',
		'context' => 'normal',
		'priority' => 'high',
		'title' => 'Location Hours',
		'fields' => array(
			array(
				"name" => "lobby_hours",
				"label" => "Lobby Hours",
				"description" => "Enter your Lobby Hours. (ex: Monday-Friday 8 a.m. - 5 p.m.)",
				"scope" => array("location"),
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array( 'teeny' => false, 'media_buttons' => false )
			),
			array(
				"name" => "drive_hours",
				"label" => "Drive-Up",
				"description" => "Enter your Walk-Up Hours. (ex: Monday-Friday 8 a.m. - 5 p.m.)",
				"scope" => array("location"),
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array( 'teeny' => false, 'media_buttons' => false )
		),
			array(
				"name" => "walk_hours",
				"label" => "Walk-Up",
				"description" => "Enter your Walk-Up Hours. (ex: Monday-Friday 8 a.m. - 5 p.m.)",
				"scope" => array("location"),
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array( 'teeny' => false, 'media_buttons' => false )
			)
		)
	));
	
	slt_cf_register_box(array(
		'type' => 'post',
		'id' => 'location_details',
		'context' => 'normal',
		'priority' => 'high',
		'title' => 'Extended Location Details',
		'fields' => array(
			array(
				"name" => 'employee_categories',
				"label" => "Employee Categories",
				"description" => "Indicates the assigned Employee Categories for this location.",
				"scope" => array('location'),
				"options_type" => "terms",
				"multiple" => true,
				"options_query" => array(
					"taxonomies" => "employee_categories",
					"hide_empty" => false
				),
				"type" => "checkboxes"
			),
			array(
				'name' => 'location_description',
				'label' => 'Location Description',
				'description' => "This field is a supplementary title, which displays in the top-right of the map pane.",
				'scope' =>  array( 'location' ),
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array( 'teeny' => false, 'media_buttons' => true )
			),
		)
	));
	
}

// Should be taxonomy-agnostic, and thus therefore work on both "category" and "type"
function kml_render_document_by_category($category_id)
{
	global $post, $wpdb;
	$oldPost = $post;
	// The "category_id" variable represents the term_id, taxonomy-agnostic.
	$term = fh_get_term($category_id);
	$retVal = sprintf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns=\"http://www.opengis.net/kml/2.2\">
	<Document>
		<Style id=\"%s-Selected\">
			<IconStyle>
				<Icon>
					<href>%s/images/kml/Pin_%s-Selected.png</href>
				</Icon>
			</IconStyle>
		</Style>
		<Style id=\"%s\">
			<IconStyle>
				<Icon>
					<href>%s/images/kml/Pin_%s.png</href>
				</Icon>
			</IconStyle>
		</Style>
", 
		$term->slug, 
		get_bloginfo('stylesheet_directory'),
		$term->slug, 
		$term->slug, 
		get_bloginfo('stylesheet_directory'),
		$term->slug
	);

	$q = $wpdb->prepare("
		SELECT p.*
			FROM $wpdb->posts p
				INNER JOIN $wpdb->term_relationships rel
					ON rel.object_id = p.ID
				INNER JOIN $wpdb->term_taxonomy ta
					ON ta.term_taxonomy_id = rel.term_taxonomy_id
				WHERE ta.term_id = %d
					AND p.post_status = 'publish'
					AND p.post_type = %s
				ORDER BY p.menu_order, p.post_title;",
		$category_id,
		'location'
	);
	$posts = $wpdb->get_results($q);
	/*
	$q = new WP_Query(array(
		"post_type" => "location",
		"posts_per_page" => -1,
		"orderby" => "post_title"
	));
	*/
	$duplicate_check = array();
	foreach($posts as $post)
	{
		setup_postdata($post);
		$retVal .= kml_render_placemark($post, $term->slug);
	}

	$retVal .= "
	</Document>
</kml>";

	if($oldPost)
	{
		$post = $oldPost;
		wp_reset_postdata();
	}


	return $retVal;
}

function kml_render_placemark($post, $term_slug)
{
	if(!$post)
	{
		wp_die("Placemark generation failed due to broken post object");
	}
	$marker_coords = slt_cf_field_value('marker_coords');
	$address = slt_cf_field_value('address');

	// The KML coordinates stored in custom field are lon/lat, we need lat/lon.  Use array magic:
	$kml_coords = implode(",", array_reverse(explode(',', $marker_coords['marker_latlng'])));

	// The following is debugging code, commented out for production use:
	//$retVal .=  sprintf("Title: %s\r", get_the_title());
	//$retVal .=  sprintf("Marker: %s\r", $marker_coords['marker_latlng']);
	//$retVal .=  sprintf("Adjusted Marker: %s\r", $kml_coords);

	$retVal = sprintf("
		<Placemark id=\"%s_%d\">
			<styleUrl>#%s</styleUrl>
			<name>%s</name>
			<description>%s</description>
			<Point>
				<coordinates>%s</coordinates>
			</Point>
		</Placemark>
	", 
		$term_slug,
		$post->ID,
		$term_slug, 
		esc_html($post->post_title), 
		esc_html($post->post_title),//esc_html($address), 
		$kml_coords
	);

	return $retVal;
}


function p2p_locations_employees_connection() {
	p2p_register_connection_type( array(
		'name' => 'locations_to_employees',
		'from' => 'location',
		'to' => 'employee',
		'reciprocal' => true,
		'sortable' => 'any'
	) );
}
add_action( 'p2p_init', 'p2p_locations_employees_connection' );


?>