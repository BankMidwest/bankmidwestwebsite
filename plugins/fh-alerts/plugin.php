<?php
/**
 * Plugin Name: FH Alerts
 * Plugin URI: http://plugins.flyinghippo.com/fh-alerts
 * Description: Extensible post type and related functionality to provide alerts at the top of your site
 * Version: 0.2
 * Author: Flying Hippo Web Creations
 * Author URI: http://www.flyinghippo.com/
 */

require_once 'init-functions.php';
require_once 'functions-alerts-typeregistration.php';
require_once 'init.php';
require_once 'post-types/alert.php';

if( !class_exists( 'FHAlerts' ) )
{
    class FHAlerts {

        function __construct()
        {
        }

        // Repurposed from WooCommerce plugin to output pages using shortcodes
        // while making sure the output pattern matches what the admin puts
        // into the post editor
        function shortcode_wrapper( $function, $atts = array() )
        {
            ob_start();
                
                echo '<div class="fhalerts" id="fhalerts">';
                    call_user_func( $function, $atts );
                echo '</div>';
            
            return ob_get_clean();
        }
    }

    $GLOBALS[ 'fhalerts' ] = new FHAlerts();
}