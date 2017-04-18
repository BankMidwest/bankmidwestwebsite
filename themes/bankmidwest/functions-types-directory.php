<?php
require_once("functions-typeregistration.php");

add_action( 'init', 'register_cpt_employee' );

function register_cpt_employee() {

	$labels = array( 
		'name' => _x( 'Employee', 'employee' ),
		'singular_name' => _x( 'Employee', 'employee' ),
		'add_new' => _x( 'Add New', 'employee' ),
		'add_new_item' => _x( 'Add New Employee', 'employee' ),
		'edit_item' => _x( 'Edit Employee', 'employee' ),
		'new_item' => _x( 'New Employee', 'employee' ),
		'view_item' => _x( 'View Employee', 'employee' ),
		'search_items' => _x( 'Search Employees', 'employee' ),
		'not_found' => _x( 'No Employees found', 'employee' ),
		'not_found_in_trash' => _x( 'No Employees found in Trash', 'employee' ),
		'parent_item_colon' => _x( 'Parent Employee:', 'employee' ),
		'menu_name' => _x( 'Directory', 'employee' ),
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
		'capability_type' => 'employee'
	);

	

	register_post_type( 'employee', $args );
	register_taxonomy_employee_categories();

	// Verify capabilities
	fh_register_capabilities('employee');
}

function register_taxonomy_employee_categories() {

	$labels = array( 
		'name' => _x( 'Employee Category', 'employee_categories' ),
		'singular_name' => _x( 'Employee Category', 'employee_categories' ),
		'search_items' => _x( 'Search Employee Categories', 'employee_categories' ),
		'popular_items' => _x( 'Popular Employee Categories', 'employee_categories' ),
		'all_items' => _x( 'All Employee Categories', 'employee_categories' ),
		'parent_item' => _x( 'Parent Employee Category', 'employee_categories' ),
		'parent_item_colon' => _x( 'Parent Employee Category:', 'employee_categories' ),
		'edit_item' => _x( 'Edit Employee Category', 'employee_categories' ),
		'update_item' => _x( 'Update Employee Category', 'employee_categories' ),
		'add_new_item' => _x( 'Add New Employee Category', 'employee_categories' ),
		'new_item_name' => _x( 'New Employee Category Name', 'employee_categories' ),
		'separate_items_with_commas' => _x( 'Separate Employee Categories with commas', 'employee_categories' ),
		'add_or_remove_items' => _x( 'Add or remove Employee Categories', 'employee_categories' ),
		'choose_from_most_used' => _x( 'Choose from the most used Employee Categories', 'employee_categories' ),
		'menu_name' => _x( 'Employee Category', 'employee_categories' )
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

	register_taxonomy( 'employee_categories', array('employee'), $args );
}

add_action( 'admin_head', 'employee_cpt_icons' );
function employee_cpt_icons() {
    ?>
<style type="text/css" media="screen">
	#menu-posts-employee .wp-menu-image {
		background: url('<?php bloginfo('stylesheet_directory') ?>/images/address-book-open.png') no-repeat 7px -16px !important;
	}
	#menu-posts-employee:hover .wp-menu-image, #menu-posts-employee.wp-has-current-submenu .wp-menu-image {
		background-position: 7px 7px !important;
	}
</style>
<?php }


if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_employee_details',
		'title' => 'Employee Details',
		'fields' => array(			
			array(
				'name' => 'employee_image',
				'label' => 'Employee Image',
				'description' => 'Use "Featured Image" in the right sidebar to set the image for this Employee.',
				'scope' => array('employee'),
				'type' => 'notice'
			),
			array(
				'name' => 'employee_fname',
				'label' => 'Employee First Name',
				'description' => 'Enter Employee First Name (ex: Molly)',
				'scope' => array('employee'),
				'type' => 'text'
			),
			array(
				'name' => 'employee_lname',
				'label' => 'Employee Last Name',
				'description' => 'Enter Employee Last Name (ex: Franzen)',
				'scope' => array('employee'),
				'type' => 'text'
			),
			array(
				'name' => 'employee_title',
				'label' => 'Employee Title',
				'description' => 'Enter Employee Title (ex: Ag Lender)',
				'scope' => array('employee'),
				'type' => 'text'
			), 
			array(
				'name' => 'employee_email',
				'label' => 'Employee Email',
				'description' => 'Enter Emplyee Email (ex: email@email.com)',
				'scope' => array('employee'),
				'type' => 'text'
			),
			array(
				'name' => 'employee_linkedin',
				'label' => 'Employee LinkedIn',
				'description' => 'Enter Employee LinkedIn URL',
				'scope' => array('employee'),
				'type' => 'text'
			),
			array(
				'name' => 'employee_sharefile',
				'label' => 'Employee Sharefile Link',
				'description' => 'Enter Employees Sharefile Link',
				'scope' => array('employee'),
				'type' => 'text'
			),
			array(
				'name' => 'employee_phone',
				'label' => 'Employee Phone Number',
				'description' => 'Enter Employee Phone Number (ex: 555.555.5555)',
				'scope' => array('employee'),
				'type' => 'text'
			),
			array(
				'name' => 'employee_fax',
				'label' => 'Employee Fax Number',
				'description' => 'Enter Employee Fax Number (ex: 555.555.5555)',
				'scope' => array('employee'),
				'type' => 'text'
			),
			array(
				'name' => 'NMLS',
				'label' => 'NMLS Number',
				'description' => 'Enter Employee NMLS Number',
				'scope' => array('employee'),
				'type' => 'text'
			),
			array(
				'name' => 'employee_application',
				'label' => 'Mortgage Application URL',
				'description' => 'URL for Mortgage Application',
				'scope' => array('employee'),
				'type' => 'text'
			) /*,
			array(
				'name' => 'employee_description',
				'label' => 'Employee Description',
				'description' => 'Enter Description to appear on Employee page',
				'scope' => array('employee'),
				'type' => 'wysiwyg'
			)*/
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'employee', "Developer's Custom Fields 0.7+");
}


