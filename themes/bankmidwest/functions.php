<?php

if(function_exists('slt_cf_setting')) slt_cf_setting('datepicker_default_format', 'mm/dd/yy');

add_theme_support('post-thumbnails'); // Enable Featured Image support
include( 'pageids.php' );
include('functions-setup.php');
include('functions-types-directory.php');
include('functions-types-news.php');
include('functions-types-resources.php');
include('functions-types-homepage_slider.php');
include('functions-types-homepage_announcements.php');
include_once("functions-types-location.php");
include_once("functions-types-event.php");
include('functions-options.php');
include( 'functions-api.php' );
include( 'functions-modular-meta.php' );
include( 'functions-resources-meta.php' );

include_once("functions-contact-form.php");

/**
 * Resize uploaded images to max of 1280px wide. This saves on disk space if they are prone to uploading
 *   photos directly from a digital camera.
 * Disabled by default - uncomment the add_action line below to activate
 */
// add_action('wp_handle_upload', 'fh_resize');
function fh_resize($array){
  // $array contains file, url, type
  if ($array['type'] == 'image/jpeg' OR $array['type'] == 'image/gif' OR $array['type'] == 'image/png') {
    // there is a file to handle, so include the class and get the variables
    require_once('../fh-starter/inc/class.resize.php');
    $maxwidth = 1280; // this number can be increased or decreased as needed
    $objResize = new RVJ_ImageResize($array['file'], $array['file'], 'W', $maxwidth);
  }
  return $array;
}

add_action('admin_init', 'enqueue_stylesheet_mods');
function enqueue_stylesheet_mods()
{
	wp_register_style('stylesheet_admin', get_bloginfo('stylesheet_directory') . '/admin_styles.css');
	wp_enqueue_style('stylesheet_admin');
}

add_image_size('home_announcment_image', 327, 147, true);
add_image_size('employee_large', 170, 170, true);
add_image_size('blog_thumb', 145, 95, true);
add_image_size('blog_large', 493, 330, true);
add_image_size('employee_thumb', 94, 94, true);
add_image_size('location_single', 325, 200, true);
add_image_size('main_home',868, 170, true);
add_image_size('main_landing',868, 351, true);
add_image_size('resource', 150, 200, true);
/**
 * Builds a list of classes to apply to the page body
 */
function fh_contextual_classes($class_list = array()) {

	global $post;
	if(is_null($class_list) || !is_array($class_list))
	{
		$class_list = array();
	}

	// Add class 'home' if it's the home page
	if (is_front_page()) $class_list[] = 'home';

	// Add class 'page' and 'page-[ID]' if it's a standard page
	if (is_page()) {
		$class_list[] = 'page';
		$class_list[] = 'page-' . $post->ID;
	}

	// Add class 'post' for standard blog entries
	if (get_post_type() == 'post') $class_list[] = 'post';
	if ((is_archive() || is_home()) && get_post_type() == 'post') $class_list[] = 'blog';

	// Add class 'archive' and 'single' accordingly (for all post types)
	if (is_archive() || is_home()) $class_list[] = 'archive';
	if (is_single()) $class_list[] = 'single';

	// Add class 'fourohfour' if it's a 404 page
	if (is_404()) $class_list[] = 'fourohfour';

	// Add classes based on post type
	if (is_post_type_archive('event') || get_post_type() == 'event') $class_list[] = 'event';
	if (is_post_type_archive('news') || get_post_type() == 'news') $class_list[] = 'news';

	if ($class_list) {
		// Turn the array of classes into a string we can use
		$class_list_str = implode(" ", $class_list);
		// Add syntax to the front of the class list if it's not null
		$body_classes = ' class="' . $class_list_str . '"';
	}

	echo $body_classes;
}

/**
 * Customizing the visual editor in the backend.
 * By default, a lot of this code is commented out, but left in place as an example if you want to use it.
 * As is, the only thing it does is to remove Heading 1 from being selected in the editor since we never want the user to use this.
 */
// add_editor_style(); // enables editor-style.css (make sure this file is present in the theme directory)
add_filter( 'tiny_mce_before_init', 'fh_mce_before_init' );
function fh_mce_before_init( $settings ) {
/* Add custom classes to the Styles dropdown in the editor. If you use this, make sure to uncomment the add_editor_style() line above
/*
    $style_formats = array(
	    array(
	    	'title' => 'Orange Heading',
	    	'classes' => 'orange-caps',
	    	'selector' => 'h2,h3,h4'
	    ),
		array(
			'title' => 'Callout Link',
			'selector' => 'a',
			'classes' => 'callout-link'
		),
		array(
			'title' => 'Section Heading',
			'selector' => 'h2,h3,h4',
			'classes' => 'section-heading'
		)
	);

	$settings['style_formats'] = json_encode( $style_formats );
*/
	$settings['theme_advanced_blockformats'] = 'p,pre,code,h2,h3,h4,h5,h6'; // prevent selecting Heading 1 in the editor
	return $settings;
}

