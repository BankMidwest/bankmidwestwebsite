<?php
require_once("functions-typeregistration.php");

add_action( 'init', 'register_cpt_Resource' );
function register_cpt_Resource() {

	$labels = array( 
		'name' => _x( 'Resource', 'Resource' ),
		'singular_name' => _x( 'Resource', 'Resource' ),
		'add_new' => _x( 'Add New', 'Resource' ),
		'add_new_item' => _x( 'Add New Resource', 'Resource' ),
		'edit_item' => _x( 'Edit Resource', 'Resource' ),
		'new_item' => _x( 'New Resource', 'Resource' ),
		'view_item' => _x( 'View Resource', 'Resource' ),
		'search_items' => _x( 'Search Resource', 'Resource' ),
		'not_found' => _x( 'No Resource found', 'Resource' ),
		'not_found_in_trash' => _x( 'No Resource found in Trash', 'Resource' ),
		'parent_item_colon' => _x( 'Parent Resource:', 'Resource' ),
		'menu_name' => _x( 'Resource', 'Resource' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array( 'revisions', 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'taxonomies' => array('Resource_categories', 'Resource_tags'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
	//	'map_meta_cap' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'Resource',
		//'register_meta_box_cb' => 'df_create_meta_box'
	);

	register_post_type( 'resource', $args );
	register_taxonomy_Resource_categories();
	register_taxonomy_Resource_tags();

	// Verify capabilities
	fh_register_capabilities('Resource');
}

function register_taxonomy_Resource_categories() {

	$labels = array( 
		'name' => _x( 'Resource Category', 'Resource_categories' ),
		'singular_name' => _x( 'Resource Category', 'Resource_categories' ),
		'search_items' => _x( 'Search Resource Categories', 'Resource_categories' ),
		'popular_items' => _x( 'Popular Resource Categories', 'Resource_categories' ),
		'all_items' => _x( 'All Resource Categories', 'Resource_categories' ),
		'parent_item' => _x( 'Parent Resource Category', 'Resource_categories' ),
		'parent_item_colon' => _x( 'Parent Resource Category:', 'Resource_categories' ),
		'edit_item' => _x( 'Edit Resource Category', 'Resource_categories' ),
		'update_item' => _x( 'Update Resource Category', 'Resource_categories' ),
		'add_new_item' => _x( 'Add New Resource Category', 'Resource_categories' ),
		'new_item_name' => _x( 'New Resource Category Name', 'Resource_categories' ),
		'separate_items_with_commas' => _x( 'Separate Resource Categories with commas', 'Resource_categories' ),
		'add_or_remove_items' => _x( 'Add or remove Resource Categories', 'Resource_categories' ),
		'choose_from_most_used' => _x( 'Choose from the most used Resource Categories', 'Resource_categories' ),
		'menu_name' => _x( 'Resource Category', 'Resource_categories' )
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

	register_taxonomy( 'Resource_categories', array('Resource'), $args );
}

function register_taxonomy_Resource_tags() {

	$labels = array( 
		'name' => _x( 'Resource Tag', 'Resource_tags' ),
		'singular_name' => _x( 'Resource Tag', 'Resource_tags' ),
		'search_items' => _x( 'Search Resource Tags', 'Resource_tags' ),
		'popular_items' => _x( 'Popular Resource Tags', 'Resource_tags' ),
		'all_items' => _x( 'All Resource Tags', 'Resource_tags' ),
		'parent_item' => _x( 'Parent Resource Tag', 'Resource_tags' ),
		'parent_item_colon' => _x( 'Parent Resource Tag:', 'Resource_tags' ),
		'edit_item' => _x( 'Edit Resource Tag', 'Resource_tags' ),
		'update_item' => _x( 'Update Resource Tag', 'Resource_tags' ),
		'add_new_item' => _x( 'Add New Resource Tag', 'Resource_tags' ),
		'new_item_name' => _x( 'New Resource Tag Name', 'Resource_tags' ),
		'separate_items_with_commas' => _x( 'Separate Resource Tags with commas', 'Resource_tags' ),
		'add_or_remove_items' => _x( 'Add or remove Resource Tags', 'Resource_tags' ),
		'choose_from_most_used' => _x( 'Choose from the most used Resource Tags', 'Resource_tags' ),
		'menu_name' => _x( 'Resource Tag', 'Resource_tags' )
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

	register_taxonomy( 'Resource_tags', array('Resource'), $args );
}


add_action( 'admin_head', 'Resource_cpt_icons' );
function Resource_cpt_icons() {
    ?>
<style type="text/css" media="screen">
	#menu-posts-Resource .wp-menu-image {
		background: url('<?php bloginfo('stylesheet_directory') ?>/images/Resourcepaper.png') no-repeat 7px -18px !important;
	}
	#menu-posts-Resource:hover .wp-menu-image, #menu-posts-Resource.wp-has-current-submenu .wp-menu-image {
		background-position: 7px 7px !important;
	}
</style>
<?php }

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_Resource_details',
		'title' => 'Resource Details',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			/*
			array(
				'name' => 'Resource_date',
				'label' => 'Resource Date (start)',
				'description' => 'Provides the date of the Resource',
				'scope' => array('Resource'),
				'type' => 'date',
				'capabilities' => array('edit_Resource')
			),
			array(
				'name' => 'Resource_time',
				'label' => 'Resource Time (start)',
				'description' => 'Provides the time of the Resource',
				'scope' => array('Resource'),
				'type' => 'time',
				'capabilities' => array('edit_Resource')
			)			*/
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'Resource', "Developer's Custom Fields 0.7+");
}


/*
// Custom query vars
function latham_query_vars($qVars)
{
	$qVars[] = "view";
	$qVars[] = "date_start";
	$qVars[] = "date_end";
	$qVars[] = "start_date";
	$qVars[] = "end_date";
	$qVars[] = "evt_cats";
	$qVars[] = "evt_schools";
	$qVars[] = "school_year";

	return $qVars;
}
add_filter('query_vars', 'latham_query_vars');
*/

/* Add capability for date-based custom post type archives (e.g. http://www.flyinghippo.com/Resource/2012/06/ */
add_action('generate_rewrite_rules', 'fh_rewrite_Resource');
function fh_rewrite_Resource($wp_rewrite) {
	$rules = fh_generate_date_archives('Resource', $wp_rewrite);
	$wp_rewrite->rules = $rules + $wp_rewrite->rules;
	return $wp_rewrite;
}

?>