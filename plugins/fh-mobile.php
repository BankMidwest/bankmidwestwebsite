<?php
/*
Plugin Name: Mobile Theme Switcher
Plugin URI: http://www.flyinghippo.com
Description: Detects mobile devices and displays a given mobile theme instead of the standard theme.
Version: 1.0
Author: Flying Hippo Web Technologies
Author URI: http://www.flyinghippo.com
*/

// Modified version of "WordPress Mobile Edition"
// Copyright (c) 2002-2009 Crowd Favorite, Ltd.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// *****************************************************************

// ini_set('display_errors', '1'); ini_set('error_reporting', E_ALL);

$GLOBALS['FH_MOBILE_THEME'] = null;

$_theme_option = get_option("fhmobi_mobile_theme");
if($_theme_option && $_theme_option != "0")
{
	$GLOBALS['FH_MOBILE_THEME'] = $_theme_option;
}

if (!defined('PLUGINDIR')) {
	define('PLUGINDIR','wp-content/plugins');
}

load_plugin_textdomain('fh-mobile');

if (is_file(trailingslashit(ABSPATH.PLUGINDIR).'fh-mobile.php')) {
	define('CFMOBI_FILE', trailingslashit(ABSPATH.PLUGINDIR).'fh-mobile.php');
}
/*
else if (is_file(trailingslashit(ABSPATH.PLUGINDIR).'wordpress-mobile-edition/fh-mobile.php')) {
	define('CFMOBI_FILE', trailingslashit(ABSPATH.PLUGINDIR).'wordpress-mobile-edition/fh-mobile.php');
}
*/

register_activation_hook(CFMOBI_FILE, 'fhmobi_install');

function fhmobi_default_browsers($type = 'mobile') {
	$mobile = array(
		'2.0 MMP',
		'240x320',
		'400X240',
		'AvantGo',
		'BlackBerry',
		'Blazer',
		'Cellphone',
		'Danger',
		'DoCoMo',
		'Elaine/3.0',
		'EudoraWeb',
		'Googlebot-Mobile',
		'hiptop',
		'IEMobile',
		'KYOCERA/WX310K',
		'LG/U990',
		'MIDP-2.',
		'MMEF20',
		'MOT-V',
		'NetFront',
		'Newt',
		'Nintendo Wii',
		'Nitro', // Nintendo DS
		'Nokia',
		'Opera Mini',
		'Palm',
		'PlayStation Portable',
		'portalmmm',
		'Proxinet',
		'ProxiNet',
		'SHARP-TQ-GX10',
		'SHG-i900',
		'Small',
		'SonyEricsson',
		'Symbian OS',
		'SymbianOS',
		'TS21i-10',
		'UP.Browser',
		'UP.Link',
		'webOS', // Palm Pre, etc.
		'Windows CE',
		'WinWAP',
		'YahooSeeker/M1A1-R2D2',
	);
	$touch = array(
		'iPhone',
		'iPod',
		'Android',
		'BlackBerry9530',
		'LG-TU915 Obigo', // LG touch browser
		'LGE VX',
		'webOS', // Palm Pre, etc.
		'Nokia5800',
	);
	switch ($type) {
		case 'mobile':
		case 'touch':
			return $$type;
	}
}

$mobile = explode("\n", trim(get_option('fhmobi_mobile_browsers')));
$fhmobi_mobile_browsers = apply_filters('fhmobi_mobile_browsers', $mobile);
$touch = explode("\n", trim(get_option('fhmobi_touch_browsers')));
$fhmobi_touch_browsers = apply_filters('fhmobi_touch_browsers', $touch);

function fhmobi_install() {
	global $fhmobi_default_mobile_browsers;
	add_option('fhmobi_mobile_browsers', implode("\n", fhmobi_default_browsers('mobile')));
	global $fhmobi_default_touch_browsers;
	add_option('fhmobi_touch_browsers', implode("\n", fhmobi_default_browsers('touch')));
}

function fhmobi_init() {
	global $fhmobi_mobile_browsers, $fhmobi_touch_browsers;
	if (is_admin() && !fhmobi_installed()) {
		global $wp_version;
		if (isset($wp_version) && version_compare($wp_version, '2.5', '>=')) {
			$earl = htmlspecialchars(trailingslashit(get_bloginfo('wpurl')).'wp-admin/options-general.php?page=fh-mobile.php');
			add_action('admin_notices', create_function( '', "echo '<div class=\"error\"><p>Mobile Theme Switcher needs to be configured. Please visit the <a href=\"{$earl}\">settings</a> page to choose a mobile theme.</p></div>';" ) );
		}
	}
	if (isset($_COOKIE['fh_mobile']) && $_COOKIE['fh_mobile'] == 'false') {
		add_action('the_content', 'fhmobi_mobile_available');
	}
}
add_action('init', 'fhmobi_init');

