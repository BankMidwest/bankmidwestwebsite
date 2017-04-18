<?php
/* Enqueue frontend scripts */
function fhalertsEnqueueFrontEndScripts()
{
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'fhevents-frontend-script', plugin_dir_url( __FILE__ ) . 'assets/js/fhalerts-frontend.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_style( 'fhevents-frontend-style', plugin_dir_url( __FILE__ ) . 'assets/css/fhalerts-frontend.css', '', '1.0', 'screen' );
}

add_action( 'wp_enqueue_scripts', 'fhalertsEnqueueFrontEndScripts' );
