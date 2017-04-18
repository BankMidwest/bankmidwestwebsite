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
      		<div class="hm-content-white">
       			<div class="title-image blog-header">
   					 <h1 class="page-title">
   					 		Upcoming Events
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
<ul class="post-archive">


		<?php
		while(have_posts())
		{
			the_post();
			$end_date = preg_replace("/000$/", "", slt_cf_field_value("end_date"));
			$start_date = preg_replace("/000$/", "", slt_cf_field_value("event_date"));

            $eventTime = slt_cf_field_value('event_time'); 
            $eventDate = slt_cf_field_value('event_date');
            $endDate = slt_cf_field_value('end_date');
            $eventLocation= slt_cf_field_value('event_location'); 

       		$cur_date = strtotime(date("Y-m-d", time()));


       		?>


		<?php if ($end_date < $cur_date) { 
echo "<!-- ED ({$end_date}) LT CD ({$cur_date}) -->";
		} else { ?>

    
            <li class="post-item pull-left"> <!-- full width container for blog pages -->
               <div class=''>
                        <div class="post-thumb fourty-five"><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog_large', array( 'class' => 'gray-border full-width' )); ?></a><!-- post-thumb -->
                        </div>
                       <div class="post-content one-half pull-right">

                               <div class="post-info">

                        <h2 class="post-title"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                        <div class="post-author">
                            <?php echo /*"<strong>Date:</strong> " .*/ _iff(
                    date("l, F j, Y", preg_replace("/000$/", "", slt_cf_field_value("event_date"))),
                    ''); echo ', '.$eventTime; ?><br/>
                            <?php echo $eventLocation;?>
                        </div><!-- post-author -->
                    </div><!-- post-info -->
                          <div class="post-description condensed-line-height"><?php echo excerpt(20); ?> <!-- post-description --></div>
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="readmore"> Read more <i></i></a>
                    </div><!-- post-content -->
                   </div>
              </li><!-- post-item -->
		
			<?php
			} 
		}
			?>

		<div class="clear"></div>
			
</ul>
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