function fhmobi_check_mobile() {
	global $fhmobi_mobile_browsers, $fhmobi_touch_browsers;
	$mobile = null;
	if (!isset($_SERVER["HTTP_USER_AGENT"]) || (isset($_COOKIE['fh_mobile']) && $_COOKIE['fh_mobile'] == 'false')) {
		$mobile = false;
	}
	else if (isset($_GET['fh_mobile']) && $_GET['fh_mobile'] == 'true' || isset($_COOKIE['fh_mobile']) && $_COOKIE['fh_mobile'] == 'true') // use COOKIE to get access to querystring AND cookies
	{
		$mobile = true;
	}
	$browsers = array_merge($fhmobi_mobile_browsers, $fhmobi_touch_browsers);
	if (is_null($mobile) && count($browsers)) {
		foreach ($browsers as $browser) {
			if (!empty($browser) && strpos($_SERVER["HTTP_USER_AGENT"], trim($browser)) !== false) {
				$mobile = true;
			}
		}
	}
	if (is_null($mobile)) {
		$mobile = false;
	}
	return apply_filters('fhmobi_check_mobile', $mobile);
}

if (fhmobi_check_mobile()) {
	add_filter('template', 'fhmobi_template');
	add_filter('option_template', 'fhmobi_template');
	add_filter('option_stylesheet', 'fhmobi_template');
}

function fhmobi_template($theme) {
	if (fhmobi_installed()) {
		return apply_filters('fhmobi_template', $GLOBALS['FH_MOBILE_THEME']);
	}
	else {
		return $theme;
	}
}

function fhmobi_installed() {
	return $GLOBALS['FH_MOBILE_THEME'] && is_dir(ABSPATH.'/wp-content/themes/'.$GLOBALS['FH_MOBILE_THEME']);
}

function fhmobi_mobile_exit() {
	echo '<p><a href="'.trailingslashit(get_bloginfo('home')).'?fh_action=reject_mobile">View full site</a></p>';
}

function fhmobi_mobile_available($content) {
	/* Disabled this functionality
	if (!defined('WPCACHEHOME')) {
		$content = $content.'<p><a href="'.trailingslashit(get_bloginfo('home')).'?fh_action=show_mobile">Return to the Mobile Site</a>.</p>';
	}
	*/
	return $content;
}

function fhmobi_mobile_link() {
	if (!defined('WPCACHEHOME')) {
		echo '<a href="'.trailingslashit(get_bloginfo('home')).'?fh_action=show_mobile">Mobile Site</a>';
	}
}

// TODO - add sidebar widget for link, with some sort of graphic?

function fhmobi_request_handler() {
	if (!empty($_GET['fh_action'])) {
		$url = parse_url(get_bloginfo('home'));
		$domain = $url['host'];
		if (!empty($url['path'])) {
			$path = $url['path'];
		}
		else {
			$path = '/';
		}
		$redirect = false;
		switch ($_GET['fh_action']) {
			case 'fhmobi_admin_js':
				fhmobi_admin_js();
				break;
			case 'fhmobi_admin_css':
				fhmobi_admin_css();
				die();
				break;
			case 'reject_mobile':
				setcookie(
					'fh_mobile'
					, 'false'
					, time() + 300000
					, $path
					, $domain
				);
				$redirect = true;
				break;
			case 'show_mobile':
				setcookie(
					'fh_mobile'
					, 'true'
					, time() + 300000
					, $path
					, $domain
				);
				$redirect = true;
				break;
			case 'fhmobi_who':
				if (current_user_can('manage_options')) {
					header("Content-type: text/plain");
					echo sprintf(__('Browser: %s', 'fh-mobile'), strip_tags($_SERVER['HTTP_USER_AGENT']));
					die();
				}
				break;
		}
		if ($redirect) {
			if (!empty($_SERVER['HTTP_REFERER'])) {
				$go = $_SERVER['HTTP_REFERER'];
			}
			else {
				$go = get_bloginfo('home');
			}
			header('Location: '.$go);
			die();
		}
	}
	if (!empty($_POST['fh_action'])) {
		switch ($_POST['fh_action']) {
			case 'fhmobi_update_settings':
				fhmobi_save_settings();
				wp_redirect(trailingslashit(get_bloginfo('wpurl')).'wp-admin/options-general.php?page=fh-mobile.php&updated=true');
				die();
				break;
		}
	}
}
add_action('init', 'fhmobi_request_handler');

