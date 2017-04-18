<?php
require_once("functions-typeregistration.php");

add_action( 'init', 'register_cpt_homepage_slider' );
function register_cpt_homepage_slider() {

	$labels = array( 
		'name' => _x( 'Homepage Slides', 'homepage_slider' ),
		'singular_name' => _x( 'Homepage Slide', 'homepage_slider' ),
		'add_new' => _x( 'Add New', 'homepage_slider' ),
		'add_new_item' => _x( 'Add New Homepage Slide', 'homepage_slider' ),
		'edit_item' => _x( 'Edit Homepage Slide', 'homepage_slider' ),
		'new_item' => _x( 'New Homepage Slide', 'homepage_slider' ),
		'view_item' => _x( 'View Homepage Slide', 'homepage_slider' ),
		'search_items' => _x( 'Search Homepage Slides', 'homepage_slider' ),
		'not_found' => _x( 'No Homepage Slides found', 'homepage_slider' ),
		'not_found_in_trash' => _x( 'No Homepage Slides found in Trash', 'homepage_slider' ),
		'parent_item_colon' => _x( 'Parent Homepage Slide:', 'homepage_slider' ),
		'menu_name' => _x( 'Homepage Slides', 'homepage_slider' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'revisions', 'thumbnail'  ),
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
		'capability_type' => 'homepage_slider'
	);

	register_post_type( 'homepage_slider', $args );

	// Verify capabilities
	fh_register_capabilities('homepage_slider');
}

add_action( 'admin_head', 'homepage_slider_cpt_icons' );
function homepage_slider_cpt_icons() {
    ?>
<style type="text/css" media="screen">
	#menu-posts-homepage_slider .wp-menu-image {
		background: url('<?php bloginfo('stylesheet_directory') ?>/images/slide.png') no-repeat 7px -18px !important;
	}
	#menu-posts-homepage_slider:hover .wp-menu-image, #menu-posts-homepage_slider.wp-has-current-submenu .wp-menu-image {
		background-position: 7px 7px !important;
	}
</style>
<?php }

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'sltcf_homepage_slider_details',
		'title' => 'Homepage Slide Details',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			
			array(
				'name' => 'homepage_slider_image',
				'label' => 'Main Image for This Slide',
				'description' => "Provides the image for the slide's background.",
				'scope' => array('homepage_slider'),
				'type' => 'file',
				'capabilities' => array('edit_homepage_sliders')
			),
			array(
				'name' => 'homepage_slider_descr',
				'label' => 'Main Image Alt Text for this slide',
				'description' => 'Provides the alt text for the Hompeage Slider',
				'scope' => array('homepage_slider'),
				'type' => 'text',
				'capabilities' => array('edit_homepage_sliders')
			),
			array(
				'name' => 'homepage_slider_btn1_header',
				'label' => '1st Button Header',
				'description' => 'Header for the 1st Hompeage Slider Button (If there is no header, the button will not display.)',
				'scope' => array('homepage_slider'),
				'type' => 'text',
				'capabilities' => array('edit_homepage_sliders')
			),
			array(
				'name' => 'homepage_slider_btn1_txt',
				'label' => '1st Button Text',
				'description' => 'Text for the 1st Hompeage Slider Button',
				'scope' => array('homepage_slider'),
				'type' => 'wysiwyg',
				'capabilities' => array('edit_homepage_sliders')
			),
			array(
				'name' => 'homepage_slider_btn1_link',
				'label' => '1st Button Link',
				'description' => 'Text for the 1st Hompeage Slider Button',
				'scope' => array('homepage_slider'),
				'type' => 'text',
				'capabilities' => array('edit_homepage_sliders')
			),
			array(
				'name' => 'homepage_slider_btn1_icon',
				'label' => '1st Button Icon',
				'description' => 'Icon for the 1st Hompeage Slider Button',
				'scope' => array('homepage_slider'),
				'type' => 'file',
				'capabilities' => array('edit_homepage_sliders')
			),		
			array(
				'name' => 'homepage_slider_btn2_header',
				'label' => '2nd Button Header',
				'description' => 'Header for the 2nd Hompeage Slider Button(If there is no header, the button will not display.)',
				'scope' => array('homepage_slider'),
				'type' => 'text',
				'capabilities' => array('edit_homepage_sliders')
			),
			array(
				'name' => 'homepage_slider_btn2_txt',
				'label' => '2nd Button Link',
				'description' => 'Link for the 2nd Hompeage Slider Button',
				'scope' => array('homepage_slider'),
				'type' => 'wysiwyg',
				'capabilities' => array('edit_homepage_sliders')
			),
			array(
				'name' => 'homepage_slider_btn2_link',
				'label' => '2nd Button Link',
				'description' => 'Text for the 2nd Hompeage Slider Button',
				'scope' => array('homepage_slider'),
				'type' => 'text',
				'capabilities' => array('edit_homepage_sliders')
			),		
			array(
				'name' => 'homepage_slider_btn2_icon',
				'label' => '2nd Button Icon',
				'description' => 'Icon for the 2nd Hompeage Slider Button',
				'scope' => array('homepage_slider'),
				'type' => 'file',
				'capabilities' => array('edit_homepage_sliders')
			)					
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'homepage_slider', "Developer's Custom Fields 0.7+");
}

?>