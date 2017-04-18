<?php 
	// Template Name: Futures Page
	get_header( 'bare' );

	//open connection
	$ch = curl_init( slt_cf_field_value( 'futures-api-call' ) );

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

	$content = curl_exec( $ch );

	//close connection
	curl_close($ch);

	echo $content;
?>

<?php get_footer(); ?>