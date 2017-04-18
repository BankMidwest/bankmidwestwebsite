<?php
/**
 * Supplementary functions  - copy to main theme as needed.
 */

/**
 * Set up Theme Options in the admin for controlling sitewide variables.
 * In the sample options page below, the site options control social media icons. If you want to change
 *   the fields, you'll need to change the variable names in the update section of the code at the top
 *   as well as the form below.
 * When you need to call one of the options, do it like this: 
 *   <?php echo get_option('fh_fb_url'); ?>
 *
 */
add_action("admin_menu", "fh_theme_options");  
function fh_theme_options() {
    add_submenu_page('themes.php', 'Site Options', 'Site Options', 'create_users', 'site-options', 'fh_site_options');   
}
function fh_site_options() {
// Check that the user is allowed to update options  
	if (!current_user_can('create_users')) {  
		wp_die('You do not have sufficient permissions to access this page.');  
	}
	?>

	<div class="wrap">
		<?php screen_icon('themes'); ?> <h2>Site Options</h2>
		<?php if (isset($_POST["update_settings"])) {
			$fb_url = esc_attr($_POST["fb_url"]);
			$twitter_url = esc_attr($_POST["twitter_url"]);
			$youtube_url = esc_attr($_POST["youtube_url"]);
			$linkedin_url = esc_attr($_POST["linkedin_url"]);
			update_option("fh_fb_url", $fb_url);
			update_option("fh_twitter_url", $twitter_url);
			update_option("fh_linkedin_url", $linkedin_url);
			update_option("fh_youtube_url", $youtube_url);
		?>  
			<div id="message" class="updated" style="padding: 5px 10px;">Settings saved.</div>  
		<?php  
		} ?>
		<form method="POST" action="">
			<h3>Social Media Icons (header/footer)</h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="fb_url">
							Facebook URL:
						</label>
					</th>
					<td>
						<input type="text" name="fb_url" id="fb_url" size="70" value="<?php echo get_option('fh_fb_url'); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="twitter_url">
							Twitter URL:
						</label>
					</th>
					<td>
						<input type="text" name="twitter_url" id="twitter_url" size="70" value="<?php echo get_option('fh_twitter_url'); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="linkedin_url">
							LinkedIn URL:
						</label>
					</th>
					<td>
						<input type="text" name="linkedin_url" id="linkedin_url" size="70" value="<?php echo get_option('fh_linkedin_url'); ?>" />
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="youtube_url">
							YouTube URL:
						</label>
					</th>
					<td>
						<input type="text" name="youtube_url" id="youtube_url" size="70" value="<?php echo get_option('fh_youtube_url'); ?>" />
					</td>
				</tr>
			</table>
			<input type="hidden" name="update_settings" value="Y" />
			<p>
				<input id="submit" type="submit" value="Save settings" class="button-primary"/>
			</p>
		</form>
	</div>
	<?php 
}

?>