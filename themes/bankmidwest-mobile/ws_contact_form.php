<?php
session_start();

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

/* BEGIN static wireup */
define('WP_USE_THEMES', false);

require('../../../wp-blog-header.php');
require('../../../wp-includes/pluggable.php');
//require('inc/securimage/securimage.php');

header("HTTP/1.1 200 OK");
header("Status: 200 All rosy");
/* END static wireup */

$retVal->success = false;
// Need to know some information:

if(!isset($_REQUEST['contact_id']) || empty($_REQUEST['contact_id']))
{
	$retVal->errors = array("contact_id" => "A contact was not properly selected when sending this message.");
	echo json_encode($retVal);
	die;
}
$contact = get_post($default_contact_id = $_REQUEST['contact_id']);
$email = slt_cf_field_value("employee_email", "post", $contact->ID);

$errors = array();
foreach(array("contactname", "contactemail", "contactphone", "contactmessage") as $reqField)
{
	if(!isset($_REQUEST[$reqField]) || empty($_REQUEST[$reqField]))
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
if(!check_email_address($_REQUEST['contactemail']))
{
	$retVal->errors = array("contactemail" => "Email address format is unrecognized or not valid.");
	echo json_encode($retVal);
	die;
}

/*
// Validate Captcha data
$si = new Securimage();
if(!$si->check($_REQUEST['captcha_code']))
{
	$retVal->errors = array("captcha_code" => "This entry failed validation; please refresh or retry.");
	echo json_encode($retVal);
	die;
}
*/
$retVal->resp = $resp;

// Wire up wp_mail to send our email message
//$to = $email;
$to = "msmith@flyinghippo.com";
$subject = "Request for information sent from bankmidwest.com";
$body = sprintf("Name: %s\rEmail: %s\rPhone: %s\rMessage: %s", $_REQUEST['contactname'], $_REQUEST['contactemail'], $_REQUEST['contactphone'], $_REQUEST['contactmessage']);
wp_mail($to, $subject, $body);

$retVal->success = true;
echo json_encode($retVal);
die;

?>