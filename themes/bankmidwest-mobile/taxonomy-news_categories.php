<?php
/*
Template Name: Archives
*/

get_header();   
?>

<div id="main">
        <div class="inner">
      <div class="inner-hm-content">
      <div class="hm-content">
      
       <div class="title-image blog-header">
    
    <h1 class="page-title">News: <?php echo single_cat_title(); ?> </h1>
        
        
       </div><!--.title-image-->
        <div class="dozer"></div><!--.dozer-->
      
  <div id="sidebar">
      <!-- Sidebar can be moved on the other side of the main content area if the design calls for a right sidebar. Just move this whole #sidebar div after the close of the #content div. --> 
      
        <!--
        Note: This sidebar is the most common configuration of an interior page navigation,
            and it has been set up with three scenarios to cover the majority of the styling
            possibilities. 
             - In the first section, Page 1, the third link is the currently-active page. The
               parent is given both .current_page_parent and .current_page_ancestor.
             - In the second section, Page 2, the top level link is the currently-active page.
               It is given a class of .current_page_item. Generally, the children of non-active
               pages are hidden so as to not clutter the navigation. In this situation you want
               to make sure to show the children of an active page. 
             - In the third section, the currently-selected item is a third-level page (sub-subpage).
               This is not always needed for all of our sites, especially ones with simple sitemaps,
               but it's good to allow for the possibility of a third level page.
             - In the fourth section, Page 4 is entirely unselected. As above, you probably will 
               want to make sure that the child UL is hidden.
               
            The base CSS file of the theme has been configured with all the selectors you will
            need in order to style this list, as well as default styles for all of them. When you
            convert to WordPress, you can delete all of the flat HTML below, and this comment as well,
      and then uncomment the "get_sidebar()" function below to make the the sidebar dynamic.
          -->

             <?php get_sidebar('news'); ?>

    </div><!-- #sidebar -->
    
    <div id="content">
    
        
        <div id="inner-content">
          <!-- begin the_content(); -->

        <div class="int-text">

<ul class="post-archive">

<?php 
        while(have_posts()) {
          the_post(); ?>

      <li class="news-item">
            <div class="post-info">
                <div class="post-date"><?php the_time('n/d') ?><!-- post-date --></div>
                <h2 class="post-title"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            </div><!-- post-info -->

              <div class="post-content">
                  <div class="post-thumb"><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog_thumb'); ?></a><!-- post-thumb --></div>
                  <div class="post-description"><?php echo excerpt(20); ?> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="readmore"> Read more <i></i></a><!-- post-description --></div>
            </div><!-- post-content -->
      </li><!-- post-item -->

        <?php
        }
        ?>
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


