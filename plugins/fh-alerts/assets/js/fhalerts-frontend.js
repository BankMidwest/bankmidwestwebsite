// Add alert if available
/*function addAlert()
{
    'use strict';
    var $ = jQuery;

    var data = {
        action: 'addAlert'
    };

    $.ajax({
        url: ajaxurl,
        method: 'POST',
        data: data,
        success: function( html )
        {
            $( 'body' ).prepend( html );
        }
    });
}*/

// Remove current alert
function removeAlert( e )
{
    'use strict';
    var $ = jQuery;

    // Cache $( this )
    var $this = $( this );

    // Hide alert right away
    $( '#fhalerts' ).slideUp( 400 );

    // Get post id, which will be used to create cookie for just this alert post
    var id = $this.attr( 'data-id' );

    // Pass data to functions.php
    var data = {
        action: 'disable_alert',
        post: id
    };

    $.ajax({
        url: ajaxurl,
        method: 'POST',
        data: data,
        success: function( returned_data )
        {
        }
    });

    e.preventDefault();
}

(function( $ ) {
    'use strict';
    var $ = jQuery;

    // Add any alerts to
    //addAlert();

    // Dismiss the alert
    $( 'body' ).on( 'click', '.fhdismiss-alert', removeAlert );
})( jQuery );