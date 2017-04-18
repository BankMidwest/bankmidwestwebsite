<?php

function dmth_theme_options_menu()
{
	add_submenu_page(
			'options-general.php',
			'Theme Options',
			'Theme Options',
			'manage_options',
			'dmth-theme-options',
			'dmth_theme_options_menu_render'
			);
}
add_action('admin_menu', 'dmth_theme_options_menu');

function dmth_theme_options_menu_render()
{
	if(!current_user_can('manage_options'))
	{
		wp_die(__('You do not have the necessary permissions to access this page.'));
	}

	// we're handling post data, and wish to save stuff now.
	if(!empty($_POST['save']))
	{
		// Global options
		$alert_text = $_POST['alert_text'];
		//	if(get_magic_quotes_gpc())
		{
			$alert_text = preg_replace("%\\'%", "'", stripslashes($alert_text));
		}
		update_option('alert_text', $alert_text);
		update_option('filter_domains', preg_replace("%[^a-zA-Z0-9.\n]%", "", $_POST['filter_domains']));
		
		?>
		<div class="updated">
			<p>
				<strong>
					Your settings have been saved.
				</strong>
			</p>
		</div>
		<?php
	}
	
	global $wpdb;

	?>
		<div class="wrap">
			<h2>
				Theme Options
			</h2>
			<form name="form1" method="post" action="">
				<div>
					<h3>
						Off-Site Link Notifications
					</h3>
					<table>
						<tr>
							<td>Alert Text</td>
							<td>
								<textarea name="alert_text" id="alert_text" style="width:400px; height:100px"><?php echo esc_html(get_option("alert_text")); ?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>Note:</strong> Alert text cannot be formatted. 
							</td>
						</tr>
						<tr>
							<td>Filter Domains</td>
							<td>
								<textarea name="filter_domains" id="filter_domains" style="height:500px; width:600px;"><?php echo esc_html(get_option("filter_domains")); ?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>Note:</strong> One domain per line. Only letters, numbers, and dots (.) are permitted.
							</td>
						</tr>
					</table>
				</div>
				
				<hr style="background-color: #aaa; height: 1px; border: none;" />
				<input type="submit" name="save" value="Save" />
			</form>
		</div>
	<?php
}

?>