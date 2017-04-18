<?php
require_once("functions-typeregistration.php");

add_action( 'init', 'register_cpt_home_announcements' );

function register_cpt_home_announcements() {

	$labels = array( 
		'name' => _x( 'Homepage Announcements', 'home_announcements' ),
		'singular_name' => _x( 'Homepage Announcement', 'home_announcements' ),
		'add_new' => _x( 'Add New', 'home_announcements' ),
		'add_new_item' => _x( 'Add New Announcement', 'home_announcements' ),
		'edit_item' => _x( 'Edit Announcement', 'home_announcements' ),
		'new_item' => _x( 'New Announcement', 'home_announcements' ),
		'view_item' => _x( 'View Announcement', 'home_announcements' ),
		'search_items' => _x( 'Search Announcements', 'home_announcements' ),
		'not_found' => _x( 'No Announcements found', 'home_announcements' ),
		'not_found_in_trash' => _x( 'No Announcements found in Trash', 'home_announcements' ),
		'parent_item_colon' => _x( 'Parent Announcement:', 'home_announcements' ),
		'menu_name' => _x( 'Home Announcements', 'home_announcements' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true, /* this is where custom post will not work, needs to be true not false, this was all :) - Roman */
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'home_announcements'
	);

	

	register_post_type( 'home_announcements', $args );

	// Verify capabilities
	fh_register_capabilities('home_announcements');
}

add_action( 'admin_head', 'announcement_cpt_icons' );
function announcement_cpt_icons() {
    ?>
<style type="text/css" media="screen">
	#menu-posts-announcement .wp-menu-image {
		background: url('<?php bloginfo('stylesheet_directory') ?>/images/address-book-open.png') no-repeat 7px -16px !important;
	}
	#menu-posts-announcement:hover .wp-menu-image, #menu-posts-announcement.wp-has-current-submenu .wp-menu-image {
		background-position: 7px 7px !important;
	}
</style>
<?php }



if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'sltcf_home_announcement_details',
		'title' => 'Announcement Details',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'announcement_image',
				'label' => 'Announcement Image',
				'description' => 'Use "Featured Image" in the right sidebar to set the image for this Announcement. If feature image is not selected, text below will be shown. Be sure to select the link below either way.',
				'scope' => array('home_announcements'),
				'type' => 'notice'		
			),
			array(
				'name' => 'announcement_title',
				'label' => 'Announcement Title',
				'description' => 'Enter Announcement Title (ex: New Hours)',
				'scope' => array('home_announcements'),
				'type' => 'text'
			),/*
			array(
				'name' => 'announcement_text',
				'label' => 'Announcement Text',
				'description' => 'Enter Announcement Text',
				'scope' => array('home_announcements'),
				'type' => 'wysiwyg'
			),*/
			array(
				'name' => 'announcement_link',
				'label' => 'Announcement Learn More Link',
				'description' => 'Enter Announcement Link (ex: http://www.facebook.com)',
				'scope' => array('home_announcements'),
				'type' => 'text'
			)					
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'home_announcements', "Developer's Custom Fields 0.7+");
}

?>