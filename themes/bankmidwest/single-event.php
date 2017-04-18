<?php

get_header();
the_post();

function _iff($conditional, $operand)
{
    if($conditional)
    {
        return $conditional . $operand;
    }
}
?>


<div id="main" class="news">
        <div class="inner">
            <div class="inner-hm-content">
            <div class="hm-content-white">
            
             <div class="title-image blog-header">
        
        <h2 class="page-title">Upcoming Events</h1>
        
                
             </div><!--.title-image-->
              <div class="dozer"></div><!--.dozer-->
            
               <div id="sidebar">

                  <?php get_sidebar('events'); ?>
</div>
    
    <div id="content">
    
        
        <div id="inner-content">
            <!-- begin the_content(); -->

              <div class="int-text">

                <div class="single-post-title">
                    <?php the_post_thumbnail('blog_large', array( 'class' => 'gray-border' )); ?>
                    
                    <h1><?php the_title();?></h1>

                    <div class="post-date">
                        
                        <?php 
                            $eventTime = slt_cf_field_value('event_time'); 
                            $eventDate = slt_cf_field_value('event_date');
                            $endDate = slt_cf_field_value('end_date');

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

                        </div>

                            <div class="event-location">
                        
                            <?php $eventLocation= slt_cf_field_value('event_location'); if($eventLocation) { echo $eventLocation; } ?><br/>
                            <?php $eventVenue= slt_cf_field_value('event_venue'); if($eventVenue) { echo $eventVenue; } ?>

                            </div>

                    <div>
                        <?php if (slt_cf_field_value("eventespresso_link")) { ?>
                        <h4 class="register"><a href="<?php echo slt_cf_field_value("eventespresso_link"); ?>" target="_blank">Register Now</a></h4>
                        <?php } ?>
                    </div>
                    
                    <!-- share-module -->
                    <div id="share-module-single">
                        <?php include 'includes-share-module.php';?>  
                    </div>
                    
                </div>
                      
              <?php the_content(); ?>
           <?php /* $eventDesc= slt_cf_field_value('event_description'); if($eventDesc) { echo $eventDesc; } */?>

			<div class="navigation">
					<div class="alignleft"><?php previous_post('%', 'Previous', 'no'); ?></div>
					<div class="alignright"><?php next_post('%', 'Next', 'no'); ?></div>
			</div>


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
