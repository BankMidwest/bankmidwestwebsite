<?php
/*
Template Name: Index
*/

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

      <div class="crumb"><a href="/"/>Home</a> / <a href="<?php echo get_permalink(29); ?>">About</a> / Blog </div>

  
  

<?php if (have_posts()) : ?>
<?php $post = $posts[0]; $c=0;?>
<?php while (have_posts()) : the_post(); ?>

<?php 
$c++;

if( !$paged && $c == 1) :
?>

	 <li class="post-item">
            <div class="post-info">
               <div class="post-content">
                  <div class="post-thumb full-width"><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog_large',array( 'class' => ' gray-border' )); ?></a><!-- post-thumb --></div>
                  <img src="<?php 
                  $iconImage = get_template_directory_uri() . '/images/featured-icon.png';
                  echo $iconImage;
                  ?>" class='featured-icon'/>
            </div><!-- post-content -->
                <div class="post-date"><?php ?><!-- post-date --></div>
                <h2 class="post-title"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-author">
            <?php
			$user = slt_cf_field_value('author_sidebar');; 
			$user_info = get_userdata($user); 

			$link = $user_info->user_page;
			the_time('M j, Y');
			echo ' - ';
			the_category();
			echo '- ';
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
<div class="post-description"><?php echo excerpt(50); ?> <!-- post-description --></div>
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="readmore"> Read more <i></i></a>

                  
            

          <hr>
 
      </li><!-- post-item -->
<?php else : ?>

		<li class="post-item "> <!-- full width container for blog pages -->
			<div class=''>
      			<div class="post-thumb ">
      				<a href="<?php echo get_permalink(); ?>">
      				<?php the_post_thumbnail('blog_large', array( 'class' => 'gray-border' )); ?>
      				</a><!-- post-thumb -->
      			</div>

               	<div class="post-content ">
                 	<div class="post-info">
                
                	<h2 class="post-title"> 
                		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                			<?php the_title(); ?>
                		</a>
                	</h2>
               
                	<div class="post-author">
						<?php
						the_time('M j, Y');
						echo ' - ';
						the_category();
						echo '- ';
						$user = slt_cf_field_value('author_sidebar');; 
						$user_info = get_userdata($user); 

						$link = $user_info->user_page;

						if ( $user ) { 
						?>

							By 

							<?php 
							if ( $link ) 
							{ 
							?>  

								<a href="<?php echo get_permalink($link); ?>">  

							<?php 
							}

									echo $user_info->display_name;


							if ( $link ) 
							{ 
							?>  

								</a> 

						<?php 
							} 
						} 

						else 
						{ 
						?> 

							By <?php the_author(); ?>

						<?php 
						} 
						?>

                  <!-- post-author --></div>
            	</div><!-- post-info -->
                
                <div class="post-description condensed-line-height">
                	<?php echo excerpt(20); ?> 
               	</div> <!-- post-description -->
            	
            	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="readmore"> Read more <i></i></a>
            </div><!-- post-content -->
        </div>
     </li><!-- post-item -->

	<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>

</ul>

				<div class="navigation">
					<div class="full-width-nav"><?php previous_posts_link( '&laquo; Previous Entries' ); ?></div>
					<div class="full-width-nav"><?php next_posts_link( 'Next Entries &raquo;', '' ); ?></div>
				</div><!--.navigation-->
			</div><!--.int-text-->
        </div><!-- #inner-content -->
       	
       	<div id="sidebar" class='blog-sidebar'>
			<?php get_sidebar('blog'); ?>
    	</div><!-- #sidebar -->
       
    </div><!-- #content -->
			<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				</div><!--.inner-hm-content-->
				<div class="dozer"></div><!--.dozer-->
	</div><!--.inner-->
</div><!-- #main -->

<?php 
get_footer();