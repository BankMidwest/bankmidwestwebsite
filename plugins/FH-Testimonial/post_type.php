<?php

// This plugin assumes the presence of SLT's "Developer's Custom Fields" (http://sltaylor.co.uk/wordpress/plugins/slt-custom-fields/)


// The following function is abstract enough to be defined only once,
// rather than being specific to this file.  However, until we decide
// a good mechanism (e.g. plugin, or starter functions.php file for
// site templates), this will be associated with a register_post_type
// statement.
function register_capabilities_testimonials($post_type_name)
{
	global $wp_roles;
	if(!isset($wp_roles))
	{
		$wp_roles = new WP_Roles();
	}

	$role =& $wp_roles->get_role('administrator');
	$capabilities = $role->capabilities;
	$adminCapabilities = array(
		'edit_%s', 
		'read_%s', 
		'delete_%s', 
		'edit_%ss',
		'edit_others_%ss',
		'publish_%ss',
		'read_private_%ss'
	);
	foreach($adminCapabilities as $capFmt)
	{
		$capName = sprintf($capFmt, $post_type_name);
		if(!array_key_exists($capName, $capabilities))
		{
			// Regardless of capability yes/no, we only care if it has been previously defined.
			$role->add_cap($capName);
		}
	}
}

add_action('init', 'testimonial_init');
function testimonial_init()
{
	// Register the post type
	register_post_type(
		'testimonial',
		array(
			'labels' => array(
				'name' => 'Testimonials',
				'singular_name' => 'Testimonial',
				'add_new_item' => 'Add new Testimonial',
				'new_item_name' => 'New Testimonial',
				'parent_item' => 'Parent Testimonial',
				'search_items' => 'Search Testimonials',
				'update_item' => 'Update Testimonial',
				'add_or_remote_items' => 'Add or remove Testimonials'
				),
			'public' => true,
			'capability_type' => 'post',	// TODO: Customize at site level, replace "post" with "testimonial"
			'hierarchical' => false,
			'rewrite' => false,		// FH:NOTE:JRB:20110728 -- disabled rewrite for older version of wordpress; shouldn't be necessary anyway
			'supports' => array('title', 'custom-fields', 'editor', 'excerpt', 'thumbnail')
		)
	);

	register_capabilities_testimonials('testimonial');

	if(function_exists("slt_cf_register_box"))
	{
		slt_cf_register_box(array(
			'type' => 'post',
			'id' => 'sltcf_testimonials',
			'title' => 'Testimonial Details',
			'fields' => array(
				array(
					'name' => 'attribution',
					'label' => 'Attribution',
					'description' => 'Who is the testimony "attributed to?"',
					'scope' => array('testimonial'),
					'type' => 'text'
				),			
				array(
					'name' => 'attribution_location',
					'label' => 'Location',
					'description' => 'Location of person giving testimony',
					'scope' => array('testimonial'),
					'type' => 'text'
				)
			)
		));

		slt_cf_register_box(array(
			'type' => 'post',
			'id' => 'sltcf_testimonial_selection',
			'title' => 'Testimonial Selection',
			'description' => 'Allows for post- or page-level override of default "random" behavior.',
			'fields' => array(
				array(
					'name' => 'testimonial_override',
					'label' => 'Testimonial Selection',
					'description' => 'Allows for selection of a specific testimonial (default is random)',
					'scope' => array("page"),	// NOTE: This might need to be modified per-site
					'type' => 'select',
					'options_type' => 'posts',
					'options_query' => array(
						'post_type' => 'testimonial',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC'
					)
				),
				array(
					'name' => 'testimonial_negate',
					'label' => 'Hide Testimonials',
					'description' => 'Set if this page should not display any testimonials in widgets (default is to hide testimonial)',
					'scope' => array("page"),	// NOTE: This might need to be modified per-site
					'type' => 'checkbox',
					'default' => 1
				),
				array(
					'name' => 'testimonial_inherit',
					'label' => 'Enumerate using inheritance',
					'description' => 'When rendering testimonials, look at parent for overrides',
					'scope' => array("page"),	// NOTE: This might need to be modified per-site
					'type' => 'checkbox'
				)

			)
		));
	}
	else
	{
		add_action('admin_notices', 'testimonial_admin_notice_sltcf_dependency');
	}
}

function testimonial_admin_notice_sltcf_dependency()
{
	?>
	<div id="testimonial_admin_notice_sltcf_dependency" class="updated fade">
		<p>
			The <strong>FH Testimonial</strong> post type expects the
			<a target="_blank" href="http://sltaylor.co.uk/wordpress/plugins/slt-custom-fields/">SLT Developer's Custom Fields plugin</a> (version 0.6 or greater)
			to be activated.
		</p>
	</div>
	<?php
}
?>
