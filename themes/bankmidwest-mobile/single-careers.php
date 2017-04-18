<?php
get_header(); the_post();
?>

<div id="main" class="news">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image blog-header">
		
		<h1 class="page-title">News</h1>
        
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
    
    <div id="content">
    
        
        <div id="inner-content">
        	<!-- begin the_content(); -->

			  <div class="int-text">


                        <div class="single-post-title">
                            <?php the_post_thumbnail('blog_large'); ?>
                            <div class="post-date"><?php the_time('n/d') ?> <!-- post-date --></div>

                            <h2><?php the_title();?></h2>


                        <div class="single-post-content">

                            <?php the_content(); ?>


                        </div>xxx


       </div><!-- single-post-content -->




                <?php $careerActive = slt_cf_field_value('careers_active'); ?>


               <?php     if($careerActive) { ?>


                This career is active. 

<?php } ?>

			</div><!--.int-text-->
			
            <!-- end the_content(); -->
        </div><!-- #inner-content -->
       
       
    </div><!-- #content -->

   	<div id="sidebar">

  		<?php get_sidebar('news'); ?>
  		
	</div>


			<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				</div><!--.inner-hm-content-->
				<div class="dozer"></div><!--.dozer-->
	</div><!--.inner-->
</div><!-- #main -->


<?php get_footer(); ?>
