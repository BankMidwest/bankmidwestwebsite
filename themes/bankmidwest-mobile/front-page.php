<?php
/* Homepage template */

global $wp_query; 
$oldquery = $wp_query; 

get_header();
?>

		<div id="main" class="home">
			<div class="inner">
				<div class="banner">
					<div class="overlay">
						<h2><?php echo get_field('banner_heading'); ?></h2>
                        <h3><?php echo get_field('banner_subhead'); ?></h3>
                        <a class="button" href="<?php echo get_field('banner_button_url'); ?>"><?php echo get_field('banner_button_text'); ?></a>
					</div>
				</div>
			<div class="slider">
					<div class="slider-main-image">
						
				
						<div id="sliderContainer">

					<?php 

					$args = array( 	'post_type' => array('homepage_slider'), 
									'orderby' => 'menu_order', 
									'order' => 'ASC',
									'posts_per_page' => 1  );


					query_posts($args); ?>
					<?php while (have_posts()) : the_post(); ?>
	
						<div class="mainimg"><?php the_post_thumbnail('mobile_home');  ?></div>

					<?php endwhile; ?>

					<?php 
			    		$wp_query = $oldquery; 
			 			the_post();  wp_reset_query();
			    	?>

						</div><!-- slider Container -->
					</div><!--.slider-main-image-->
			</div><!--.slider-->
			
			<div class="inner-hm-content">
				
				
				<div class="hm-content">
					<div class="important-info">
						<h2>Important Information</h2>
						<div class="step-block">
							<h3>Step 1 ></h3>
							<p>First, re-enroll in Online Banking and Bill Pay.  Review scheduled transfers and bill payments.</p>
						</div>
						<div class="step-block">
							<h3>Step 2 ></h3>
							<p>Then, download the NEW Mobile Banking app and login.</p>
						</div>
						<div class="step-block">
							<h3>Step 3 ></h3>
							<p>Contact <span class="home-contact">888.902.5662</span> or <span class="home-contact">customersupport@bankmidwest.com</span>.</p>
						</div>
					</div>
					<div class="home-help">
						<h2><span><?php echo get_field('how_heading'); ?></span></h2>

	                    <div class="service">
	                        <a href="<?php echo get_field('icon_1_url'); ?>">
	                            <p><?php echo get_field('icon_1_text'); ?></p>
	                            <p class="arrow"> > </p>
	                        </a>
	                    </div>

	                    <div class="service">
	                        <a href="<?php echo get_field('icon_2_url'); ?>">
	                            <p><?php echo get_field('icon_2_text'); ?></p>
	                            <p class="arrow"> > </p>
	                        </a>
	                    </div>

	                    <div class="service">
	                        <a href="<?php echo get_field('icon_3_url'); ?>">
	                            <p><?php echo get_field('icon_3_text'); ?></p>
	                            <p class="arrow"> > </p>
	                        </a>
	                    </div>

	                    <div class="service">
	                        <a href="<?php echo get_field('icon_4_url'); ?>">
	                            <p><?php echo get_field('icon_4_text'); ?></p>
	                            <p class="arrow"> > </p>
	                        </a>
	                    </div>

	                    <div class="service">
	                        <a href="<?php echo get_field('icon_5_url'); ?>">
	                            <p><?php echo get_field('icon_5_text'); ?></p>
	                            <p class="arrow"> > </p>
	                        </a>
	                    </div>

	                    <div class="service">
	                        <a href="<?php echo get_field('icon_6_url'); ?>">
	                            <p><?php echo get_field('icon_6_text'); ?></p>
	                            <p class="arrow"> > </p>
	                        </a>
	                    </div>
					</div>
					<div class="community-block">
						<h2><div><span><?php echo get_field('community_heading'); ?></span></div></h2>
	                    <h3 class="subhead"><?php echo get_field('community_subhead'); ?></h3>
	                    <?php echo get_field('community_text'); ?>
					</div>
					<div class="stats-block">
						<div class="stat">
                            <div class="top"><?php echo get_field('stat_1_top'); ?></div>
                            <div class="amount"><?php echo get_field('stat_1_amount'); ?></div>
                            <div class="type"><?php echo get_field('stat_1_type'); ?></div>
                        </div>
                        <div class="stat">
                            <div class="top"><?php echo get_field('stat_2_top'); ?></div>
                            <div class="amount"><?php echo get_field('stat_2_amount'); ?></div>
                            <div class="type"><?php echo get_field('stat_2_type'); ?></div>
                        </div>
                        <div class="stat">
                            <div class="top"><?php echo get_field('stat_3_top'); ?></div>
                            <div class="amount"><?php echo get_field('stat_3_amount'); ?></div>
                            <div class="type"><?php echo get_field('stat_3_type'); ?></div>
                        </div>
                        <div class="stat">
                            <div class="top"><?php echo get_field('stat_4_top'); ?></div>
                            <div class="amount"><?php echo get_field('stat_4_amount'); ?></div>
                            <div class="type"><?php echo get_field('stat_1_type'); ?></div>
                        </div>
					</div>
					<div class="hoh">
						<h2><span>News & Education</span></h2>
	                    <?php // queue the hot topix

	                    $topix_array = array('posts_per_page' => 3, 'post_type' => array('post', 'news'));
	                    $topixloop = new WP_QUERY ($topix_array);

	                    if ($topixloop->have_posts() ) :

	                    while ($topixloop->have_posts() ) : $topixloop->the_post();
	                    
	                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );?>   

                            <div class="article">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo $thumb[0]; ?>" />
                                </a>
                                <div class="post-info">
	                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	                                <p><?php the_date(); ?></p>
	                            </div>
	                            <div class="arrow"><a href="<?php the_permalink(); ?>"> > </a></div>
                            </div>

                        <?php endwhile; endif; wp_reset_query(); ?>
	                    <div class="clear"></div>
					</div>
					<a href="<?php echo esc_url( home_url( '/' ) );?>about-us/blog/" ><div class="all-news">View All News</div></a>
					<div class="home-search">
						<form action="<?php bloginfo('url'); ?>/search/" id="cse-search-box">

		                    <input type="hidden" name="cx" value="003074495176662961374:n2v17u_bwoi" />
		                    <input type="hidden" name="cof" value="FORID:11" />

		                    <input type="hidden" name="ie" value="UTF-8" />
		                    <input type="text" id="searchfield" name="q" />
		          			<input type="submit" name="sa" value="Search" id="searchbutton" title="Search" />

		                    <input type="hidden" name="sa" value="Search" />
		                    <div class="clear"></div>
		                </form>
					</div>
					<!--<div class="hm-text">
						<?php the_content();  ?>
					</div>--><!--.hm-text-->


				<?php //get_sidebar('home') ?>

				</div><!--.hm-content-->
				
			</div><!--.inner-hm-content-->
				<!-- Content exclusive to the homepage goes here. -->
			</div><!--.inner-->
        </div><!-- #main -->
        

<?php get_footer(); ?>
