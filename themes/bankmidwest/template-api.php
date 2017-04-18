<?php 
    // Template Name: API Page

	// API and SLT taken from Futures Page Template
	get_header( 'api' );
    
    // FEED
        //open connection
        $ch_feed = curl_init( slt_cf_field_value( 'feed-api-call' ) );
        curl_setopt($ch_feed, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch_feed,CURLOPT_SSL_VERIFYPEER, false);
        $content_feed = curl_exec( $ch_feed );

    
    // ANIMALS
        $ch_animals = curl_init( slt_cf_field_value( 'animals-api-call' ) );
        curl_setopt($ch_animals, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch_animals,CURLOPT_SSL_VERIFYPEER, false);
        $content_animals = curl_exec( $ch_animals );
?>

<?php
        //close connection
        curl_close($ch_feed);

        //close connection
        curl_close($ch_animals);
?>

    <div class='wrapper'>
        <div class='wrapper-int'>
            <div class='left-column'>
                <?php echo $content_feed; ?>
            </div><!-- left-column -->

            <div class='right-column'>
                <?php echo $content_animals; ?>
            </div><!-- right-column -->
            
            <div class='clear'></div>
            
            <div class='disclaimer hack'><a href='http://www.dtnprogressivefarmer.com/dtnag' target='_blank' title='DTN The Progressive Farmer'></a></div>
        </div>
    </div><!-- wrapper-->

    <!-- grey band -->
    <div class='footer hack'></div>

</body><!-- page-api-->
</html>