<?php
/*
 * Plugin Name: FH Testimonials
 * Description: CPW-aware testimonial engine -- provides the necessary type and rendering capabilities.
 * Version: 1.0.1 CPW
 * Author: Flying Hippo Web Creations
 * Author URI: http://www.flyinghippo.com/
 */
require_once('post_type.php');
require_once('widget.php');

function testimonial_shortcode($atts = array())
{
	
	$posts = fhcpw_enumerator_testimonial_default($atts);
	return  fhcpw_renderer_testimonial_default($posts);
}
add_shortcode("testimonial", "testimonial_shortcode");
?>
