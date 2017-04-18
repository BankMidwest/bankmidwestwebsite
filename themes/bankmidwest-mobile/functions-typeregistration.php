<?php
// These functions should probably be a plugin.  For now, though, it's still highly modular and can be included
// as needed.
function fh_register_capabilities($post_type_name)
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

add_action('fh_plugin_dependency_error', 'fh_admin_notice_dependency', 10, 2);
function fh_admin_notice_dependency($type, $plugin)
{
	eval("\$x = function() {
		?>
	<div class='updated fade'>
		<p>
			The <strong>$type</strong> post type expects the
			<strong>$plugin</strong> plugin to be activated.
		</p>
	</div>
		<?php
	};");
	add_action('admin_notices', $x);
}
?>