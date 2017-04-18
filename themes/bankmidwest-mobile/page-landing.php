<?php
/* Template Name: Landing Page */

global $wp_query; 
$oldquery = $wp_query; 

get_header();
?>

<div id="main">
        <div class="inner landing-page">
			<div class="interior-top">
				
					<div class="int-main-image" <?php echo cbcsd_landing_page_header(true);?> >

					
						<?php $landingList = slt_cf_field_value('landing_page_list'); if($landingList) { ?>

					

						<?php } else { } ?>

						
						
					</div><!--.slider-main-image-->
			
			</div><!--.interior-top-->
		
		
			  
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="int-highlights">
		
				<div class="icon"></div><!--.icon-->
		

			 </div><!--.int-highlights-->
			  <div class="dozer"></div><!--.dozer-->
    
    <div id="content">

    <?php 
    		$wp_query = $oldquery; 
    		rewind_posts(); 
    		the_post(); 
    ?>      

        <div id="inner-content">

			  <div class="int-text">

			  	<div class="landing">

			  				<h1 class="page-title"><?php the_title(); ?></h1>


			        <?php the_content(); ?>

			    </div><!--.landing-->
			</div><!--.int-text-->
			
        </div><!-- #inner-content -->
       
       
    </div><!-- #content -->


    <div id="sidebar">
    

	           <?php get_sidebar('home'); ?>

	
    </div><!-- #sidebar -->

			<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				</div><!--.inner-hm-content-->
				<div class="dozer"></div><!--.dozer-->
	</div><!--.inner-->
</div><!-- #main -->


<?php get_footer(); ?>
