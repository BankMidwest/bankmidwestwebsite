<?php

function espresso_display_worldpay($payment_data) {
	extract($payment_data);

	include_once ('Worldpay.php');

	global $wpdb, $org_options;

	$myworldpay = new Espresso_Worldpay(); // initiate an instance of the class
	echo '<!-- Event Espresso WorldPay Gateway Version ' . $myworldpay->worldpay_gateway_version . '-->';
	$worldpay_settings = get_option('event_espresso_worldpay_settings');
	$use_sandbox = $worldpay_settings['use_sandbox'];
	if ($use_sandbox) {
		$myworldpay->enableTestMode();
	}
	if ($use_sandbox) {
		// Enable test mode if needed
		$myworldpay->addField('testMode', '100');
	}
	$myworldpay->addField('instId', $worldpay_settings['worldpay_id']);
	$myworldpay->addField('cartId', 'wp-' . event_espresso_session_id());
	$myworldpay->addField('amount', $event_cost);
	$myworldpay->addField('MC_id', $attendee_id);
	$myworldpay->addField('MC_registration_id', $registration_id);
	$myworldpay->addField('MC_type', 'worldpay');
	$myworldpay->addField('currency', $worldpay_settings['currency_format']);

	if (!empty($worldpay_settings['bypass_payment_page'])) {
		$myworldpay->submitPayment(); //Enable auto redirect to payment site
	} else {
		if (empty($worldpay_settings['button_url'])) {
			if (file_exists(EVENT_ESPRESSO_GATEWAY_DIR . "/worldpay/worldpay-logo.png")) {
				$button_url = EVENT_ESPRESSO_GATEWAY_DIR . "/worldpay/worldpay-logo.png";
			} else {
				$button_url = EVENT_ESPRESSO_PLUGINFULLURL . "gateways/worldpay/worldpay-logo.png";
			}
		} elseif (isset($worldpay_settings['button_url'])) {
			$button_url = $worldpay_settings['button_url'];
		} else {
			//If no other buttons exist, then use the default location
			$button_url = EVENT_ESPRESSO_PLUGINFULLURL . "gateways/worldpay/worldpay-logo.png";
		}
		$myworldpay->submitButton($button_url, 'worldpay'); //Display payment button
	}

	if ($use_sandbox) {

		echo '<h3 style="color:#ff0000;" title="Payments will not be processed">' . __('WorldPay Debug Mode Is Turned On', 'event_espresso') . '</h3>';
		$myworldpay->dump_fields(); // for debugging, output a table of all the fields
	}
}

add_action('action_hook_espresso_display_offsite_payment_gateway', 'espresso_display_worldpay');