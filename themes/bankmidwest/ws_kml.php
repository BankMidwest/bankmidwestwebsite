<?php
/* BEGIN static wireup */
define('WP_USE_THEMES', false);

require('../../../wp-blog-header.php');
header("HTTP/1.1 200 OK");
header("Status: 200 All rosy");
/* END static wireup */

/*
if(!isset($_REQUEST['category']))
{
	die("Category required");
}
*/

$category_id = intval($_REQUEST['category']);

echo kml_render_document_by_category($category_id);
?>