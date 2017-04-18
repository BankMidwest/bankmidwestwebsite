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
   					 <h1 class="page-title">Upcoming Events</h1>        
   				</div><!--.title-image-->
       			 <div class="dozer"></div><!--.dozer-->
      
				<div id="sidebar">
                  <?php get_sidebar('events'); ?>
				</div><!-- #sidebar -->
    
   				<div id="content">
            		<div id="inner-content" class="event">
        				<div class="int-text">


		<?php
		while(have_posts())
		{
			the_post();
			$end_date = preg_replace("/000$/", "", slt_cf_field_value("end_date"));
		?>

			
			<div class="post cf">
					<?php if(has_post_thumbnail()) { ?>
					<div class="event-photo"><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog_thumb'); ?></a></div><!--.event-photo-->
					<?php } ?>
					
					<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="event-date"><?php echo /*"<strong>Date:</strong> " .*/ _iff(
									date("l, F j, Y", preg_replace("/000$/", "", slt_cf_field_value("event_date"))),
									''
								); ?> &mdash; <?php $eventTime= slt_cf_field_value('event_time'); if($eventTime) { echo $eventTime; } ?>
					</div>

						 
						<?php the_excerpt(); ?>

						<a href="<?php echo get_permalink(); ?>" class="readmore"><?php the_title(); ?> information<i></i></a>
					

			<div class="dozer"></div><!--.dozer-->
			</div><!--.post -->
		
		<?php
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

