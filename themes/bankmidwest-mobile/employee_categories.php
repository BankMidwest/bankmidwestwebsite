<?php
/* Template Name: People Home Page */

get_header();
?>

<div id="main">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image">
		
		<h1 class="page-title"><?php the_title(); ?></h1>
        
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
    
    <div id="content">
    	<!-- WP
                  -->
        
        <div id="inner-content" class="directory">
        	<!-- begin the_content(); -->

			 <div class="int-text">


        		<div class="title"><i></i><h2 class="biotitle">Lending</h2></div>



</div>

<ul class="directory_list">

	        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<li>
	<a href="<?php echo get_permalink(); ?>">
		<div class="img">
		<?php the_post_thumbnail('employee_thumb'); ?>
	</div>
	<div class="name">
		<h3><?php $employeeName= slt_cf_field_value('employee_name'); if($employeeName) { echo $employeeName; } ?></h3>
		<?php $employeeTitle= slt_cf_field_value('employee_title'); if($employeeTitle) { echo $employeeTitle; } ?><br/>

		<h5 class="branchname"><?php $employeeBranch = slt_cf_field_value('employee_branch'); if($employeeBranch) { echo $employeeBranch; } ?></h5>
	</div>
</a>
</li>

        <?php endwhile; endif; ?>


</ul>

<br class="clear"/>




			
            <!-- end the_content(); -->
        </div><!-- #inner-content -->
       
               
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
