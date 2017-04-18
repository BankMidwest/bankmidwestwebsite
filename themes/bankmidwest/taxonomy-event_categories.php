<?php
global $start_date, $view;

if(isset($_REQUEST['jrbdebug'])) {print_r($wp_query);die;};

get_header();

function custom_excerpt_length( $length ) {
	return 16;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function _iff($conditional, $operand)
{
	if($conditional)
	{
		return $conditional . $operand;
	}
}

?>

<div id="main">
	<div class="inner">
    	<div class="inner-hm-content">
      		<div class="hm-content">
       			<div class="title-image blog-header">
   					 <h1 class="page-title">
   					 		Upcoming Events: <?php single_cat_title(); ?>
   					 </h1>        
   				</div><!--.title-image-->
       			 <div class="dozer"></div><!--.dozer-->
      
				<div id="sidebar">
                  <?php get_sidebar('events'); ?>
				</div><!-- #sidebar -->
    
   				<div id="content">
            		<div id="inner-content" class="event">
        				<div class="int-text">
  							<div class="crumb"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>


		<?php
		while(have_posts())
		{
			the_post();
			$end_date = preg_replace("/000$/", "", slt_cf_field_value("end_date"));
			$start_date = preg_replace("/000$/", "", slt_cf_field_value("event_date"));

            $eventTime = slt_cf_field_value('event_time'); 
            $eventDate = slt_cf_field_value('event_date');
            $endDate = slt_cf_field_value('end_date');

       		$cur_date = time();


       		?>


		<?php if ($end_date < $cur_date) { 

		} else { ?>
			
			<div class="post cf">
					
					<div class="event-top cf">
						<?php if(has_post_thumbnail()) { ?>
						<div class="event-photo"><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog_thumb'); ?></a></div><!--.event-photo-->
						<?php } ?>
						
						<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

						<div class="event-date">


                    <?php 


                    ?>
                        
	                        <?php  if($eventDate) { ?>

	                            <?php echo /*"<strong>Date:</strong> " .*/ _iff(
	                        date("l, F j, Y", preg_replace("/000$/", "", slt_cf_field_value("event_date"))),
	                        '');  ?> 

	                    <?php } ?>

	                    <?php  if($endDate && ($endDate != $eventDate) ) { ?>

	                        &mdash;  
	                        <?php echo /*"<strong>Date:</strong> " .*/ _iff(
	                        date("l, F j, Y", preg_replace("/000$/", "", slt_cf_field_value("end_date"))),
	                        '' );?>


	                    <?php } ?>

	                    <?php  if($eventTime) { ?>

	                            <br/> <?php  echo $eventTime; ?>

	                        <?php } ?>

	                    </div><!-- event-date -->

								<?php 
								$eventLocation= slt_cf_field_value('event_location'); 
								if($eventLocation) { ?>
									<div class="event-location">
										<?php echo $eventLocation; ?>
									</div>
								<?php } ?>
								
								<?php 
								$eventVenue= slt_cf_field_value('event_venue'); ?>
								<?php if($eventVenue) { ?>
									<div class="event-venue">
										<?php echo $eventVenue; ?>
									</div>	
								<?php } ?>

											</div>




						 <div class="event-excerpt">
						<?php the_excerpt(); ?>
					</div>

						<a href="<?php echo get_permalink(); ?>" class="readmore"><?php the_title(); ?> information<i></i></a>
					

			<div class="dozer"></div><!--.dozer-->
			</div><!--.post -->
		
			<?php
			} 
		}
			?>

		<div class="clear"></div>
			

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

