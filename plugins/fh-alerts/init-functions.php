<?php
// Plugin Directory URL
function fhalerts_directory_url( $val = null )
{
	return plugin_dir_url( __FILE__ ) . $val;
}

// Plugin Directory Path
function fhalerts_directory_path( $val = null )
{
	return plugin_dir_path( __FILE__ ) . $val;
}


// Filters
add_filter( 'fhalerts_directory_url', 'fhalerts_directory_url' );
add_filter( 'fhalerts_directory_path', 'fhalerts_directory_path' );