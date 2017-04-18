<?php
/* BEGIN static wireup */
define('WP_USE_THEMES', false);

require('../../../wp-blog-header.php');
header("HTTP/1.1 200 OK");
header("Status: 200 All rosy");
/* END static wireup */

$retVal = new stdClass();
$retVal->success = false;
$retVal->message = "The process was interrupted.";

try
{
	if(!isset($_REQUEST['location']))
	{
		// Needs to be present to work with it!
		$retVal->message = "Missing location identifier";
	}
	else
	{
		$matched = preg_match("/(.*)_(\d+)/", $_REQUEST['location'], $matches);
		if(!$matched)
		{
			// Our identifier didn't present in the expected format
			$retVal->message = "The location identifier was malformed.";
		}
		else
		{
			// matches breaks down as follows
			//	[0] = full identifier (not used)
			//	[1] = taxonomy slug (not used)
			//	[2] = post ID (for the corresponding location)
			$pid = intval($matches[2]);
			
			// We need the following from this guy:
			//	* title
			//	* thumbnail IMG url
			//	* address
			//	* phone
			//	* fax
			//	* subtitle
			//	* hours
			//	* permalink

			$smpost = get_the_stuff($pid, array('post_title'));
			$retVal->title = esc_html($smpost->post_title);
			if(has_post_thumbnail($pid))
			{
				$imgid = get_post_thumbnail_id($pid);
				$tis = wp_get_attachment_image_src($imgid, 'location_thumb', true);
				$retVal->thumbnail = $tis[0];
			}
			else
			{
				$retVal->thumbnail = false;
			}

			$retVal->address = slt_cf_field_value('address', 'post', $pid);
			$retVal->subtitle = slt_cf_field_value('subtitle', 'post', $pid);
			$retVal->phone = slt_cf_field_value('phone', 'post', $pid);
			$retVal->fax = slt_cf_field_value('fax', 'post', $pid);
			$retVal->hours = slt_cf_field_value('hours', 'post', $pid);
			$retVal->permalink = get_permalink($pid);

			$ldesc = slt_cf_field_value('location_description');
			$retVal->full = !empty($ldesc);

			$retVal->success = true;
			unset($retVal->message);
		}
	}
}
catch(Exception $exc)
{
	$retVal->message = sprintf("One or more errors occurred:\n" + $exc->getMessage());
}

echo json_encode($retVal);
?>