function fhmobi_admin_js() {
	global $fhmobi_default_mobile_browsers, $fhmobi_default_touch_browsers;
	header('Content-type: text/javascript');
	$mobile = str_replace(array("'","\r", "\n"), array("\'", '', ''), implode('\\n', fhmobi_default_browsers('mobile')));
	$touch = str_replace(array("'","\r", "\n"), array("\'", '', ''), implode('\\n', fhmobi_default_browsers('touch')));
?>
jQuery(function($) {
	$('#fhmobi_mobile_reset').click(function() {
		$('#fhmobi_mobile_browsers').val('<?php echo $mobile; ?>');
		return false;
	});
	$('#fhmobi_touch_reset').click(function() {
		$('#fhmobi_touch_browsers').val('<?php echo $touch; ?>');
		return false;
	});
});
<?php
	die();
}
if (is_admin()) {
	wp_enqueue_script('fhmobi_admin_js', trailingslashit(get_bloginfo('url')).'?fh_action=fhmobi_admin_js', array('jquery'));
}

function fhmobi_admin_css() {
	header('Content-type: text/css');
?>
fieldset.options div.option {
	background: #EAF3FA;
	margin-bottom: 8px;
	padding: 10px;
}
fieldset.options div.option label {
	display: block;
	float: left;
	font-weight: bold;
	margin-right: 10px;
	width: 150px;
}
fieldset.options div.option span.help {
	color: #666;
	font-size: 11px;
	margin-left: 8px;
}
#fhmobi_mobile_browsers, #fhmobi_touch_browsers {
	height: 200px;
	width: 300px;
}
#fhmobi_mobile_reset, #fhmobi_touch_reset {
	display: block;
	font-size: 11px;
	font-weight: normal;
}
<?php
	die();
}

function fhmobi_admin_head() {
	echo '<link rel="stylesheet" type="text/css" href="'.trailingslashit(get_bloginfo('url')).'?fh_action=fhmobi_admin_css" />';
}
add_action('admin_head', 'fhmobi_admin_head');


$themes = wp_get_themes();
$theme_list = array("0" => "(please select a theme)");
foreach($themes as $tk => $theme)
{
	$theme_list[$tk] = $theme->get('Name');
}
$fhmobi_settings = array(
	'fhmobi_mobile_theme' => array(
		'type' => 'select',
		'options' => $theme_list,
		'label' => 'Mobile Theme',
		'default' => '0',
		'help' => ''
	),
	'fhmobi_mobile_browsers' => array(
		'type' => 'textarea',
		'label' => 'Mobile Browsers <a href="javascript:;" id="fhmobi_mobile_reset">Reset to Default</a>',
		'default' => fhmobi_default_browsers('mobile'),
		'help' => 'Browsers that have a <a href="http://en.wikipedia.org/wiki/User_agent">User Agent</a> matching a key below will be shown the mobile version of your site instead of the normal theme.',
	),
	'fhmobi_touch_browsers' => array(
		'type' => 'textarea',
		'label' => 'Touch Browsers <a href="javascript:;" id="fhmobi_touch_reset">Reset to Default</a>',
		'default' => fhmobi_default_browsers('touch'),
		'help' => 'Browsers that have a <a href="http://en.wikipedia.org/wiki/User_agent">User Agent</a> matching a key below will be shown the mobile version of your site instead of the normal theme.',
	),
);

function fhmobi_setting($option) {
	$value = get_option($option);
	if (empty($value)) {
		global $fhmobi_settings;
		$value = $fhmobi_settings[$option]['default'];
	}
	return $value;
}

function fhmobi_admin_menu() {
	if (current_user_can('manage_options')) {
		add_options_page(
			__('Mobile Theme Switcher', 'fh-mobile')
			, __('Mobile', 'fh-mobile')
			, 10
			, basename(__FILE__)
			, 'fhmobi_settings_form'
		);
	}
}
add_action('admin_menu', 'fhmobi_admin_menu');

