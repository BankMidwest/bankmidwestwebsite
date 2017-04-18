<?php
get_header(); the_post(); global $post;
?>

<style type="text/css">
        * { font-weight: normal; } body { 	font-family:"Arial", Gadget, sans-serif; 	font-weight:normal; 	font-size:14px; }  td, tr { 	padding:5px 5px 5px 10px; font-weight:normal; }  .borderTable, .borderTable tr, .borderTable td { 	border:1px solid #878785; 	border-collapse:collapse; }  .borderTableNoTd { 	border:1px solid #878785; 	border-collapse:collapse; }  tr.borderLeftNone, td.borderLeftNone { 	border-left:1px solid #4E0021; 	border-collapse:collapse; }  tr.borderRightNone, td.borderRightNone { 	border-right:1px solid #4E0021; 	border-collapse:collapse; }  .darkRed { 	background:#4E0021; 	color:#FFF; 	padding:0 0 0 20px; }  .lightRed { 	background:#78002E; 	color:#FFF; 	padding:0 0 0 20px; }  .big { 	width:150px; 	font-size:24px; 	padding-top:20px; }  .noPaddingTop { 	padding-top:0px; 	font-size:28px; }  .spacer { 	border-top:1px solid #878785; 	padding:3px; }  .topBottom { 	padding-top:10px; 	padding-bottom:10px; }
</style>

<div id="main">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image" <?php echo cbcsd_page_header(true); ?> >
		
		<h1 class="page-title"><?php the_title(); ?></h1>
        
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
    
    <div id="content">
    
        
        <div id="inner-content">


			  <div class="int-text">


                          <div></div>

           <?php the_content(); ?>

			</div><!--.int-text-->
			
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
