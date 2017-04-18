<?php
session_start();

// Form 14 is the submission form for individual contacts
add_filter("gform_pre_render_14", function($form) {
	if(isset($_GET["employee_id"]) && is_numeric($_GET["employee_id"])) {
		foreach($form["fields"] as $k => $field) {
			if($field['id'] == 10) {
				// Field 10 is the free-form HTML region that describes this employee
				$post = get_post($_GET["employee_id"]);
				$employee_name = $post->post_title;
				$employee_title = slt_cf_field_value('employee_title');
				$employee_phone = slt_cf_field_value('employee_phone');
				$form["fields"][$k]["content"] = sprintf(<<<TXT
<h1>Contact:&nbsp;%s</h1>
<div id="ContactFormProfileCell">
	<div class="title">%s</div>
	<div class="phone">%s</div>
</div>
TXT
				, htmlentities($employee_name)
				, htmlentities($employee_title)
				, htmlentities($employee_phone)
			);

			} else if($field['id'] == 9) {
				// Field 9 is the "employee" hidden value
				$form["fields"][$k]["defaultValue"] = $post->ID;
			}
		}
	}
	return $form;
});

add_action("gform_after_submission_14", function($entry, $form) {
	if(empty($entry['9'])) {
		// Without knowing the employee ID, we can't send a message.
		return;
	}
	$obj = get_post($entry['9']);
	if($obj == null) {
		return;
	}
	$title = $obj->post_title;
	$email = slt_cf_field_value("employee_email", "post", $obj->ID);
	add_filter("wp_mail_content_type", function() { return "text/html"; });
	wp_mail(
		"\"{$title}\" <{$email}>", 
		"Request for information sent from bankmidwest.com",
		<<<email
<p>An online submission from the Contact Me form for your profile was sent with the following information:</p>

<ul>
	<li>
		<strong>Name:</strong>
		<p>{$entry['1.3']} {$entry['1.6']}</p>
	</li>
	<li>
		<strong>Phone:</strong>
		<p>{$entry['3']}</p>
	</li>
	<li>
		<strong>Email:</strong>
		<p>{$entry['4']}</p>
	</li>
	<li>
		<strong>Question or Comments:</strong>
		<p>{$entry['7']}</p>
	</li>
</ul>
email
		, 
		"From: \"{$entry['1.6']}, {$entry['1.3']}\" <{$entry['4']}>\r\n"
	);
}, 10, 2);

// Borrowed from http://www.linuxjournal.com/article/9585
function check_email_address($email) {
	// First, we check that there's one @ symbol, 
	// and that the lengths are right.
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		// Email invalid because wrong number of characters 
		// in one section or wrong number of @ symbols.
		return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			return false;
		}
	}
	// Check if domain is IP. If not, 
	// it should be valid domain name
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
				return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}

add_action("wp_ajax_submit_contact_form", "submit_contact_form");
add_action("wp_ajax_nopriv_submit_contact_form", "submit_contact_form");
function submit_contact_form() {
	require_once(dirname(__FILE__).'/../../../wp-includes/pluggable.php');

	$retVal->success = false;
	// Need to know some information:

	if(!isset($_POST['contact_id']) || empty($_POST['contact_id']))
	{
		$retVal->errors = array("contact_id" => "A contact was not properly selected when sending this message.");
		echo json_encode($retVal);
		die;
	}
	$contact = get_post($default_contact_id = $_POST['contact_id']);
	$email = slt_cf_field_value("employee_email", "post", $contact->ID);

	$errors = array();
	foreach(array("contactname", "contactemail", "contactphone", "contactmessage") as $reqField)
	{
		if(!isset($_POST[$reqField]) || empty($_POST[$reqField]))
		{
			$errors[$reqField] = "This field is required";
		}
	}
	if(sizeof($errors))
	{
		$retVal->errors = $errors;
		echo json_encode($retVal);
		die;
	}

	// Validate the email address
	if(!check_email_address($_POST['contactemail']))
	{
		$retVal->errors = array("contactemail" => "Email address format is unrecognized or not valid.");
		echo json_encode($retVal);
		die;
	}

	/*
	// Validate Captcha data
	$si = new Securimage();
	if(!$si->check($_POST['captcha_code']))
	{
		$retVal->errors = array("captcha_code" => "This entry failed validation; please refresh or retry.");
		echo json_encode($retVal);
		die;
	}
	*/
	$retVal->resp = $resp;

	// Wire up wp_mail to send our email message
	//$to = $email;
	$to = "jbell@flyinghippo.com";
	$subject = "Request for information sent from bankmidwest.com";
	$body = sprintf("Name: %s\rEmail: %s\rPhone: %s\rMessage: %s", $_POST['contactname'], $_POST['contactemail'], $_POST['contactphone'], $_POST['contactmessage']);
	wp_mail($to, $subject, $body);

	$retVal->success = true;
	echo json_encode($retVal);
	die;
}

?>
