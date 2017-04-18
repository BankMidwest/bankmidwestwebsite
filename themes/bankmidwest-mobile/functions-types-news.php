<?php
require_once("functions-typeregistration.php");

add_action( 'init', 'register_cpt_news' );
function register_cpt_news() {

	$labels = array( 
		'name' => _x( 'News', 'news' ),
		'singular_name' => _x( 'News', 'news' ),
		'add_new' => _x( 'Add New', 'news' ),
		'add_new_item' => _x( 'Add New News', 'news' ),
		'edit_item' => _x( 'Edit News', 'news' ),
		'new_item' => _x( 'New News', 'news' ),
		'view_item' => _x( 'View News', 'news' ),
		'search_items' => _x( 'Search News', 'news' ),
		'not_found' => _x( 'No News found', 'news' ),
		'not_found_in_trash' => _x( 'No News found in Trash', 'news' ),
		'parent_item_colon' => _x( 'Parent News:', 'news' ),
		'menu_name' => _x( 'News', 'news' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array( 'revisions', 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'taxonomies' => array('news_categories', 'news_tags'),
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
		'capability_type' => 'news',
		//'register_meta_box_cb' => 'df_create_meta_box'
	);

	register_post_type( 'news', $args );
	register_taxonomy_news_categories();
	register_taxonomy_news_tags();

	// Verify capabilities
	fh_register_capabilities('news');
}

function register_taxonomy_news_categories() {

	$labels = array( 
		'name' => _x( 'News Category', 'news_categories' ),
		'singular_name' => _x( 'News Category', 'news_categories' ),
		'search_items' => _x( 'Search News Categories', 'news_categories' ),
		'popular_items' => _x( 'Popular News Categories', 'news_categories' ),
		'all_items' => _x( 'All News Categories', 'news_categories' ),
		'parent_item' => _x( 'Parent News Category', 'news_categories' ),
		'parent_item_colon' => _x( 'Parent News Category:', 'news_categories' ),
		'edit_item' => _x( 'Edit News Category', 'news_categories' ),
		'update_item' => _x( 'Update News Category', 'news_categories' ),
		'add_new_item' => _x( 'Add New News Category', 'news_categories' ),
		'new_item_name' => _x( 'New News Category Name', 'news_categories' ),
		'separate_items_with_commas' => _x( 'Separate News Categories with commas', 'news_categories' ),
		'add_or_remove_items' => _x( 'Add or remove News Categories', 'news_categories' ),
		'choose_from_most_used' => _x( 'Choose from the most used News Categories', 'news_categories' ),
		'menu_name' => _x( 'News Category', 'news_categories' )
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

	register_taxonomy( 'news_categories', array('news'), $args );
}

function register_taxonomy_news_tags() {

	$labels = array( 
		'name' => _x( 'News Tag', 'news_tags' ),
		'singular_name' => _x( 'News Tag', 'news_tags' ),
		'search_items' => _x( 'Search News Tags', 'news_tags' ),
		'popular_items' => _x( 'Popular News Tags', 'news_tags' ),
		'all_items' => _x( 'All News Tags', 'news_tags' ),
		'parent_item' => _x( 'Parent News Tag', 'news_tags' ),
		'parent_item_colon' => _x( 'Parent News Tag:', 'news_tags' ),
		'edit_item' => _x( 'Edit News Tag', 'news_tags' ),
		'update_item' => _x( 'Update News Tag', 'news_tags' ),
		'add_new_item' => _x( 'Add New News Tag', 'news_tags' ),
		'new_item_name' => _x( 'New News Tag Name', 'news_tags' ),
		'separate_items_with_commas' => _x( 'Separate News Tags with commas', 'news_tags' ),
		'add_or_remove_items' => _x( 'Add or remove News Tags', 'news_tags' ),
		'choose_from_most_used' => _x( 'Choose from the most used News Tags', 'news_tags' ),
		'menu_name' => _x( 'News Tag', 'news_tags' )
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

	register_taxonomy( 'news_tags', array('news'), $args );
}


add_action( 'admin_head', 'news_cpt_icons' );
function news_cpt_icons() {
    ?>
<style type="text/css" media="screen">
	#menu-posts-news .wp-menu-image {
		background: url('<?php bloginfo('stylesheet_directory') ?>/images/newspaper.png') no-repeat 7px -18px !important;
	}
	#menu-posts-news:hover .wp-menu-image, #menu-posts-news.wp-has-current-submenu .wp-menu-image {
		background-position: 7px 7px !important;
	}
</style>
<?php }

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_news_details',
		'title' => 'News Details',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			/*
			array(
				'name' => 'news_date',
				'label' => 'News Date (start)',
				'description' => 'Provides the date of the news',
				'scope' => array('news'),
				'type' => 'date',
				'capabilities' => array('edit_news')
			),
			array(
				'name' => 'news_time',
				'label' => 'News Time (start)',
				'description' => 'Provides the time of the news',
				'scope' => array('news'),
				'type' => 'time',
				'capabilities' => array('edit_news')
			)			*/
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'news', "Developer's Custom Fields 0.7+");
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

/* Add capability for date-based custom post type archives (e.g. http://www.flyinghippo.com/news/2012/06/ */
add_action('generate_rewrite_rules', 'fh_rewrite_news');
function fh_rewrite_news($wp_rewrite) {
	$rules = fh_generate_date_archives('news', $wp_rewrite);
	$wp_rewrite->rules = $rules + $wp_rewrite->rules;
	return $wp_rewrite;
}

?>