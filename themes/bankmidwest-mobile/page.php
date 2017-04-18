<?php
get_header(); the_post(); global $post;
?>

<div id="main">

	<div class="inner">

		<div class="inner-hm-content">

			<div class="hm-content">

				<div class="title-image" <?php echo cbcsd_page_header(true); ?> >

					<h1 class="page-title"><?php the_title(); ?></h1>

				</div><!--.title-image-->

				<div class="dozer"></div><!--.dozer-->

				<div id="content">

					<div id="inner-content">

							<div class="int-text">


								<?php the_content(); ?>


									<?php  $cat = slt_cf_field_value('related_post_select'); 

										if ($cat) {

											$args = array(
												'cat' => $cat,
												'post_count' => 3
												); 
											?>

											<div class="related">

												<h3>Related Blog Posts</h3>

												<?php 

												$q = new WP_Query($args);

												while ( $q->have_posts() ) { 
													$q->the_post();  ?>


													<div class="post related">
														<h4 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h4>
														<div class="post-content"><?php the_excerpt(); ?> <a class="readmore" href="<?php echo get_permalink(); ?>">Read more ></a></div>
													</div><!-- post -->


												<?php 	}  
												wp_reset_postdata();
												?>

											</div>

										<?php } ?>




							</div><!--.int-text-->

						<!-- end the_content(); -->

					</div><!-- #inner-content -->

				</div><!-- #content -->

				<div id="sidebar">

					
					<?php 
					
					global $post;
					$parents = get_post_ancestors( $post->ID );
					/* Get the ID of the 'top most' Page if not return current page ID */
					$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
					$parentTemp = get_page_template_slug( $id );
					
						
						
							
									

						
					?>
			<?php 

			if( ($parentTemp == 'page-modular.php')) { 
				
				get_sidebar('modular');

				}
				else 
				{
					get_sidebar();
				}
				?>



					<?php	 ?>
					<?php wp_reset_postdata(); ?>

				</div><!-- #sidebar -->


				<div class="dozer"></div><!--.dozer-->
			
			</div><!--.hm-content-->

		</div><!--.inner-hm-content-->

		<div class="dozer"></div><!--.dozer-->

	</div><!--.inner-->

</div><!-- #main -->


<?php get_footer(); ?>