function fhmobi_plugin_action_links($links, $file) {
	$plugin_file = basename(__FILE__);
	if ($file == $plugin_file) {
		$settings_link = '<a href="options-general.php?page='.$plugin_file.'">'.__('Settings', 'fh-mobile').'</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}
add_filter('plugin_action_links', 'fhmobi_plugin_action_links', 10, 2);

if (!function_exists('fh_settings_field')) {
	function fh_settings_field($key, $config) {
		$option = get_option($key);
		$label = '<label for="'.$key.'">'.$config['label'].'</label>';
		$help = '<div class="help">'.$config['help'].'</div>';
		switch ($config['type']) {
			case 'select':
				$output = $label.'<select name="'.$key.'" id="'.$key.'">';
				foreach ($config['options'] as $val => $display) {
					$option == $val ? $sel = ' selected="selected"' : $sel = '';
					$output .= '<option value="'.$val.'"'.$sel.'>'.htmlspecialchars($display).'</option>';
				}
				$output .= '</select>'.$help;
				break;
			case 'textarea':
				if (is_array($option)) {
					$option = implode("\n", $option);
				}
				$output = $label.'<textarea name="'.$key.'" id="'.$key.'">'.htmlspecialchars($option).'</textarea>'.$help;
				break;
			case 'string':
			case 'int':
			default:
				$output = $label.'<input name="'.$key.'" id="'.$key.'" value="'.htmlspecialchars($option).'" />'.$help;
				break;
		}
		return '<div class="option">'.$output.'<div class="clear"></div></div>';
	}
}

function fhmobi_settings_form() {
	global $fhmobi_settings;
	print('
<div class="wrap">
	<h2>'.__('Mobile Theme Switcher', 'fh-mobile').'</h2>
	<form id="fhmobi_settings_form" name="fhmobi_settings_form" action="'.get_bloginfo('wpurl').'/wp-admin/options-general.php" method="post">
		<input type="hidden" name="fh_action" value="fhmobi_update_settings" />
		<p>'.__('Browsers that have a <a href="http://en.wikipedia.org/wiki/User_agent">User Agent</a> matching a key below will be shown the mobile version of your site instead of the normal theme.', 'fh-mobile').'</p>
		<fieldset class="options">
	');
	foreach ($fhmobi_settings as $key => $config) {
		echo fh_settings_field($key, $config);
	}
	print('
		</fieldset>
		<p>'.sprintf(__('To see the User Agent for your browser, <a href="%s">click here</a>.', 'fh-mobile'), trailingslashit(get_bloginfo('home')).'?fh_action=fhmobi_who').'</p>
		<p class="submit">
			<input type="submit" name="submit" class="button-primary" value="'.__('Save Settings', 'fh-mobile').'" />
		</p>
	</form>
</div>
	');
	do_action('fhmobi_settings_form');

}

function fhmobi_save_settings() {
	if (!current_user_can('manage_options')) {
		return;
	}
	global $fhmobi_settings;
	foreach ($fhmobi_settings as $key => $option) {
		$value = '';
		switch ($option['type']) {
			case 'int':
				$value = intval($_POST[$key]);
				break;
			case 'select':
				$test = stripslashes($_POST[$key]);
				if (isset($option['options'][$test])) {
					$value = $test;
				}
				break;
			case 'string':
			case 'textarea':
			default:
				$value = stripslashes($_POST[$key]);
				break;
		}
		update_option($key, $value);
	}
}

if (!function_exists('get_snoopy')) {
	function get_snoopy() {
		include_once(ABSPATH.'/wp-includes/class-snoopy.php');
		return new Snoopy;
	}
}

//a:22:{s:11:"plugin_name";s:24:"WordPress Mobile Edition";s:10:"plugin_uri";s:42:"http://crowdfavorite.com/wordpress/plugins";s:18:"plugin_description";s:277:"Show your mobile visitors a site presentation designed just for them. Rich experience for iPhone, Android, etc. and clean simple formatting for less capable mobile browsers. Cache-friendly with a Carrington-based theme, and progressive enhancement for advanced mobile browsers.";s:14:"plugin_version";s:3:"3.0";s:6:"prefix";s:6:"fhmobi";s:8:"filename";s:13:"fh-mobile.php";s:12:"localization";s:9:"fh-mobile";s:14:"settings_title";s:24:"WordPress Mobile Edition";s:13:"settings_link";s:6:"Mobile";s:4:"init";s:1:"1";s:7:"install";s:1:"1";s:9:"post_edit";b:0;s:12:"comment_edit";b:0;s:6:"jquery";b:0;s:6:"wp_css";b:0;s:5:"wp_js";b:0;s:9:"admin_css";s:1:"1";s:8:"admin_js";s:1:"1";s:15:"request_handler";s:1:"1";s:6:"snoopy";s:1:"1";s:11:"setting_cat";b:0;s:14:"setting_author";b:0;}

?>
