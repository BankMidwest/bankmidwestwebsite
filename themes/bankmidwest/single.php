<?php
get_header(); the_post();
?>

<div id="main" class="single">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image blog-header">
		
		<h2 class="page-title">From Our Blog</h2>
        
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
			
	           <div id="sidebar" class='blog-sidebar'>

                  <?php get_sidebar('blog'); ?>
</div>
    
    <div id="content">
    
        
        <div id="inner-content">
        	<!-- begin the_content(); -->

			<div class="int-text">




<?php //echo 'hello'; ?>
				<div class="single-post-title">

					<?php the_post_thumbnail('blog_large', array( 'class' => 'gray-border' )); ?>

					

						<h1><?php the_title();?></h1>
						

					<div class="post-author">
						<?php 
							the_time('M j, Y');
							echo ' - ';
							the_category();
							echo ' - ';
						?>						<?php

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
			<div class="navigation">
					<div class="alignleft"><?php previous_post('%', 'Previous', 'no'); ?></div>
					<div class="alignright"><?php next_post('%', 'Next', 'no'); ?></div>
			</div>
<?php

 /*
      	 <div class="single-post-footer clear">
      	 		
							<?php 

					$categories = get_the_category();

					if( !(in_category('uncategorized'))) { ?> 

						<div class="widget widget_categories">

							<div class="widget-title">Categories</div>	

							<?php	
								$separator = ' ';
								$output = '';
								if($categories){
									foreach($categories as $category) {
										$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
									}
								echo trim($output, $separator);
								} ?>

							</div>

					<?php } else {} ?>		


				<div class="widget widget_categories">

					<?php if( has_tag()) { ?> 

						<div class="widget-title">Tags</div>	

						<p><?php the_tags(); ?></p>

					<?php } else {} ?>		

				</div>


			</div><!--single-post-footer -->
*/?>

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
