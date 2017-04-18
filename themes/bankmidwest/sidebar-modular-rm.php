<?php 

echo 'modular sidebar';

function _iff($conditional, $operand)
{
	if($conditional)
	{
		return $conditional . $operand;
	}
}?>

<?php
if (is_page(4) || is_page(18) || is_page(7) || is_page(9)) {

$parent = $post->ID;
$args = array(
		'depth' => 1,
		'child_of' => $parent,
		'title_li'     => '',
	); ?>

<ul class="sidenav showchildren">
	<?php	wp_list_pages($args);  ?>
</ul>
 <?php } ?>

 <?php get_sidebar('market-gadget') ?>


<div class="hm-side">
<?php $postmeta = metalPostMeta( $post );

	$parent = the_parent_slug();  
	
	if( get_page_template_slug() == 'page-modular.php') {

		$parentTemp = 'page-modular.php';
	} 
	else
	{
	$parentTemp = get_page_template_slug( $parent );
	}
	//echo $parentTemp;


	

		$blog = $postmeta->hide_blog;
		$news = $postmeta->hide_news;
		$events = $postmeta->hide_events;
		// echo 'foobar';
		// echo $post->ID;
	
	
		
				

	
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



	

					<?php /*
					<div class="facebook"><a href="http://www.facebook.com"></a></div><!--.facebook-->

<div class="fb-like" data-href="http://www.bankmidwest.com" data-send="false" data-width="225" data-show-faces="true"></div> */ ?>

				</div><!--.hm-side-->
