<?php

 
	if($post->post_parent) {
		$ancestors = get_post_ancestors($post->ID);
		$root = count($ancestors) - 1;
		$parent = $ancestors[$root];
	} else {
		$parent = $post->ID;
	}
	
	$children = wp_list_pages("title_li=&child_of=" . $parent . "&echo=0"); ?>
	

<?php	if ($children) { ?>
		<ul class="sidenav">
			<?php echo $children; ?>
		</ul>

<?php get_sidebar('market-gadget') ?>

<div class="hm-side">
<?php 

	$postmeta = metalPostMeta( $post );

	

	//$parent = $id;  
	
	if( get_page_template_slug() == 'page-modular.php') {

		$parentTemp = 'page-modular.php';
		$blog = $postmeta->hide_blog;
		$news = $postmeta->hide_news;
		$events = $postmeta->hide_events;
	} 
	else
	{
	$parentTemp = get_page_template_slug( $id );


	$temp = new WP_Query(array(
						"page_id" => $id
					));

					while ($temp->have_posts())
					{
						$temp->the_post();
						$postmeta = metalPostMeta( $post );
						$blog = $postmeta->hide_blog;
						$news = $postmeta->hide_news;
						$events = $postmeta->hide_events;
					}
						
		}
	
	
		


	
?>
			<?php 

			if( ($blog) == true && ($parentTemp == 'page-modular.php')) { ?>
					<div class="hm-side-blog">
					<h3><a href="<?php echo get_permalink(257) ?>">Blog</a> <a href="<?php bloginfo('rss2_url'); ?>?post_type=post" target="_blank" class="rss">RSS</a></h3>

				  <?php query_posts('showposts=1'); ?>
					<?php while (have_posts()) : the_post(); ?>

				<div class="blog-title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div><!--.blog-title-->
				<div class="blog-text"><span class="blog-date"><?php the_time('n/d'); ?> </span><?php echo excerpt(10); ?></div><!--.blog-text-->
                <a href="<?php the_permalink() ?>" class="read-more">Read more</a>

			<?php endwhile; wp_reset_query(); ?>

					</div><!--.hm-side-blog-->

					<?php } ?>
					<?php if( ($news == true) && ($parentTemp == 'page-modular.php')) { ?>

					<div class="hm-side-news">
					<h3><a href="/news" class="news-title">News</a> <a href="/news/rss" class="rss" target="_blank">RSS</a></h3>

					<?php query_posts( array( 'post_type' => array('news'), 'showposts' => 2  ) ); ?>
					<?php while (have_posts()) : the_post(); ?>

						<div class="news-post">
							<div class="news-date"><?php the_time('n/d') ?></div><!--.news-date-->
							<div class="news-text"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><img src="<?php echo get_template_directory_uri(); ?>/images/arrow-green.png" width="5" height="9" class="arrow" /> </div><!--.news-text-->
						</div><!--.news-post-->

					<?php endwhile; wp_reset_query(); ?>

						<div class="dozer"></div><!--.dozer-->
					</div><!--.hm-side-news-->
					<?php } ?>
					<?php if( ($events == true) && ($parentTemp == 'page-modular.php')) { ?>
					<div class="hm-side-events">
					<h3><a href="/events" class="news-title">Events</a></h3>


					<?php
					$q = new WP_Query(array(
						"post_type" => "event",
						"posts_per_page" => 2,
						"event_filter" => "upcoming"
					));

					while ($q->have_posts())
					{
						$q->the_post();

						$end_date = preg_replace("/000$/", "", slt_cf_field_value("end_date"));
		?>


						<div class="event-post">
							<div class="news-date"><?php echo _iff(
									date("n/d", preg_replace("/000$/", "", slt_cf_field_value("event_date"))),
									''
								); ?> </div><!--.news-date-->
							<div class="news-text"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><img src="<?php echo get_template_directory_uri(); ?>/images/arrow-green.png" width="5" height="9" class="arrow" /> </div><!--.news-text-->
						</div><!--.news-post-->

						<?php
					}
					wp_reset_query();
					?>

						<div class="dozer"></div><!--.dozer-->
					</div><!--.hm-side-events-->

					<?php } ?>


<?php get_sidebar('bottom-links'); ?>

</div>

<div class="side-links">

	<?php 

	if (is_page() ) {

		$btn = slt_cf_field_value('sidebar_buttons'); 
	 	
	 	if ( !empty ($btn)) { echo do_shortcode($btn); }

		else { ?>

			<a class="btn" style="background: url(<?php echo $btn1Location[0]; ?>)" href="<?php $btn1Link= slt_cf_field_value('sidebar_btn1_link', 'post', '212'); if($btn1Link) { echo $btn1Link; } ?>">
				<?php $btn1Txt = slt_cf_field_value('sidebar_btn1_txt', 'post', '212'); if($btn1Txt) { echo $btn1Txt; } ?></a>

			<a class="btn" style="background: url(<?php echo $btn2Location[0]; ?>)" href="<?php $btn2Link= slt_cf_field_value('sidebar_btn1_link', 'post', '212'); if($btn2Link) { echo $btn2Link; } ?>">
				<?php $btn2Txt = slt_cf_field_value('sidebar_btn2_txt', 'post', '212'); if($btn1Txt) { echo $btn1Txt; } ?></a>

			<a class="btn" style="background: url(<?php echo $btn3Location[0]; ?>)" href="<?php $btn3Link= slt_cf_field_value('sidebar_btn3_link', 'post', '212'); if($btn3Link) { echo $btn3Link; } ?>">
				<?php $btn3Txt = slt_cf_field_value('sidebar_btn3_txt', 'post', '212'); if($btn3Txt) { echo $btn3Txt; } ?></a>
	<?php 

		} 

	}  

	$parent = $post->post_parent;
	$parentID = get_post_ancestors($post->ID);

		if (empty($parentID[1])) {
	
		} else if (($parent == 9) || ( $parentID[1] == 9 )) { ?>

			<a href="<?php echo get_permalink(823); ?>" class="btn news">Sign up for our weekly newsletter</a>

		<?php } ?>


</div>

<?php 

if (is_page()) {

	$f = slt_cf_field_value('crop_insurance_btn'); 
	$pageBtn = slt_cf_field_value('page_button');
	if ( !empty ($f) ) {

		if ( !empty($pageBtn) ) { ?>
		
		<a class="sidebtn" href="<?php echo get_permalink($f); ?>"><?php echo $pageBtn; ?></a>

		<?php } else { ?>


		<a class="sidebtn" href="<?php echo get_permalink($f); ?>"><?php echo get_the_title($f); ?></a>


		<?php }

	}

}
}
?>         