/**
 * Hide admin bar on certain templates.
 * Often a page template will be used in a popup form (e.g. a Colorbox iframe element). If the following code is not present
 *   it will display the admin bar a second time inside the iframe to logged-in users, which is undesirable.
 *   Uncomment the add_filter() line below to use, then modify the template name accordingly.
 * Note: You can add multiple template names to the conditional statement below if you have multiple popup forms.
 */
// add_filter( 'show_admin_bar' , 'hide_admin_bar_on_form');
function hide_admin_bar_on_form($content) {
	global $post;
	return (is_page_template('template-popupform.php')) ? false : $content;
}


/**
 * Remove some of the default WordPress stuff from the admin bar
 */
function fh_admin_bar_cleanup() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('search');
}
add_action( 'wp_before_admin_bar_render', 'fh_admin_bar_cleanup' );

/**
 * Change login URL and hover title to the site's name and homepage (by default, it links to WordPress)
 */
function fh_login_url(){
	return (get_bloginfo('url'));
}
function fh_login_title(){
	return (get_bloginfo('name'));
}
add_filter('login_headerurl', 'fh_login_url');
add_filter('login_headertitle', 'fh_login_title');

/**
 * Clean up the admin menu to remove features we don't use
 */
function remove_menu_items() {
  global $menu;
  $restricted = array(__('Comments'), __('Links'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }
add_action('admin_menu', 'remove_menu_items');

/**
 * The following closure formats our fh_XXXX attribute output.  Default is to leave it unmodified.
 */
$fh_attr_escaper = function ($value) { return $value; };

$fh_html_attributes = array();

function add_html_attribute($value)
{
	global $fh_html_attributes;
	$fh_html_attributes[] = $value;
}

function fh_html()
{
	global $fh_html_attributes, $fh_attr_escaper;
	if(sizeof($fh_html_attributes))
	{
		foreach($fh_html_attributes as $fatt)
		{
			$escr = function($value) { return $value; };
			// we assume it's not already escaped..
			echo sprintf(" %s", $fh_attr_escaper($fatt));
		}
	}
}

/**
 * Get page ID from slug or title.
 */
function fh_get_page_id($name) {
	global $wpdb;
	$query = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE ( post_name = %s OR post_title = %s ) AND post_status = 'publish' AND post_type='page'", $name, $name);
	$page_id = $wpdb->get_var($query);
	return $page_id;
}

/**
 * Modified get_permalink() which accepts a slug or title in addition to the ID.
 */
function fh_get_permalink($name) {
	if (!is_numeric($name)) {
		$page_id = fh_get_page_id($name);
	} else {
		$page_id = $name;
	}
	return get_permalink($page_id);
}

/**
 * Echo the permalink. This is just a convenience which saves a couple of characters of typing since the
 * permalink will be most frequently echoed.
 */
function fh_permalink($name) {
	echo fh_get_permalink($name);
}

/**
 * Method for displaying a user-entered URL to ensure that every URL is fully qualified. Corrects a wide
 *   variety of possibile values that could be entered.
 * Also allows relative links (e.g. /contact/) - in this case we add the entire base URL to the beginning.
 * Pass in "true" as the second parameter to return the value rather than echo it.
 */
function fh_url($url, $return = false) {
	$ret = '';
	if (substr($url, 0, 4) == 'http') {
		$ret = $url;
	} elseif (substr($url, 0, 1) == '/') {
		$ret = get_bloginfo('url') . $url;
	} else {
		$ret = 'http://' . $url;
	}
	if ($return)
		return $ret;
	else
		echo $ret;
}

/**
 * Checks if current page is located under a given top level page; if so, add 'active' class.
 *  Also works for hierarchical custom post types.
 *
 * Use as follows:
 * 		<li<?php fh_check_active(4); ?>>
 *
 * You will need to manually pass in the ID that we're checking. This should correspond to the ID of the
 * get_permalink() in the <a> element itself.
 *
 * Also supports returning the value rather than echoing it - just pass in "false" as the second parameter.
 */
/*
function fh_check_active($post_id, $echo = true) {
	$retVal = "";
	if (is_singular()) {
		if (is_single($post_id) || is_page($post_id) || is_descendent($post_id)) $retVal = ' class="active"';
		if ($echo) echo $retVal;
		else return $retVal;
	}
} */

function fh_check_active($post_id, $echo = true) {
	$retVal = "";
	$is_archive = is_archive();
	$obj = get_queried_object();

	if (is_single($post_id) || is_page($post_id) || is_descendent($post_id))
		$retVal = ' class="active"';
	else if ($is_archive && $post_id == 29)
		$retVal = " class=\"active\"";
	else if (is_single() && $obj->post_type == "post" && $post_id == 29)
		$retVal = " class=\"active\"";
	else if (is_single() && $obj->post_type == "news" && $post_id == 29)
		$retVal = " class=\"active\"";
	else if (is_single() && $obj->post_type == "employee" && $post_id == 29)
		$retVal = " class=\"active\"";
	else if (is_single() && $obj->post_type == "event" && $post_id == 29)
		$retVal = " class=\"active\"";
	if ($echo) echo $retVal;
	else return $retVal;
}

/**
 * Checks if the current page is a descendent of the given page. Used in fh_check_active() above.
 */
function is_descendent($post_id) {
	if (is_page()) {
		global $wp_query;
		$ancestors = $wp_query->post->ancestors;
		if (in_array($post_id, $ancestors)) return true;
		else return false;
	}
}

/**
 * Remove default metaboxes from homepage to clear the clutter
 */
function fh_disable_metaboxes() {
	remove_meta_box('dashboard_browser_nag', 'dashboard', 'normal'); // Outdated browser notification
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // Incoming Links
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // WordPress Blog
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // Other WordPress News
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');   // Other WordPress News
}
add_action( 'admin_init', 'fh_disable_metaboxes' );

/**
 * Add Flying Hippo logo to admin and login screen
 */
function fh_login_logo() {
	echo '<style type="text/css">
		#login h1 { margin-bottom: 15px; }
		#login h1 a { background-image: url(\'' . get_bloginfo('template_directory') . '/images/fh-admin-logo.png\'); height: 80px; }
	</style>';
}

function fh_admin_logo() {
	echo '<style type="text/css">
	.index-php #icon-index { display: none; }
	.index-php .wrap h2 {
		height: 80px;
		width: 320px;
		background: transparent url(\'' . get_bloginfo('template_directory') . '/images/fh-admin-logo.png\') no-repeat center center;
	}
	.index-php .wrap h2 { text-indent: -9999px; }
</style>'."\n";
}
add_action('login_head', 'fh_login_logo');

/**
 * Generate favicon code for adding to the head. This function is called directly in header.php, and is called via a hook for the admin.
 * Optionally, the filename can be passed to the function in case it's different than 'favicon.ico'.
 */
function add_favicon_link($filename = 'favicon.ico') {
	echo "\n	<link rel=\"shortcut icon\" href=\"" . get_bloginfo('stylesheet_directory') . "/$filename\" type=\"image/x-icon\" />\n";
}
add_action('admin_head', 'add_favicon_link');

/**
 * Register blog sidebar widget area
 */
$args = array(
	'name'          => 'Blog Sidebar',
	'id'            => 'blog-sidebar',
	'description'   => 'Widget area for the blog page.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<div class="widget-title">',
	'after_title'   => '</div>'
	);
register_sidebar($args);

/**
 * Register news sidebar widget area
 */
$args = array(
	'name'          => 'News Sidebar',
	'id'            => 'news-sidebar',
	'description'   => 'Widget area for the news page.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<div class="widget-title">',
	'after_title'   => '</div>'
	);
register_sidebar($args);


/**
 * Prevent users who are not ID 1 (admin-hippo) from changing themes, regardless of their permissions.
 */
add_action('admin_init', 'fh_lock_theme');
function fh_lock_theme() {
	global $submenu, $userdata;
	get_currentuserinfo();
	if ($userdata->ID != 1) {
		unset($submenu['themes.php'][5]);
		unset($submenu['themes.php'][15]);
	}
}

/**
 * Remove Administrator from the list of available roles when the client creates a new user. It will
 *   always be available to select for user ID 1, which is always the FH administrator.
 */
function fh_editable_roles($roles) {
	global $userdata;
	get_currentuserinfo();
	if ($userdata->ID != 1)
		unset($roles['administrator']);
	return $roles;
}
add_filter('editable_roles', 'fh_editable_roles');

/**
 * Add alternate message to footer
 */
function fh_admin_footer () {
  echo '<em>Thank you for soaring with <a href="http://www.flyinghippo.com" target="_blank">Flying Hippo</a>!</em>';
}
add_filter('admin_footer_text', 'fh_admin_footer');


/**
 * Add fbroot (for use w/ XFBML).  Call directly under body tag if needed.
 */
$fbroot_set = false;
function fbroot()
{
	global $fbroot_set;
	if($fbroot_set)
	{
		goto NOGO;
	}
	$fbroot_set = true;
	?>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script><?php

	NOGO:
}

/**
 * Add Google+ lib.  Call directly under body tag if needed.
 */
$gplus_set = false;
function gplus()
{
	global $gplus_set;
	if($gplus_set)
	{
		goto NOGO;
	}
	$gplus_set = true;
	?>
	<!-- Place this render call where appropriate -->
	<script type="text/javascript">
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
	</script>
	<?php

	NOGO:
}

/**
 * Add Pinterest code.  Call within body.
 */
$pinit_set = false;
function pinit()
{
	global $pinit_set;
	if($pinit_set)
	{
		goto NOGO;
	}
	$pinit_set = true;
	echo "<script type=\"text/javascript\" defer=\"defer\" src=\"http://assets.pinterest.com/js/pinit.js\"></script>";

	NOGO:
}

/**
 * Add Twitter code.  Call anyplace in body?
 */
$twit_set = false;
function twit()
{
	global $twit_set;
	if($twit_set)
	{
		goto NOGO;
	}
	$twit_set = true;
	?>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<?php
	NOGO:
}

/**
 * Utility function to allow date-based archives for custom post types. Needs to be called for each custom post type separately.
 * These calls should be located in the functions-types-[type].php file for the post type.
 */
function fh_generate_date_archives($cpt, $wp_rewrite) {
  $rules = array();

  $post_type = get_post_type_object($cpt);
  $slug_archive = $post_type->has_archive;
  if ($slug_archive === false) return $rules;
  if ($slug_archive === true) {
    $slug_archive = $post_type->name;
  }

  $dates = array(
            array(
              'rule' => "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})",
              'vars' => array('year', 'monthnum', 'day')),
            array(
              'rule' => "([0-9]{4})/([0-9]{1,2})",
              'vars' => array('year', 'monthnum')),
            array(
              'rule' => "([0-9]{4})",
              'vars' => array('year'))
        );

  foreach ($dates as $data) {
    $query = 'index.php?post_type='.$cpt;
    $rule = $slug_archive.'/'.$data['rule'];

    $i = 1;
    foreach ($data['vars'] as $var) {
      $query.= '&'.$var.'='.$wp_rewrite->preg_index($i);
      $i++;
    }

    $rules[$rule."/?$"] = $query;
    $rules[$rule."/feed/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
    $rules[$rule."/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
    $rules[$rule."/page/([0-9]{1,})/?$"] = $query."&paged=".$wp_rewrite->preg_index($i);
  }

  return $rules;
}

/**
 * Load jQuery from Google (will work in SSL environments as well)
 */
if (!is_admin()) add_action("wp_enqueue_scripts", "fh_jquery_enqueue", 11);
function fh_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['HTTPS'] == 'on' ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}


    function dimox_breadcrumbs() {

        /* === OPTIONS === */
        $text['home']     = 'Home'; // text for the 'Home' link
        $text['category'] = 'Archive by Category "%s"'; // text for a category page
        $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
        $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
        $text['author']   = 'Articles Posted by %s'; // text for an author page
        $text['404']      = 'Error 404'; // text for the 404 page

        $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
        $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
        $show_title     = 1; // 1 - show the title for the links, 0 - don't show
        $delimiter      = ' / '; // delimiter between crumbs
        $before         = '<span class="current">'; // tag before the current crumb
        $after          = '</span>'; // tag after the current crumb
        /* === END OF OPTIONS === */

        global $post;
        $home_link    = home_url('/');
        $link_before  = '<span typeof="v:Breadcrumb">';
        $link_after   = '</span>';
        $link_attr    = ' rel="v:url" property="v:title"';
        $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
        $parent_id    = $parent_id_2 = $post->post_parent;
        $frontpage_id = get_option('page_on_front');

        if (is_home() || is_front_page()) {

            if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

        } else {

            echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
            if ($show_home_link == 1) {
                echo sprintf($link, $home_link, $text['home']);
                if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
            }

            if ( is_category() ) {
                $this_cat = get_category(get_query_var('cat'), false);
                if ($this_cat->parent != 0) {
                    $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                    if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                }
                if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

            } elseif ( is_search() ) {
                echo $before . sprintf($text['search'], get_search_query()) . $after;

            } elseif ( is_day() ) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
                echo $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {
                echo $before . get_the_time('Y') . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    if ( get_post_type() == 'event' ) { $slug = 'events'; }
                    else { $slug = $post_type->rewrite['slug'];  }

                    printf($link, $home_link . $slug . '/', $post_type->labels->singular_name);
                    if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                    if ($show_current == 1) echo $before . get_the_title() . $after;
                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;

            } elseif ( is_attachment() ) {
                $parent = get_post($parent_id);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                printf($link, get_permalink($parent), $parent->post_title);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif ( is_page() && !$parent_id ) {
                if ($show_current == 1) echo $before . get_the_title() . $after;

            } elseif ( is_page() && $parent_id ) {
                if ($parent_id != $frontpage_id) {
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                        if ($parent_id != $frontpage_id) {
                            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                        }
                        $parent_id = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        echo $breadcrumbs[$i];
                        if ($i != count($breadcrumbs)-1) echo $delimiter;
                    }
                }
                if ($show_current == 1) {
                    if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                    echo $before . get_the_title() . $after;
                }

            } elseif ( is_tag() ) {
                echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . sprintf($text['author'], $userdata->display_name) . $after;

            } elseif ( is_404() ) {
                echo $before . $text['404'] . $after;
            }

            if ( get_query_var('paged') ) {
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                echo __('Page') . ' ' . get_query_var('paged');
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
            }

            echo '</div><!-- .breadcrumbs -->';

        }
    } // end dimox_breadcrumbs()


// Crop Insurance Button
if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'sltcf_page_to_page',
		'title' => 'Sidebar Buttons',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

			array(
				'name' => 'crop_insurance_btn',
				'label' => 'Connect to Another Page',
				'description' => "Connected Page Sidebar Button will link to this page (if not selected, there will be no connecting button)",
				'scope' => array('page'),
				'type' => 'select',
				'options_type' => 'posts',
				'options_query' => array('post_type' => 'page', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'name')
			),
			array(
				'name' => 'page_button',
				'label' => 'Text for this Page',
				'description' => "This is the text that will appear in the button for this page.",
				'scope' => array('page'),
				'type' => 'text',
			),
			array(
				'name' => 'sidebar_buttons',
				'label' => 'Sidebar Buttons to Appear on This Page',
				'description' => "Upload the Sidebar Button (249px x 50px transparent .png)",
				'scope' => array('page'),
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array('textarea_rows' => 8, 'teeny' => false, 'media_buttons' => true)
			)
		)
	));
//Category Selection
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'related_posts',
		'title' => 'Related Posts',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

			array(
				'name' => 'related_post_select',
				'label' => 'Related Posts Category',
				'description' => "Select the blog category to pull the related posts at the bottom of the page. (If nothing is selected, no related articles will appear.)",
				'scope' => array('page'),
				'type' => 'select',
				'options_type' => 'terms',
				'options_query' => array('taxonomies' => 'category')
			),

			array(
				'name' => 'employee_category',
				'label' => 'Employee Category Binding',
				'scope' => array('template' => array('people-listing.php')),
				'type' => 'select',
				'options_type' => 'terms',
				'options_query' => array('taxonomies' => 'employee_categories')
			)
		)
	));

	slt_cf_register_box(array(
		"type" => "post",
		"id" => "homepage",
		"title" => "Homepage Login",
		"context" => "normal",
		"priority" => "high",
		"fields" => array(
			array(
				'name' => "homepage_login_banking",
				'label' => "Online Banking",
				'description' => "Add alert messages for login box.",
				'scope' => array('posts'=>array('132')),
				'type' => 'text'
			),
			array(
				'name' => "homepage_login_deposit",
				'label' => "Online Deposit",
				'description' => "Add alert messages for login box.",
				'scope' => array('posts'=>array('132')),
				'type' => 'text'
			),
			array(
				'name' => "homepage_login_credit",
				'label' => "Credit Card",
				'description' => "Add alert messages for login box.",
				'scope' => array('posts'=>array('132')),
				'type' => 'text'
			),
			array(
				'name' => "homepage_login_prepaid",
				'label' => "Prepaid or Gift Card",
				'description' => "Add alert messages for login box.",
				'scope' => array('posts'=>array('132')),
				'type' => 'text'
			),
			array(
				'name' => "homepage_login_other",
				'label' => "Other Services",
				'description' => "Add alert messages for login box.",
				'scope' => array('posts'=>array('132')),
				'type' => 'text'
			)
		)
	));

	slt_cf_register_box(array(
		"type" => "post",
		"id" => "sltcf_footer",
		"title" => "Footer",
		"context" => "normal",
		"priority" => "high",
		"fields" => array(
			array(
				'name' => "footer_options",
				'label' => "Footer for This Page",
				'description' => "Select the footer you'd like to appear on this page",
				"type" => "select",
				"options" => array(
					'Home Page Footer' => 'footer_home',
					'Bank & Borrow Footer' => 'footer_bank',
					'Insure Footer' => 'footer_insure',
					'Investments Footer' => 'footer_invest',
					'Trust Footer' => 'footer_trust',
					),
				"scope" => array( 'page', 'employee', 'location', 'post' )
			)
		)
	));

		//custom fields landing pages
	slt_cf_register_box(array(
		"type" => "post",
		"id" => "sltcf_landing_page",
		"title" => "Landing Page Content",
		"context" => "normal",
		"priority" => "high",
		"fields" => array(
			array(
				'name' => "landing_page_list",
				'label' => "Landing Page List",
				'description' => "This is the list that will display to the right, above the photo.",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array('textarea_rows' => 8, 'teeny' => false, 'media_buttons' => false)
				),
			array(
				'name' => "landing_page_main_text",
				'label' => "Landing Page Main Text",
				'description' => "This is the text that will appear below the main photo.",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'wysiwyg'
				),
			array(
				'name' => "landing_page_contact_message",
				'label' => "Enter Contact Message",
				'description' => "Enter the contact message text. (ex: Contact a Loan Officer)",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'text'
				),
			array(
				'name' => "landing_page_contact_img1",
				'label' => "Loan Officer Image One",
				'description' => "Upload the Loan Officer Image (width: from 205px - will display randomly)",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'file'
				),
			array(
				'name' => "landing_page_contact_img2",
				'label' => "Loan Officer Image Two",
				'description' => "Upload the Loan Officer Image (width: from 205px - will display randomly)",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'file'
				),
			array(
				'name' => "landing_page_contact_img3",
				'label' => "Loan Officer Image Three",
				'description' => "Upload the Loan Officer Image (width: from 205px - will display randomly)",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'file'
				),
			array(
				'name' => "landing_page_contact_img4",
				'label' => "Loan Officer Image Four",
				'description' => "Upload the Loan Officer Image (width: from 205px - will display randomly)",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'file'
				),
			array(
				'name' => "landing_page_loan_officer_link1",
				'label' => "Loan Officer Link One",
				'description' => "Enter the link for the loan officer text. (ex: 'http://www.facebook.com' or '/home' for pages on this site )",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'text'
				),
			array(
				'name' => "landing_page_loan_officer_link2",
				'label' => "Loan Officer Link Two",
				'description' => "Enter the link for the loan officer text. (ex: 'http://www.facebook.com' or '/home' for pages on this site)",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'text'
				),
			array(
				'name' => "landing_page_loan_officer_link3",
				'label' => "Loan Officer Link Three",
				'description' => "Enter the link for the loan officer text. (ex: 'http://www.facebook.com' or '/home' for pages on this site)",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'text'
				),
			array(
				'name' => "landing_page_loan_officer_link4",
				'label' => "Loan Officer Link Four",
				'description' => "Enter the link for the loan officer text. (ex: 'http://www.facebook.com' or '/home' for pages on this site)",
				'scope' => array(
					'template' => array("page-landing.php")),
				'type' => 'text'
				)
			)
		));

	//field to display post as another user
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'post_author',
		'title' => 'Author Content',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

