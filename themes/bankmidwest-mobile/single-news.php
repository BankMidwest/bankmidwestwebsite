<?php
get_header(); the_post();
?>

<div id="main" class="single">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image blog-header">
		
		<h2 class="page-title">News</h2>
        
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
    
    <div id="content">
    
        
        <div id="inner-content">
        	<!-- begin the_content(); -->

			<div class="int-text">



				<div class="single-post-title">

					<?php the_post_thumbnail('blog_large', array( 'class' => 'gray-border' )); ?>

					

						<h1><?php the_title();?></h1>
						

					<div class="post-author">
						<?php 
							the_time('M j, Y');
							echo ' - ';
							$terms = wp_get_post_terms( $post->ID, 'news_categories');
            
                            if (sizeof($terms) == 1){
                                foreach ($terms as $term) {
                                    echo '<a href="'.get_term_link($term->slug, 'news_categories').'">'.$term->name.' </a>';
                                }
                            } else {
                                $counter = count($terms);
                                foreach ($terms as $term) {
                                    echo '<a href="'.get_term_link($term->slug, 'news_categories').'">'.$term->name;
                                    if(++$i != $counter) {
                                        echo ', </a>';
                                    } else {
                                        echo '&nbsp</a>';
                                    }
                                }
                            }
							echo ' - ';
						?>
						<?php

						$author_user = slt_cf_field_value('author_sidebar');
						$user = slt_cf_field_value('author_sidebar');; 
						$user_info = get_userdata($user); 

						$link = $user_info->user_page;

						if ( $author_user ) { ?>

							By <?php if ( $link ) { ?>  

								<a href="<?php echo get_permalink($link); ?>">  

							<?php } ?>

							<?php echo $user_info->display_name ;?>

							<?php if ( $link ) { ?>  

								</a> 

							<?php } ?>

						<?php  } else { ?> 

							By <?php the_author(); ?>

						<?php } ?>
						
					<!-- post-author --></div>
                    
                    <!-- share-module -->
                    <?php include 'includes-share-module.php';?>
                    
				</div><!-- single-post-title -->

                        <div class="single-post-content">

           <?php the_content(); ?>

       </div><!-- single-post-content -->

      	 <div class="single-post-footer">


					

				</div>


			</div><!--single-post-footer -->

	<div class="navigation">
					<div class="full-width-nav"><?php previous_post('%', 'Previous', 'no'); ?></div>
					<div class="full-width-nav"><?php next_post('%', 'Next', 'no'); ?></div>
</div>
			</div><!--.int-text-->
		
            <!-- end the_content(); -->
        </div><!-- #inner-content -->
       
       
    </div><!-- #content -->

   <div id="sidebar" class="blog-sidebar">

  		<?php get_sidebar('news'); ?>

	</div>


			<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				</div><!--.inner-hm-content-->
				<div class="dozer"></div><!--.dozer-->
	</div><!--.inner-->
</div><!-- #main -->


<?php get_footer(); ?>
