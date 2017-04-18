<?php

/* Template Name: Resource Library */


global $investFooter;
$investFooter = true;

get_header();

the_post(); 
?>


<div id="main" class="resources">

        <div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image">
		
		<h1 class="page-title">Resource Library</h1>
        
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
    
    <div id="content">
    	<!-- WP
                  -->
        
        <div id="inner-content">
        	<!-- begin the_content(); -->
			 <div class="int-text">


			 				 	<div class="crumb">    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>  </div>    		
			</div>


			

			  <div class="int-text">

			  	<?php the_content(); ?>


			</div><!--.int-text-->



			<ul class="resource_list">



	        <?php 

			 

	        global $wp_query;
			// Stash our original query:
			$original_query = $wp_query;
            $loopCount = 0;
	        $args = array(
	        		'post_type' => 'resource',
	        		'nopaging' => true,
	        		'order' => DESC,
	        		'orderby' => 'date'
	        	); 

                
            $the_query = new WP_query($args);
                
            if($the_query->have_posts()){
                while($the_query->have_posts()){
                    $the_query->the_post();
                    $postmeta = metalPostMeta( $post );
                    
                    $button = '';
                    $pdf = '';
                    
                    $loopCount++;    
                    
                    if($postmeta->button_alt) {
                        $button = $postmeta->button_alt;
                    } else {
                        $button = 'download';
                    }  
                    
                    if($postmeta->pdf) {
                        $pdf = $postmeta->pdf;
                    } else {
                        $pdf = '';
                    }
                    
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'resource' );
                    $image = $image[0];
                    
                    ?>
                    
                    <li class="list-item">
                        <div class="wrap">
                            <a href="<?php echo $pdf; ?>" target="_blank">
                                <div class="img" style="background-image:url(<?php echo $image; ?>)">
                                </div>
                            </a>
                            <div class="post-content">
                                <h3><?php echo the_title(); ?></h3>

                                <div class="button">
                                    <a href="<?php echo $pdf; ?>" target="_blank">
                                        <?php echo $button; ?>
                                    </a>
                                </div>
                                <div class="content">
                                    <?php echo the_time( 'n/j/y, ' ); 

                                    $filename = 'http:'.$pdf;
//                                    $ch = curl_init($filename);
//
//                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//                                    curl_setopt($ch, CURLOPT_HEADER, TRUE);
//                                    curl_setopt($ch, CURLOPT_NOBODY, TRUE);
//
//                                    $data = curl_exec($ch);
//                                    $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
//
//                                    curl_close($ch);
                    
                                    $head = array_change_key_case(get_headers($filename, TRUE));
                                    $filesize = $head['content-length'];
                    
                                    echo fileSizeConvert($filesize);

                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </li>
                    
                <?php    
                }
            } ?>






			 <?php $wp_query = $original_query;
					rewind_posts();
					the_post();  

					?>


                    <div class="clear"></div>

				</ul><!-- directory_list -->

			
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