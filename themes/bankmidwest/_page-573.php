<?php
get_header(); the_post(); global $post;
?>

<div id="main">
        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image" <?php echo cbcsd_page_header(true); ?> >
		
		<h1 class="page-title"><?php the_title(); ?></h1>
        
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
			
	<div id="sidebar">


	           <?php get_sidebar(); ?>

    </div><!-- #sidebar -->
    
    <div id="content">
    
        
        <div id="inner-content">
        	<!-- begin the_content(); -->

			  <div class="int-text">

                          <div class="crumb">    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>  </div>

<script src="//www.gmodules.com/ig/ifr?url=http://hosting.gmodules.com/ig/gadgets/file/100840413740199312943/StockQuotes.xml&amp;up_stockList=%5EDJI%2C%20%5EIXIC%2C%20%5EGSPC%2C%20%5ENYA&amp;up_chart_bool=1&amp;up_font_size=12&amp;up_symbol_bool=0&amp;up_chart_period=1&amp;synd=open&amp;w=400&amp;h=300&amp;title=Yahoo!+Finance&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>

           <?php the_content(); ?>

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
