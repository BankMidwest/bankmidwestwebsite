<?php
// Template Name: Page (Bare)
get_header("bare");
the_post();
global $post;
?>
	<div id="main">
		<?php the_content(); ?>
	</div>
<?php
get_footer("bare");
?>
