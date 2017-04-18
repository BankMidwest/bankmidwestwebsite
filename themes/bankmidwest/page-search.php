<?php
get_header(); //the_post(); 
?>

<div id="main">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image" <?php echo cbcsd_page_header(true); ?>>
		
		<h1 class="page-title"><?php the_title(); ?></h1>
        
			 	
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

	           <?php get_sidebar(); ?>

    </div><!-- #sidebar -->
    
    <div id="content">
    
        
        <div id="inner-content">
        	<!-- begin the_content(); -->

			  <div class="int-text">

                          <div class="crumb">    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>  </div>


           <?php //the_content(); ?>
           <div id="cse" style="width: 100%;">Loading search results...</div>
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
