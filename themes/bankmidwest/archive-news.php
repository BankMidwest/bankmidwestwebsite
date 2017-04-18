<?php
/*
Template Name: Archives
*/

get_header();   
?>

<div id="main">
        <div class="inner">
      <div class="inner-hm-content">
      <div class="hm-content-white">
      
       <div class="title-image blog-header">
    
    <h1 class="page-title">News</h1>
        
        
       </div><!--.title-image-->
        <div class="dozer"></div><!--.dozer-->
      
  <div id="sidebar">

             <?php get_sidebar('news'); ?>

    </div><!-- #sidebar -->
    
    <div id="content">
    
        
        <div id="inner-content">
          <!-- begin the_content(); -->

        <div class="int-text">

                          <div class="crumb"><a href="/">Home</a> / News</div>

<ul class="post-archive">
  
   <?php //$postPreview = get_posts('');
      //foreach($postPreview as $post) :
      //setup_postdata($post);
    ?>

<?php if (have_posts()) : ?>
<?php $post = $posts[0]; $c=0;?>
<?php while (have_posts()) : the_post(); ?>

<?php $c++;
if( !$paged && $c == 1) :?>
	 <li class="post-item">
            <div class="post-info">
               <div class="post-content">
                  <div class="post-thumb blog-featured"><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog_large',array( 'class' => 'blog-featured gray-border' )); ?></a><!-- post-thumb --></div>
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
			$terms = wp_get_post_terms( $post->ID, 'news_categories');
            
            if (sizeof($terms) == 1){
                foreach ($terms as $term) {
                    echo '<a href="'.get_term_link($term->slug, 'news_categories').'">'.$term->name.' </a>';
                }
            } else {
                $counter = count($terms);
                foreach ($terms as $term) {
                    echo '<a href="'.get_term_link($term->slug, 'news_categories').'">'.$term->name;
                    if(++$i != $counter) {
                        echo ', </a>';
                    } else {
                        echo ' </a>';
                    }
                }
            }
			echo ' - ';
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
                <div id="share-module-single">
                 <?php include 'includes-share-module.php';?>
                </div>
			</div><!-- post-info -->
<div class="post-description"><?php echo excerpt(50); ?> <!-- post-description --></div>
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="readmore"> Read more <i></i></a>

                  
            

          <hr>
 
      </li><!-- post-item -->
<?php else :?>

      <li class="post-item pull-left"> <!-- full width container for blog pages -->
       <div class=''>
      			<div class="post-thumb fourty-five"><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog_large', array( 'class' => 'gray-border full-width' )); ?></a><!-- post-thumb -->
      			</div>
               <div class="post-content one-half pull-right">
                  
                       <div class="post-info">
                
                <h2 class="post-title"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
               
                <div class="post-author">

			<?php
			the_time('M j, Y');
			echo ' - ';
            $terms = wp_get_post_terms( $post->ID, 'news_categories');
            
            if (sizeof($terms) == 1){
                foreach ($terms as $term) {
                    echo '<a href="'.get_term_link($term->slug, 'news_categories').'">'.$term->name.' </a>';
                }
            } else {
                $counter = count($terms);
                foreach ($terms as $term) {
                    echo '<a href="'.get_term_link($term->slug, 'news_categories').'">'.$term->name;
                    if(++$i != $counter) {
                        echo ', </a>';
                    } else {
                        echo ' </a>';
                    }
                }
            }       
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
      </li><!-- post-item -->

<?php //endforeach; wp_reset_postdata(); ?>

<?php endif;?>
<?php endwhile; ?>
<?php endif; ?>

</ul>
<div class="navigation">
<div class="alignleft"><?php previous_posts_link( '&laquo; Previous Entries' ); ?></div>
<div class="alignright"><?php next_posts_link( 'Next Entries &raquo;', '' ); ?></div>
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


