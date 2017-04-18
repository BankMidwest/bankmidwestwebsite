<!DOCTYPE html>
<html  class="no-js" <?php language_attributes(); fh_html(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
   
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<title><?php wp_title(''); ?></title>
   	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
   	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/style-print.css" media="print">

   	<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="image_src" href="<?php bloginfo('stylesheet_directory'); ?>/screenshot.jpg" />

	<?php if (function_exists('add_favicon_link')) add_favicon_link(); ?>
	<!-- WP
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
      -->
	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_head(); ?>
 	
	<script src="https://www.google.com/jsapi" type="text/javascript"></script>
	
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/inc/toggleLabel.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/inc/AnythingSlider/css/anythingslider.css" />
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/inc/AnythingSlider/js/jquery.anythingslider.min.js"></script>
	<!-- Load ie.css for IE 6 and 7. Delete the below if you do not need an IE-specific stylesheet, or change the LTE value if you need it to apply to 8 or 9 as well. -->
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/ie.css" />
	<![endif]-->
	
</head>

<body <?php body_class(); ?>>
	<div id="wrapper">
