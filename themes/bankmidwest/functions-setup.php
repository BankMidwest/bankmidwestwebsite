<?php
/**
 * Initial site setup page.
 * Allows us to quickly change all the settings that we use on all our projects when creating a new site.
 */

// These could potentially change, so defining them at the top rather than hard-coding them inside the function
define('FH_GFORMS_KEY', '3f0bc1d364459a174e9d62681c499b9d');
define('FH_RECAPTCHA_PUBLIC', '6Lf9lswSAAAAAGmVow5RcUQQcKYoWXqLZQs8Xjqh');
define('FH_RECAPTCHA_PRIVATE', '6Lf9lswSAAAAAH0h0kgdJx4wCz5vQAGWJniS4H7k');

function fh_site_setup_add_page() {
	if (!get_option('fh_hide_setup') == TRUE) {
		add_theme_page(
		  'Site Setup',
		  'Site Setup',
		  'update_core',
		  'site_setup',
		  'fh_site_setup_render_page'
		);
	}
}
add_action('admin_menu', 'fh_site_setup_add_page', 50);

function fh_site_setup_render_page() { ?>
  <div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php printf(__('%s Site Setup', 'fh'), get_bloginfo('name')); ?></h2>
	
		<?php if (isset($_POST["update_settings"]) && ($_POST["update_settings"] == 'Y')) {
			$fh_create_front_page = esc_attr($_POST["fh_create_front_page"]);
			if ($fh_create_front_page) {
				fh_setup_create_front_page();
			}
			$fh_delete_default = esc_attr($_POST["fh_delete_default"]);
			if ($fh_delete_default) {
				fh_setup_delete_default();
			}
			$fh_change_permalink_structure = esc_attr($_POST["fh_change_permalink_structure"]);
			if ($fh_change_permalink_structure) {
				fh_setup_change_permalink_structure();
			}
			$fh_add_site_admin = esc_attr($_POST["fh_add_site_admin"]);
			if ($fh_add_site_admin) {
				fh_setup_add_site_admin();
			}
			$fh_set_members_permissions = esc_attr($_POST["fh_set_members_permissions"]);
			if ($fh_set_members_permissions) {
				fh_setup_set_members_permissions();
			}
			$fh_set_gforms_keys = esc_attr($_POST["fh_set_gforms_keys"]);
			if ($fh_set_gforms_keys) {
				fh_setup_set_gforms_keys();
			}
			$fh_misc_settings = esc_attr($_POST["fh_misc_settings"]);
			if ($fh_misc_settings) {
				fh_setup_misc_settings();
			}
			$fh_hide_setup = esc_attr($_POST["fh_hide_setup"]);
			if ($fh_hide_setup == "true") {
				update_option('fh_hide_setup', true);
			}
		?>  
			<div id="message" class="updated" style="padding: 5px 10px;">Settings saved.</div>  
		<?php  
		} ?>

    <form method="post" action="">

      <table class="form-table">

        <tr valign="top"><th scope="row"><?php _e('Create static front page?', 'fh'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Create static front page?', 'fh'); ?></span></legend>
              <select name="fh_create_front_page" id="fh_create_front_page">
                <option <?php if (!$fh_create_front_page) echo ' selected="selected" '; ?>value="true"><?php echo _e('Yes', 'fh'); ?></option>
                <option <?php if ($fh_create_front_page) echo ' selected="selected" '; ?>value="false"><?php echo _e('No', 'fh'); ?></option>
              </select>
              <br />
              <small class="description"><?php printf(__('Create a page called Home and set it to be the static front page', 'fh')); ?></small>
            </fieldset>
          </td>
        </tr>
		
        <tr valign="top"><th scope="row"><?php _e('Delete "Hello World" post?', 'fh'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Delete "Hello World" post?', 'fh'); ?></span></legend>
              <select name="fh_delete_default" id="fh_delete_default">
                <option <?php if (!$fh_delete_default) echo ' selected="selected" '; ?>value="true"><?php echo _e('Yes', 'fh'); ?></option>
                <option <?php if ($fh_delete_default) echo ' selected="selected" '; ?>value="false"><?php echo _e('No', 'fh'); ?></option>
              </select>
              <br />
              <small class="description"><?php printf(__('Delete the default Hello World post and related comment', 'fh')); ?></small>
            </fieldset>
          </td>
        </tr>

        <tr valign="top"><th scope="row"><?php _e('Change permalink structure?', 'fh'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Update permalink structure?', 'fh'); ?></span></legend>
              <select name="fh_change_permalink_structure" id="fh_change_permalink_structure">
                <option <?php if (!$fh_change_permalink_structure) echo ' selected="selected" '; ?>value="true"><?php echo _e('Yes', 'fh'); ?></option>
                <option <?php if ($fh_change_permalink_structure) echo ' selected="selected" '; ?>value="false"><?php echo _e('No', 'fh'); ?></option>
              </select>
              <br />
              <small class="description"><?php printf(__('Change permalink structure to /&#37;year&#37;/&#37;month&#37;/&#37;postname&#37;/', 'fh')); ?></small>
            </fieldset>
          </td>
        </tr>

        <tr valign="top"><th scope="row"><?php _e('Add Site Administrator role?', 'fh'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Add Site Administrator role?', 'fh'); ?></span></legend>
              <select name="fh_add_site_admin" id="fh_add_site_admin">
                <option <?php if (!$fh_add_site_admin) echo ' selected="selected" '; ?>value="true"><?php echo _e('Yes', 'fh'); ?></option>
                <option <?php if ($fh_add_site_admin) echo ' selected="selected" '; ?>value="false"><?php echo _e('No', 'fh'); ?></option>
              </select>
              <br />
              <small class="description"><?php printf(__('Add Site Administrator role with pre-set permissions.', 'fh')); ?></small>
            </fieldset>
          </td>
        </tr>

        <tr valign="top"><th scope="row"><?php _e('Set Members settings', 'fh'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Set Members settings', 'fh'); ?></span></legend>
              <select name="fh_set_members_permissions" id="fh_set_members_permissions">
                <option <?php if (!$fh_set_members_permissions) echo ' selected="selected" '; ?>value="true"><?php echo _e('Yes', 'fh'); ?></option>
                <option <?php if ($fh_set_members_permissions) echo ' selected="selected" '; ?>value="false"><?php echo _e('No', 'fh'); ?></option>
              </select>
              <br />
              <small class="description"><?php printf(__('Disable the page permissions feature of Members by default.', 'fh')); ?></small>
            </fieldset>
          </td>
        </tr>

        <tr valign="top"><th scope="row"><?php _e('Set Gravity Forms keys', 'fh'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Set Gravity Forms keys', 'fh'); ?></span></legend>
              <select name="fh_set_gforms_keys" id="fh_set_gforms_keys">
                <option <?php if (!$fh_set_gforms_keys) echo ' selected="selected" '; ?>value="true"><?php echo _e('Yes', 'fh'); ?></option>
                <option <?php if ($fh_set_gforms_keys) echo ' selected="selected" '; ?>value="false"><?php echo _e('No', 'fh'); ?></option>
              </select>
              <br />
              <small class="description"><?php printf(__('Set the Gravity Forms license key and add the public and private reCAPTCHA keys.', 'fh')); ?></small>
            </fieldset>
          </td>
        </tr>

        <tr valign="top"><th scope="row"><?php _e('Miscellaneous settings', 'fh'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Miscellaneous settings', 'fh'); ?></span></legend>
              <select name="fh_misc_settings" id="fh_misc_settings">
                <option <?php if (!$fh_misc_settings) echo ' selected="selected" '; ?>value="true"><?php echo _e('Yes', 'fh'); ?></option>
                <option <?php if ($fh_misc_settings) echo ' selected="selected" '; ?>value="false"><?php echo _e('No', 'fh'); ?></option>              </select>
              <br />
              <small class="description"><?php printf(__('Update timezone, disable comments, remove site description, and change Start of Week to Sunday.', 'fh')); ?></small>
            </fieldset>
          </td>
        </tr>
		
		<tr valign="top"><th scope="row"><?php _e('Hide setup panel', 'fh'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Hide setup panel', 'fh'); ?></span></legend>
              <select name="fh_hide_setup" id="fh_hide_setup">
                <option value="true"><?php echo _e('Yes', 'fh'); ?></option>
                <option selected="selected" value="false"><?php echo _e('No', 'fh'); ?></option>
              </select>
              <br />
              <small class="description"><?php printf(__('Hide this panel from now on.', 'fh')); ?></small>
            </fieldset>
          </td>
        </tr>

      </table>
      <input type="hidden" name="update_settings" value="Y" />
      <?php submit_button(); ?>
    </form>
  </div>
<?php 
}

function fh_setup_create_front_page() {

	$default_pages = array('Home');
    $existing_pages = get_pages();
    $temp = array();

    foreach ($existing_pages as $page) {
      $temp[] = $page->post_title;
    }

    $pages_to_create = array_diff($default_pages, $temp);

    foreach ($pages_to_create as $new_page_title) {
      $add_default_pages = array(
        'post_title' => $new_page_title,
        'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat, orci ac laoreet cursus, dolor sem luctus lorem, eget consequat magna felis a magna. Aliquam scelerisque condimentum ante, eget facilisis tortor lobortis in. In interdum venenatis justo eget consequat. Morbi commodo rhoncus mi nec pharetra. Aliquam erat volutpat. Mauris non lorem eu dolor hendrerit dapibus. Mauris mollis nisl quis sapien posuere consectetur. Nullam in sapien at nisi ornare bibendum at ut lectus. Pellentesque ut magna mauris. Nam viverra suscipit ligula, sed accumsan enim placerat nec. Cras vitae metus vel dolor ultrices sagittis. Duis venenatis augue sed risus laoreet congue ac ac leo. Donec fermentum accumsan libero sit amet iaculis. Duis tristique dictum enim, ac fringilla risus bibendum in. Nunc ornare, quam sit amet ultricies gravida, tortor mi malesuada urna, quis commodo dui nibh in lacus. Nunc vel tortor mi. Pellentesque vel urna a arcu adipiscing imperdiet vitae sit amet neque. Integer eu lectus et nunc dictum sagittis. Curabitur commodo vulputate fringilla. Sed eleifend, arcu convallis adipiscing congue, dui turpis commodo magna, et vehicula sapien turpis sit amet nisi.',
        'post_status' => 'publish',
        'post_type' => 'page'
      );

      $result = wp_insert_post($add_default_pages);
    }

    $home = get_page_by_title('Home');
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home->ID);

    $home_menu_order = array(
      'ID' => $home->ID,
      'menu_order' => -1
    );
    wp_update_post($home_menu_order);
}

function fh_setup_delete_default() {
	wp_delete_post(1, true);
}

function fh_setup_change_permalink_structure() {
    global $wp_rewrite;

    if (get_option('permalink_structure') !== '/%year%/%monthnum%/%postname%/') {
      $wp_rewrite->set_permalink_structure('/%year%/%monthnum%/%postname%/');
    }

    $wp_rewrite->init();
    $wp_rewrite->flush_rules();
}

function fh_setup_add_site_admin() { 

	$fh_site_admin = array(
		'add_users' => true,
		'create_roles' => true,
		'create_users' => true,
		'delete_others_pages' => true,
		'delete_others_posts' => true,
		'delete_pages' => true,
		'delete_plugins' => true,
		'delete_posts' => true,
		'delete_private_pages' => true,
		'delete_private_posts' => true,
		'delete_published_pages' => true,
		'delete_published_posts' => true,
		'delete_roles' => true,
		'delete_users' => true,
		'edit_dashboard' => true,
		'edit_others_pages' => true,
		'edit_others_posts' => true,
		'edit_pages' => true,
		'edit_plugins' => true,
		'edit_posts' => true,
		'edit_private_pages' => true,
		'edit_private_posts' => true,
		'edit_published_pages' => true,
		'edit_published_posts' => true,
		'edit_roles' => true,
		'edit_themes' => true,
		'edit_users' => true,
		'export' => true,
		'gravityforms_addon_browser' => true,
		'gravityforms_create_form' => true,
		'gravityforms_delete_entries' => true,
		'gravityforms_delete_forms' => true,
		'gravityforms_edit_entries' => true,
		'gravityforms_edit_entry_notes' => true,
		'gravityforms_edit_forms' => true,
		'gravityforms_edit_settings' => true,
		'gravityforms_export_entries' => true,
		'gravityforms_preview_forms' => true,
		'gravityforms_view_entries' => true,
		'gravityforms_view_entry_notes' => true,
		'gravityforms_view_settings' => true,
		'import' => true,
		'install_plugins' => true,
		'list_roles' => true,
		'list_users' => true,
		'manage_categories' => true,
		'manage_links' => true,
		'moderate_comments' => true,
		'promote_users' => true,
		'publish_pages' => true,
		'publish_posts' => true,
		'read' => true,
		'read_private_pages' => true,
		'read_private_posts' => true,
		'remove_users' => true,
		'restrict_content' => true,
		'unfiltered_html' => true,
		'unfiltered_upload' => true,
		'upload_files' => true,
		'level_1' => true
	);

    add_role('siteadmin', 'Site Administrator', $fh_site_admin);
}

function fh_setup_set_members_permissions() {
	$settings = array(
		'role_manager' => 1,
		'content_permissions' => 0,
		'private_blog' => 0,
		'private_feed' => 0,
		'login_form_widget' => 0,
		'users_widget' => 0,
		'content_permissions_error' => '<p class="restricted">' . __( 'Sorry, but you do not have permission to view this content.', 'members' ) . '</p>',
		'private_feed_error' => '<p class="restricted">' . __( 'You must be logged into the site to view this content.', 'members' ) . '</p>',
	);

	add_option( 'members_settings', $settings, '', 'yes' );
}

function fh_setup_set_gforms_keys() {
	add_option( 'rg_gforms_key', FH_GFORMS_KEY, '', 'yes' );
	add_option( 'rg_gforms_captcha_public_key', FH_RECAPTCHA_PUBLIC, '', 'yes' );
	add_option( 'rg_gforms_captcha_private_key', FH_RECAPTCHA_PRIVATE, '', 'yes' );
}

function fh_setup_misc_settings() {
	update_option('timezone_string', 'America/Chicago');
	update_option('start_of_week', 0);
	update_option('blogdescription', '');
	update_option('default_ping_status', 'closed');
	update_option('default_comment_status', 'closed');
	update_option('default_post_edit_rows', 20);
}
