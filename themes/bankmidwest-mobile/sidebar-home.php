<?php
global $wp_query;
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
					<div class="hm-side-blog">
					<h3><a href="<?php echo get_permalink(257) ?>">Blog</a> <a href="<?php bloginfo('rss2_url'); ?>" target="_blank" class="rss">RSS</a></h3>

				  <?php query_posts('showposts=1'); ?>
					<?php while (have_posts()) : the_post(); ?>

				<div class="blog-title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div><!--.blog-title-->
				<div class="blog-text"><span class="blog-date"><?php the_time('n/d'); ?> </span><?php echo excerpt(10); ?></div><!--.blog-text-->
                <a href="<?php the_permalink() ?>" class="read-more">Read more</a>

			<?php endwhile; wp_reset_query(); ?>

					</div><!--.hm-side-blog-->
				
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

					<div class="hm-side-events">
					<h3><a href="/events" class="news-title">Events</a></h3>


					<?php
					//query_posts( array( 'post_type' => array('event'), 'showposts' => 2  ) );
					$oldQuery = $wp_query;
					$wp_query = new WP_Query(array(
						"post_type" => "event",
						"posts_per_page" => 2,
						"event_filter" => "upcoming"
					));
					while (have_posts())
					{
						the_post(); 
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
					$wp_query = $oldQuery;
					wp_reset_query(); 
					?>

						<div class="dozer"></div><!--.dozer-->
					</div><!--.hm-side-events-->


					
                <?php get_sidebar('bottom-links'); ?>
                <div class='sidebar-buttons'>
                    <div class='sidebar-button'>
                        <a title="Available on the App Store" href="http://itunes.apple.com/us/app/bank-midwest-mobile/id533868909?mt=8" target="_blank">
                            <img class="alignright" title="Available on the App Store" src="https://www.bankmidwest.com/wp-content/uploads/2013/08/icon_App_Store_Badge.png" alt="App Store" width="145" height="50" />
                        </a>
                    </div>
                    <div class='sidebar-button'>
                        <a href="https://play.google.com/store/apps/details?id=com.fi6235.godough" target="_blank">
                            <img class="alignright" title="Get it on Google Play" src="https://www.bankmidwest.com/wp-content/uploads/2013/08/icon_get_it_on_play_logo_170x60.png" alt="Mobile Banking App: Get It On Google Play" width="144" height="50" />
                        </a>
                    </div>
                </div>
    
					<?php /*
					<div class="facebook"><a href="http://www.facebook.com"></a></div><!--.facebook-->

<div class="fb-like" data-href="http://www.bankmidwest.com" data-send="false" data-width="225" data-show-faces="true"></div> */ ?>
				
				</div><!--.hm-side-->
