<?php
/* Template Name: News Page */

get_header();
?>

<div id="main">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image-news">
		
		<h1 class="page-title"><?php the_title(); ?></h1>
        
			 	<div class="subscribe"><a href="#">Subscribe to the News Feed</a></div><!--.subscribe-->
			 </div><!--.title-image-news-->
			  <div class="dozer"></div><!--.dozer-->
    
    <div id="content">
    	<!-- WP
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          -->
        
        <div id="inner-content">
        	<!-- begin the_content(); -->

			  <div class="int-text">
           <?php the_content(); ?>
		   
		   <div class="post">
		   <div class="post-date">12/30</div><!--.post-date-->
		   		<div class="post-content">
		   <h3>Meet our Friendly Bankers</h3>
		   <img src="http://www.bankmidwest.com.demo4.flyinghippo.com/wp-content/uploads/2013/03/thumb-friendlybankers.jpg" alt="" title="thumb-friendlybankers" width="144" height="92" class="alignleft size-full wp-image-48" />
		   
Vivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at. Phasellus ac arcu eut. <a href="#">Read More</a> 
				</div><!--.post-content-->
			<div class="dozer"></div><!--.dozer-->
			
			</div><!--.post-->
			
					   <div class="post">
		   <div class="post-date">12/30</div><!--.post-date-->
		   		<div class="post-content">
		   <h3>Meet our Friendly Bankers</h3>
		   <img src="http://www.bankmidwest.com.demo4.flyinghippo.com/wp-content/uploads/2013/03/thumb-friendlybankers.jpg" alt="" title="thumb-friendlybankers" width="144" height="92" class="alignleft size-full wp-image-48" />
		   
Vivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at. Phasellus ac arcu eut. <a href="#">Read More</a> 
				</div><!--.post-content-->
			<div class="dozer"></div><!--.dozer-->
			
			</div><!--.post-->
			
					   <div class="post">
		   <div class="post-date">12/30</div><!--.post-date-->
		   		<div class="post-content">
		   <h3>Meet our Friendly Bankers</h3>
		   <img src="http://www.bankmidwest.com.demo4.flyinghippo.com/wp-content/uploads/2013/03/thumb-friendlybankers.jpg" alt="" title="thumb-friendlybankers" width="144" height="92" class="alignleft size-full wp-image-48" />
		   
Vivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at. Phasellus ac arcu eut. <a href="#">Read More</a> 
				</div><!--.post-content-->
			<div class="dozer"></div><!--.dozer-->
			
			</div><!--.post-->


		   
		   <!--<div class="cat-list">
		   		<span class="cat-list-title">Categories:</span> <a href="#">Loans</a>, <a href="#">Insurance</a>, <a href="#">Financial Planning</a>, <a href="#">Banking</a>
		   </div>--><!--.cat-list-->
			</div><!--.int-text-->
			
            <!-- end the_content(); -->
        </div><!-- #inner-content -->
       
        <?php endwhile; endif; ?>
       
    </div><!-- #content -->

    <div id="sidebar">
    	
        	<?php get_sidebar(); ?>
	
    </div><!-- #sidebar -->

			<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				</div><!--.inner-hm-content-->
				<div class="dozer"></div><!--.dozer-->
	</div><!--.inner-->
</div><!-- #main -->


<?php get_footer(); ?>