array(
				'name' => 'author_sidebar',
				'label' => 'Select the author of this post',
				'description' => "If selected, this user's info will display instead of the default post author",
				'type' => 'select',
				'options_type' => 'users',
				'scope'	=> array('page')
			)
		)
	));


	// Futures API Call
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'futures-api-box',
		'title' => 'DTN Futures API',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'futures-api-call',
				'label' => 'API Call',
				'description' => "Enter the full link for the API call ",
				'type' => 'text',
				'scope' => array( 'template' => array( 'template-futures.php' ) )
			)
		)
	));

	// Creating Custom fields for Sidebar Buttons (Can edit in Sidebar Links Page)
/*	decided to give the user a content area to upload images/edit text in sidebar -- just commenting out for now
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'sltcf_sidebar_btns',
		'title' => 'Sidebar Buttons',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

			array(
				'name' => 'sidebar_btn1_link',
				'label' => '1st Sidebar Button Link',
				'description' => "Enter the URL to the 1st sidebar button: example: http://www.facebook.com",
				'scope' => array('posts'=>array('212')),
				'type' => 'text'
			),
			array(
				'name' => 'sidebar_btn1_img',
				'label' => '1st Sidebar Button Image',
				'description' => "Upload the 1st Sidebar Image",
				'scope' => array('posts'=>array('212')),
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_btn1_txt',
				'label' => 'Text for the 1st Sidebar Image',
				'description' => "Enter Text for the 1st Sidebar Image (For SEO/Accessibility)",
				'scope' => array('posts'=>array('212')),
				'type' => 'text'
			),
			array(
				'name' => 'sidebar_btn2_link',
				'label' => '2nd Sidebar Button Link',
				'description' => "Enter the URL to the 2nd sidebar button: example: http://www.facebook.com",
				'scope' => array('posts'=>array('212')),
				'type' => 'text'
			),
			array(
				'name' => 'sidebar_btn2_img',
				'label' => '2nd Sidebar Button Image',
				'description' => "Upload the 2nd Sidebar Image",
				'scope' => array('posts'=>array('212')),
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_btn2_txt',
				'label' => 'Text for the 2nd Sidebar Image',
				'description' => "Enter Text for the 2nd Sidebar Image (For SEO/Accessibility)",
				'scope' => array('posts'=>array('212')),
				'type' => 'text'
			),				array(
				'name' => 'sidebar_btn3_link',
				'label' => '3rd Sidebar Button Link',
				'description' => "Enter the URL to the 3rd sidebar button: example: http://www.facebook.com",
				'scope' => array('posts'=>array('212')),
				'type' => 'text'
			),
			array(
				'name' => 'sidebar_btn3_img',
				'label' => '3rd Sidebar Button Image',
				'description' => "Upload the 3rd Sidebar Image",
				'scope' => array('posts'=>array('212')),
				'type' => 'file'
			),
			array(
				'name' => 'sidebar_btn3_txt',
				'label' => 'Text for the 3rd Sidebar Image',
				'description' => "Enter Text for the 3rd Sidebar Image (For SEO/Accessibility)",
				'scope' => array('posts'=>array('212')),
				'type' => 'text'
			)
		)
	)); */
}

