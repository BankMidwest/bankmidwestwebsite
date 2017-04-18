<?php


get_header();   
?>

<div id="main">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image blog-header">
		
		<h1 class="page-title">From Our Blog</h1>
        
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
			

    
    <div id="content">
    
        
        <div id="inner-content">
        	<!-- begin the_content(); -->

			<div class="int-text">

			<div class="crumb"><a href="/"/>Home</a> / <a href="<?php get_permalink(29); ?>">About</a> / <a href="<?php get_permalink(257); ?>">Blog</a> / <?php single_cat_title(); ?> Blog Archives</div>


			<h1>
				<?php if ( is_day() ) { ?>

					<?php printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>

				<?php } elseif ( is_month() ) { ?>

					<?php printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) ); ?>

				<?php } elseif ( is_year() ) { ?>

					<?php printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) ); ?>

				<?php } else { ?>

					<?php single_cat_title(); ?> <?php _e( 'Blog Archives' ); ?> 

				<?php } ?>
			</h1>

<ul class="post-archive">

   <?php 

   while( have_posts() ) { the_post(); 
    ?>

            <li class="post-item "> <!-- full width container for blog pages -->
       <div class=''>
      			<div class="post-thumb "><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog_large', array( 'class' => 'gray-border' )); ?></a><!-- post-thumb -->
      			</div>
               <div class="post-content ">
                  
                       <div class="post-info">
                
                <h2 class="post-title"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
               
                <div class="post-author">

			<?php
			the_time('j M, Y');
			echo ' - ';
			the_category();
			echo '- ';
			$user = slt_cf_field_value('author_sidebar');; 
			$user_info = get_userdata($user); 

			$link = $user_info->user_page;

			if ( $user ) { ?>

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
            </div><!-- post-info -->
                  <div class="post-description condensed-line-height"><?php echo excerpt(20); ?> <!-- post-description --></div>
            		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="readmore"> Read more <i></i></a>
            </div><!-- post-content -->
           </div>
      </li>

<?php } wp_reset_postdata(); ?>

</ul>
			<div class="navigation">
<div class="full-width-nav"><?php previous_posts_link( '&laquo; Previous Entries' ); ?></div>
<div class="full-width-nav"><?php next_posts_link( 'Next Entries &raquo;', '' ); ?></div>
</div>	
			</div><!--.int-text-->
		
            <!-- end the_content(); -->
        </div><!-- #inner-content -->
       
       
    </div><!-- #content -->

    	<div id="sidebar" class='blog-sidebar'>

		<?php get_sidebar('blog'); ?>

	</div><!-- #sidebar -->
	
			<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				</div><!--.inner-hm-content-->
				<div class="dozer"></div><!--.dozer-->
	</div><!--.inner-->
</div><!-- #main -->


<?php get_footer(); ?>
