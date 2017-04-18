<?php
	// NEW TEMPLATE API Call for Corn & Soybeans
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'feed-api-box',
		'title' => 'DTN API',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'feed-api-call',
				'label' => 'API Call for Corn and Soybeans',
				'description' => "Enter the full link for the API call ",
				'type' => 'text',
				'scope' => array( 'template' => array( 'template-api.php' ) )
			)	
		)
	));    
    
	// NEW TEMPLATE API Call for Live Cattle & Lean Hogs
	slt_cf_register_box(array(
		'type' => 'post', //either "post" or "user"
		'id' => 'animals-api-box',
		'title' => 'DTN API',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'animals-api-call',
				'label' => 'API Call for Live Cattle and Lean Hogs',
				'description' => "Enter the full link for the API call ",
				'type' => 'text',
				'scope' => array( 'template' => array( 'template-api.php' ) )
			)	
		)
	));