// Render the page header image. If this page doesn't have one attached, check the top level and inherit from there.
 // If the top level parent does not have one, show a fallback.
 // Echoes inline CSS by default, but returns a URL if $echo is false.

function cbcsd_page_header($echo = true) {
	global $post;
	if(is_null($post))
	{
		return;
	}
	$lpost = $post;
	$url = null;
	do
	{
		$this_background = wp_get_attachment_image_src(get_post_thumbnail_id($lpost->ID), 'main_home' );
		if ($this_background)
		{
			// Background image has been loaded, so find it and output it as an image tag.
			$url = $this_background[0];
			break;
		}
		else
		{
			if($lpost->post_parent)
			{
				$lpost = get_post($pid = $lpost->post_parent);
			}
			else
			{
				break;
			}
		}
	} while(true);

	if(is_null($url))
	{
		$url = get_bloginfo('stylesheet_directory') . '/images/default-header-photo.jpg';
	}

	if ($echo) {
		echo ' style="background: transparent url(\'' . $url . '\') no-repeat top center;"';
		return;
	} else {
		return $url;
	}
}

//landing page header
function cbcsd_landing_page_header($echo = true) {
	global $post;
	if(is_null($post))
	{
		return;
	}
	$lpost = $post;
	$url = null;
	do
	{
		$this_background = wp_get_attachment_image_src(get_post_thumbnail_id($lpost->ID), 'main_landing' );
		if ($this_background)
		{
			// Background image has been loaded, so find it and output it as an image tag.
			$url = $this_background[0];
			break;
		}
		else
		{
			if($lpost->post_parent)
			{
				$lpost = get_post($pid = $lpost->post_parent);
			}
			else
			{
				break;
			}
		}
	} while(true);

	if(is_null($url))
	{
		$url = get_bloginfo('stylesheet_directory') . '/images/default-landing-photo.jpg';
	}

	if ($echo) {
		echo ' style="background: transparent url(\'' . $url . '\') no-repeat top center;"';
		return;
	} else {
		return $url;
	}
}
//limits the number of characters in a post (for use on archive.php)
    function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
    } else {
    $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
    }

    function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
    } else {
    $content = implode(" ",$content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
    }

    function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('news');
	return $qv;
}
add_filter('request', 'myfeed_request');


