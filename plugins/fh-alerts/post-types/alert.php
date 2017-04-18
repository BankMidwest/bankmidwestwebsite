<?php
function registerPostTypeFHAlerts()
{
	$labels = array(
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New',
        'edit_item'          => 'Edit',
        'menu_name'          => 'Alerts',
        'name'               => 'Alert',
        'new_item'           => 'New Alert',
        'not_found'          => 'No alerts found',
        'not_found_in_trash' => 'No alerts found in trash',
        'search_items'       => 'Search',
        'singular_name'      => 'Alert',
        'view_item'          => 'View',
    );

    $args = array( 
        'labels'              => $labels,
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'publicly_queryable'  => true,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'show_in_nav_menus'   => false,
        'exclude_from_search' => false,
        'supports'            => array( 'title', 'editor' ),
        'capability_type'     => 'fhalerts',
        'menu_icon'           => 'dashicons-megaphone'
    );

    register_post_type( 'fhalerts', $args );

    // Verify capabilities
    fh_alerts_register_capabilities( 'fhalerts' );
}


// Ajax call back
function fhDisableAlert()
{
	$post_id;

	if( isset( $_REQUEST[ 'post' ] ) )
	{
		$post_id = $_REQUEST[ 'post' ];
	}

	setcookie( 'fhalert_' . $post_id, true,  time() + 60 * 60 * 24 * 30, '/' );

	echo $_COOKIE[ 'fhalert_' . $post_id ];

	exit;
}

function fhAppendAlert( $atts )
{
	// Get path to file that will display the alert and set empty variable that will contain the html output
	$output_path = apply_filters( 'fhalerts_directory_path', 'output/output-alert.php' );
	$html        = '';

	// Use output buffering to prevent issues
	ob_start();

		// Include output/output-alert.php which will give us the actual html
		include( $output_path );

	// Simultaneously store the output into the $html variable, and then close the output buffering
	$html = ob_get_clean();

	// Echo output using $html variable, which will then be returned back to fhalerts-frontend.js (in the addAlert function in that file)
	return $html;

	exit;
}

function fhalertAjaxURL()
{
?>

	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
	</script>

<?php
}

add_action( 'init', 'registerPostTypeFHAlerts' );

add_action( 'wp_ajax_disable_alert', 'fhDisableAlert' );
add_action( 'wp_ajax_nopriv_disable_alert', 'fhDisableAlert' );

add_shortcode( 'fhalert', 'fhAppendAlert' );

add_action( 'wp_head', 'fhalertAjaxURL' );