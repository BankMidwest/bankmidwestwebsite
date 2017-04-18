<?php
/* Template Name: Wide Content */
get_header(); the_post(); global $post;
?>
<!-- page-wide.php -->
<div id="main">

	<div class="inner">

		<div class="inner-hm-content">

			<div class="hm-content content-wide">

				<div class="title-image" <?php echo cbcsd_page_header(true); ?> >

					<h1 class="page-title"><?php the_title(); ?></h1>

				</div><!--.title-image-->

				<div class="dozer"></div><!--.dozer-->

				<div id="content" >

					<div id="inner-content">

							<div class="int-text">

							<div class="crumb"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>

								<?php the_content(); ?>

							</div><!--.int-text-->

						<!-- end the_content(); -->

					</div><!-- #inner-content -->

				</div><!-- #content -->

				<div class="dozer"></div><!--.dozer-->
			
			</div><!--.hm-content-->

		</div><!--.inner-hm-content-->

		<div class="dozer"></div><!--.dozer-->

	</div><!--.inner-->

</div><!-- #main -->


<?php get_footer(); ?>
