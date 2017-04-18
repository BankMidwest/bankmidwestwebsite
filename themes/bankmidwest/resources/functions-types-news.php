<?php
/**
 * Custom post type definition for news.
 * NOTE: This post type uses custom rewrite rules to allow for date-based archives.
 */
 
require_once("../../fh-starter/resources/functions-typeregistration.php");

add_action( 'init', 'register_cpt_news' );

function register_cpt_news() {

	$labels = array( 
		'name' => _x( 'News Items', 'news' ),
		'singular_name' => _x( 'News Item', 'news' ),
		'add_new' => _x( 'Add New', 'news' ),
		'add_new_item' => _x( 'Add New News Item', 'news' ),
		'edit_item' => _x( 'Edit News Item', 'news' ),
		'new_item' => _x( 'New News Item', 'news' ),
		'view_item' => _x( 'View News Item', 'news' ),
		'search_items' => _x( 'Search News Items', 'news' ),
		'not_found' => _x( 'No news items found', 'news' ),
		'not_found_in_trash' => _x( 'No news items found in Trash', 'news' ),
		'parent_item_colon' => _x( 'Parent News Item:', 'news' ),
		'menu_name' => _x( 'News', 'news' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'news'
	);

	register_post_type( 'news', $args );

	// Verify capabilities
	fh_register_capabilities('news');
}

add_action( 'init', 'register_taxonomy_news_audiences' );
function register_taxonomy_news_audiences() {

	$labels = array( 
		'name' => _x( 'News Audiences', 'news_audiences' ),
		'singular_name' => _x( 'News Audience', 'news_audiences' ),
		'search_items' => _x( 'Search News Audiences', 'news_audiences' ),
		'popular_items' => _x( 'Popular News Audiences', 'news_audiences' ),
		'all_items' => _x( 'All News Audiences', 'news_audiences' ),
		'parent_item' => _x( 'Parent News Audiences', 'news_audiences' ),
		'parent_item_colon' => _x( 'Parent News Audience:', 'news_audiences' ),
		'edit_item' => _x( 'Edit News Audience', 'news_audiences' ),
		'update_item' => _x( 'Update News Audience', 'news_audiences' ),
		'add_new_item' => _x( 'Add New News Audience', 'news_audiences' ),
		'new_item_name' => _x( 'New News Audience Name', 'news_audiences' ),
		'separate_items_with_commas' => _x( 'Separate news audiences with commas', 'news_audiences' ),
		'add_or_remove_items' => _x( 'Add or remove news audiences', 'news_audiences' ),
		'choose_from_most_used' => _x( 'Choose from the most used news audiences', 'news_audiences' ),
		'menu_name' => _x( 'News Audiences', 'news_audiences' )
	);

	$args = array( 
		'labels' => $labels,
		'public' => false,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => false,
		'hierarchical' => true,
		'rewrite' => false,
		'query_var' => false
	);

	register_taxonomy( 'news_audiences', array('news'), $args );
}

/* Add capability for date-based custom post type archives (e.g. http://www.flyinghippo.com/news/2012/06/ */
add_action('generate_rewrite_rules', 'fh_rewrite_news');
function fh_rewrite_news($wp_rewrite) {
	$rules = fh_generate_date_archives('news', $wp_rewrite);
	$wp_rewrite->rules = $rules + $wp_rewrite->rules;
	return $wp_rewrite;
}

add_action('admin_head', 'news_cpt_icons');
function news_cpt_icons() {
    ?>
    <style type="text/css" media="screen">
	#menu-posts-news .wp-menu-image {
		background: url(/wp-admin/images/menu.png) no-repeat -150px -33px !important;
	}
	#menu-posts-news:hover .wp-menu-image, #menu-posts-news.wp-has-current-submenu .wp-menu-image {
		background-position: -150px -1px !important;
	}
    </style>
<?php }

?>