function fh_get_term($term_value = 0)
{
	global $wpdb;
	if(is_numeric($term_value))
	{
		$q = $wpdb->prepare("
			SELECT t.*, ta.taxonomy
				FROM $wpdb->terms t
					INNER JOIN $wpdb->term_taxonomy ta
						ON t.term_id = ta.term_id
				WHERE t.term_id = %d;",
			$term_value
		);
	}
	else
	{
		$q = $wpdb->prepare("
			SELECT t.*, ta.taxonomy
				FROM $wpdb->terms t
					INNER JOIN $wpdb->term_taxonomy ta
						ON t.term_id = ta.term_id
				WHERE t.slug = %s;",
			$term_value
		);
	}

	return $wpdb->get_row($q);	// only one row expected...
}

function accordion_shortcode($atts, $content = null)
{
	$retval = "<div class='expand'> <a class='accordionButton' href=''>More</a><div class='accordionContent'>" . $content . "</div></div>";
	return do_shortcode($retval);
}

add_shortcode('expand', 'accordion_shortcode');

function jb_espresso_mgmt($default_role, $current_role)
{
	global $current_user;
	get_currentuserinfo();

	// We're deciding that, for this session, we forcibly depress
	// the required role ifwe determine that this user has our
	// desired capability (otherwise assume min. of administrator).
	return current_user_can("can_administer_event_espresso") ? $current_user->roles[0] : "administrator";
}
add_filter("espresso_management_capability", "jb_espresso_mgmt", 10, 2);

