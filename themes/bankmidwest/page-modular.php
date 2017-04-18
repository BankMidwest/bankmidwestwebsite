<?php
/* Template Name: Independent Landing */

global $wp_query; 
$oldquery = $wp_query; 

get_header();
?>

<div id="main">
        <div class="inner landing-page">
			<div class="interior-top">
				
					<div class="int-main-image" <?php echo cbcsd_landing_page_header(true);?> >

					
						<?php $landingList = slt_cf_field_value('landing_page_list'); if($landingList) { ?>

						<div class="links-box">
							<div class="links-box-top"></div><!--.links-box-top-->
							<div class="links-box-middle">

						<?php echo $landingList; ?>

						 	</div><!--.links-box-top-->
							<div class="links-box-bottom"></div><!--.links-box-bottom-->
						</div><!--.links-box-->

						<?php } else { } ?>

						
						
					</div><!--.slider-main-image-->
			
			</div><!--.interior-top-->
		
		
			  
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="int-highlights">
		
				<div class="icon"></div><!--.icon-->
					<div class="subtext">

						<?php 	$landingText = slt_cf_field_value('landing_page_main_text'); echo $landingText; 
 ?>

					</div><!--.subtext-->
        		<div class="officer"></div><!--.officer-->
				<div class="contact-officer">


			<?php 
				$landingMain = slt_cf_field_value('landing_page_main_text');
				$landingContactText = slt_cf_field_value("landing_page_contact_message"); 

				$landingContactImg1 = slt_cf_field_value("landing_page_contact_img1");
				$landingContactImg2 = slt_cf_field_value("landing_page_contact_img2");
				$landingContactImg3 = slt_cf_field_value("landing_page_contact_img3");
				$landingContactImg4 = slt_cf_field_value("landing_page_contact_img4");

				$landingLink1 = slt_cf_field_value("landing_page_loan_officer_link1");
				$landingLink2 = slt_cf_field_value("landing_page_loan_officer_link2");
				$landingLink3 = slt_cf_field_value("landing_page_loan_officer_link3");
				$landingLink4 = slt_cf_field_value("landing_page_loan_officer_link4");
			?>

			<?php
				$landingImage1 = sprintf(
					'<div class="in">
						<a href="%s">%s</a>
						</div><!-- in -->
						<div class="bg"></div>
						<div class="text"><a href="%s">%s<i></i></a></div>', 
						$landingLink1,
						wp_get_attachment_image($landingContactImg1, full),
						$landingLink1,
						$landingContactText
				);

				$landingImage2 = sprintf(
					'<div class="in">
						<a href="%s">%s</a>
						</div><!-- in -->
						<div class="bg"></div>
						<div class="text"><a href="%s">%s<i></i></a></div>', 
						$landingLink2,
						wp_get_attachment_image($landingContactImg2, full),
						$landingLink2,
						$landingContactText
				);

				$landingImage3 = sprintf(
					'<div class="in">
						<a href="%s">%s</a>
						</div><!-- in -->
						<div class="bg"></div>
						<div class="text"><a href="%s">%s<i></i></a></div>', 
						$landingLink3,
						wp_get_attachment_image($landingContactImg3, full),
						$landingLink3,						
						$landingContactText
				);

				$landingImage4 = sprintf(
					'<div class="in">
						<a href="%s">%s</a>
						</div><!-- in -->
						<div class="bg"></div>
						<div class="text"><a href="%s">%s<i></i></a></div>', 
						$landingLink4,
						wp_get_attachment_image($landingContactImg4, full),
						$landingLink4,
						$landingContactText
				);

				$random_number = rand(0,3);
				$input = array($landingImage1, $landingImage2, $landingImage3, $landingImage4);

				if( $landingContactImg1 || $landingContactImg2 || $landingContactImg3 || $landingContactImg4) {
				echo $input[$random_number];
				
					} else {} ?>



				</div><!--.contact-officer-->
			 	
			 </div><!--.int-highlights-->
			  <div class="dozer"></div><!--.dozer-->
			
	<div id="sidebar">
    

	           <?php get_sidebar('modular'); ?>

	
    </div><!-- #sidebar -->
    
    <div id="content">

    <?php 
    		$wp_query = $oldquery; 
    		rewind_posts(); 
    		the_post(); 
    ?>      

        <div id="inner-content">

			  <div class="int-text">

			  	                          <div class="crumb">    <?php //if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>  </div> 


			  	<div class="landing">

			  				<h1 class="page-title"><?php the_title(); ?></h1>
			  				<?php $postmeta = metalPostMeta( $post ); ?>
			  				<?php //echo $postmeta->contact_us_link; ?>
			        <?php the_content(); ?>

			    </div><!--.landing-->
			</div><!--.int-text-->
			
        </div><!-- #inner-content -->
       
       
    </div><!-- #content -->
			<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				</div><!--.inner-hm-content-->
				<div class="dozer"></div><!--.dozer-->
	</div><!--.inner-->
</div><!-- #main -->


<?php get_footer(); ?>
