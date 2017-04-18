<?php
/* Template Name: News Single Page */

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
			
	<div id="sidebar">
    	
<?php get_sidebar('news'); ?>
		
<?php get_sidebar('bottom-links'); ?>

		
    		<div class="hm-side">

					<div class="facebook"></div><!--.facebook-->
					<div class="fb-like"></div><!--.fb-like-->

			</div><!--.hm-side-->
	
	
	
    </div><!-- #sidebar -->
    
    <div id="content">
    	<!-- WP
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          -->
        
        <div id="inner-content">
        	<!-- begin the_content(); -->

			  <div class="int-text">
           <?php the_content(); ?>
		   
		   <div class="post">
		   
		   	<div class="single-news">
		   
		  
<img src="http://www.bankmidwest.com.demo4.flyinghippo.com/wp-content/uploads/2013/03/fpo-news-image.jpg" alt="" title="fpo-news-image" width="375" height="229" class="alignleft size-full wp-image-56" />
&nbsp;

<div class="post-content-single">
<div class="post-date-single">12/30</div><!--.post-date-single-->
<h2>Meet our Friendly Bankers</h2>
<hr />
Vivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at.Vivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at. Vivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at.PVivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequVivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at.at condimentum ante, at tempus tellus tempus at.hVivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at.aVivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at.sellus Vivamus molestie ullamcorper ipsum non vehicula. Vestibulum consequat condimentum ante, at tempus tellus tempus at.ac arcu eut. 
				</div><!--.post-content-single-->
			<div class="dozer"></div><!--.dozer-->
			
			</div><!--.single-news-->
			
			</div><!--.post-->
			
			
		   <div class="cat-list">
		   		<span class="cat-list-title">Categories:</span> <a href="#">Loans</a>, <a href="#">Insurance</a>, <a href="#">Financial Planning</a>, <a href="#">Banking</a>
		   </div><!--.cat-list-->
			</div><!--.int-text-->
			
            <!-- end the_content(); -->
        </div><!-- #inner-content -->
       
        <?php endwhile; endif; ?>
       
    </div><!-- #content -->
			<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				</div><!--.inner-hm-content-->
				<div class="dozer"></div><!--.dozer-->
	</div><!--.inner-->
</div><!-- #main -->


<?php get_footer(); ?>