/// this is a comment
function my_connection_types() {
	p2p_register_connection_type( array(
		'name' => 'posts_to_pages',
		'from' => 'post',
		'to' => 'page',
		'sortable' => 'any'
	) );
}
add_action( 'p2p_init', 'my_connection_types' );

//testimonial addition
function test_callout ($atts, $content = null)
{
	return '<div class="testimonial-callout">' . $content . "</div>";
}

add_shortcode( 'testimonial_callout', 'test_callout' );

function disable_alert()
{
	$post_id;

	if( isset( $_REQUEST[ 'post' ] ) )
	{
		$post_id = $_REQUEST[ 'post' ];

		echo $post_id;
	}

	setcookie( 'alert_' . $post_id, true,  time()+60*60*24*30, '/' );

	exit;
}

add_action( 'wp_ajax_disable_alert', 'disable_alert' );
add_action( 'wp_ajax_nopriv_disable_alert', 'disable_alert' );

add_action( 'wp_head','bankmidwest_ajaxurl' );

function bankmidwest_ajaxurl() {
?>

	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>

<?php
}

/**
 * Disable responsive image support
 */

// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );


function getPageTemplateId( $template, $admin = false )
{
    global $post;

    $pageID = 0;

    if( $admin )
    {
        $key = '_fh_page_admin_template';
    }

    else
    {
        $key = '_wp_page_template';
        $template = $template . '.php';
    }

    $query = new WP_Query(
                    array(
                        'post_type'  => 'page',
                        'meta_query' => array(
                                            array(
                                                'key'   => $key,
                                                'value' => $template
                                            )
                                        )
                    )
                );

    $ids = array();

    if( $query->have_posts() )
    {
        while( $query->have_posts() )
        {
            $query->the_post();

            $ids[] = $post->ID;
        }
    }

    wp_reset_postdata();

    return $ids;
}


function the_parent_slug() {
  global $post;
  if($post->post_parent == 0) return '';
  $post_data = get_post($post->post_parent);
  return $post_data->ID;
}

/**
*   Child page conditional
*   @ Accept's page ID, page slug or page title as parameters
*/
function is_child( $parent = '' ) {
    global $post;

    $parent_obj = get_page( $post->post_parent, ARRAY_A );
    $parent = (string) $parent;
    $parent_array = (array) $parent;

    if ( in_array( (string) $parent_obj['ID'], $parent_array ) ) {
        return true;
    } elseif ( in_array( (string) $parent_obj['post_title'], $parent_array ) ) {
        return true;    
    } elseif ( in_array( (string) $parent_obj['post_name'], $parent_array ) ) {
        return true;
    } else {
        return false;
    }
}

/** 
* Converts bytes into human readable file size. 
* 
* @param string $bytes 
* @return string human readable file size (2,87 Мб)
* @author Mogilev Arseny 
*/ 
function fileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}


function featuredtoRSS($content) {
global $post;
if ( has_post_thumbnail( $post->ID ) ){
$content = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
}
return $content;
}
 
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');