/* 
Sidebar images for the blog page 
SEL
8/3/2015
 */

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_blog_sidebar',
		'title' => 'Sidebar Images',
		'fields' => array(	
			array(
				'name' => 'sidebar_image_one',
				'label' => 'Sidebar Image One',
				'description' => '',
				'scope' => array('posts' => array( 257 )),
				'file_attach_to_post' => true,
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_image_one_link',
				'label' => 'Sidebar Image One Link',
				'description' => 'The Link Associated with the First Image',
				'scope' => array('posts' => array( 257 )),
				'file_attach_to_post' => true,
				'type' => 'text'
			),
			array(
				'name' => 'sidebar_image_two',
				'label' => 'Sidebar Image Two',
				'description' => '',
				'scope' => array('posts' => array( 257 )),
				'file_attach_to_post' => true,
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_image_two_link',
				'label' => 'Sidebar Image Two Link',
				'description' => 'The Link Associated with the Second Image',
				'scope' => array('posts' => array( 257 )),
				'file_attach_to_post' => true,
				'type' => 'text'
			)/*,
			array(
				'name' => 'employee_description',
				'label' => 'Employee Description',
				'description' => 'Enter Description to appear on Employee page',
				'scope' => array('employee'),
				'type' => 'wysiwyg'
			)*/
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'employee', "Developer's Custom Fields 0.7+");
}

/* 
Sidebar images for the news page 
AMD
06/22/2016
 */

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_news_sidebar',
		'title' => 'Sidebar Images',
		'fields' => array(	
			array(
				'name' => 'sidebar_news_image_one',
				'label' => 'Sidebar Image One',
				'description' => '',
				'scope' => array('posts' => array( 311 )),
				'file_attach_to_post' => true,
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_news_image_one_link',
				'label' => 'Sidebar Image One Link',
				'description' => 'The Link Associated with the First Image',
				'scope' => array('posts' => array( 311 )),
				'file_attach_to_post' => true,
				'type' => 'text'
			),
			array(
				'name' => 'sidebar_news_image_two',
				'label' => 'Sidebar Image Two',
				'description' => '',
				'scope' => array('posts' => array( 311 )),
				'file_attach_to_post' => true,
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_news_image_two_link',
				'label' => 'Sidebar Image Two Link',
				'description' => 'The Link Associated with the Second Image',
				'scope' => array('posts' => array( 311 )),
				'file_attach_to_post' => true,
				'type' => 'text'
			)/*,
			array(
				'name' => 'employee_description',
				'label' => 'Employee Description',
				'description' => 'Enter Description to appear on Employee page',
				'scope' => array('employee'),
				'type' => 'wysiwyg'
			)*/
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'employee', "Developer's Custom Fields 0.7+");
}

/* 
Sidebar images for the events page 
AMD
06/22/2016
 */

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_events_sidebar',
		'title' => 'Sidebar Images',
		'fields' => array(	
			array(
				'name' => 'sidebar_events_image_one',
				'label' => 'Sidebar Image One',
				'description' => '',
				'scope' => array('posts' => array( 320 )),
				'file_attach_to_post' => true,
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_events_image_one_link',
				'label' => 'Sidebar Image One Link',
				'description' => 'The Link Associated with the First Image',
				'scope' => array('posts' => array( 320 )),
				'file_attach_to_post' => true,
				'type' => 'text'
			),
			array(
				'name' => 'sidebar_events_image_two',
				'label' => 'Sidebar Image Two',
				'description' => '',
				'scope' => array('posts' => array( 320 )),
				'file_attach_to_post' => true,
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_events_image_two_link',
				'label' => 'Sidebar Image Two Link',
				'description' => 'The Link Associated with the Second Image',
				'scope' => array('posts' => array( 320 )),
				'file_attach_to_post' => true,
				'type' => 'text'
			)/*,
			array(
				'name' => 'employee_description',
				'label' => 'Employee Description',
				'description' => 'Enter Description to appear on Employee page',
				'scope' => array('employee'),
				'type' => 'wysiwyg'
			)*/
		)
	));
}
else
{
	do_action('fh_plugin_dependency_error', 'employee', "Developer's Custom Fields 0.7+");
}

?>