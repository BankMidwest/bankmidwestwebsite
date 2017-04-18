<?php
global $post, $wp_query;

get_header();
the_post();

$employee_category = slt_cf_field_value("employee_category");

?>

<div id="main">
		<div class="inner">
			<div class="inner-hm-content">
			<div class="hm-content">
			
			 <div class="title-image">
		
		<h1 class="page-title">Directory</h1>
		
			 	
			 </div><!--.title-image-->
			  <div class="dozer"></div><!--.dozer-->
			
	<div id="sidebar">

		<?php get_sidebar(); ?>
		
	</div><!-- #sidebar -->
	
	<div id="content">
		<div id="inner-content" class="directory">
			<!-- begin the_content(); -->

			 <div class="int-text">

			 	<div class="crumb">
			 	<a href="<?php echo get_permalink(132); ?>"><?php echo get_the_title(132); ?></a> /  
				<a href="<?php echo get_permalink(29); ?>"><?php echo get_the_title(29); ?></a> /  
				<a href="<?php echo get_permalink(99); ?>"><?php echo get_the_title(99); ?></a> / 
				 <?php echo the_title(); ?>
				</div>

				<div class="title">

					<?php

					global $wp_query;
					$post_id = $wp_query->post->ID;

					$post = get_post( $post_id );
					$slug = $post->post_name;

					 ?>

					<i class="<?php echo $slug; ?>"></i>

					<h2 class="biotitle"><?php the_title(); ?></h2></div>

			</div>

			<ul class="directory_list cf">

	  <?php 

		$employeeLname= slt_cf_field_value('employee_lname'); 

	        global $wp_query;
			// Stash our original query:
		$original_query = $wp_query;

	        $args = array(
	        		'post_type' => 'employee',
	        		'nopaging' => true,
	        		'order' => 'ASC',
	        		'orderby' => $employeeLname,
	        		'tax_query' => array(
					array(
						"taxonomy" => "employee_categories",
						"field" => "id",
						"terms" => $employee_category	// this bad boy is a custom field from the page
					)
				)
	        	); 

	        $wp_query = new WP_query($args); 

	        	$myposts = $wp_query->posts;

				function post_cmp($a, $b)
				{
					$post_a_field = slt_cf_field_value("employee_lname", "post", $a->ID);
					$post_b_field = slt_cf_field_value("employee_lname", "post", $b->ID);
					return strcmp($post_a_field, $post_b_field);
				}

				usort($myposts, "post_cmp");

	     		for ($i = 0; $i < sizeof($myposts); $i++ ) {

	     			$post = $myposts[$i];
	     			setup_postdata($post);

	     			?> 

<li>
					<a href="<?php echo get_permalink(); ?>">
					<div class="img">
						<?php the_post_thumbnail('employee_thumb'); ?>
					</div>
					</a>
					<div class="name">

						<?php 

						$employeeFname= slt_cf_field_value('employee_fname'); 
						$employeeLname= slt_cf_field_value('employee_lname'); 
						$employeeTitle= slt_cf_field_value('employee_title');

						if($employeeLname) { ?> 

						<h3><a href="<?php echo get_permalink(); ?>"><?php echo $employeeFname;?> <?php echo $employeeLname; ?></a></h3>
	        			
	        			<?php

	        			$pageID = $post->ID; ?>

						<?php } ?>
					

						<?php if($employeeTitle) { 

							echo $employeeTitle; } ?>

						<br/>

						<?php 


						$oldPost = $post;

						$args2 = array( 
								"connected_type" => "locations_to_employees",
								"connected_items" => $post->ID,
								'post_type' => array('location'), 
								'order' => 'ASC',
								'orderby' => 'menu_order',
								'posts_per_page' => 1
								); 

						$connection = new WP_Query ($args2); 

		        		if ($connection->have_posts()) { while($connection->have_posts()) { $connection->the_post(); ?>

		        				<h5 class="branchname"><a href="<?php the_permalink(); ?>"><?php  the_title();  ?></a></h5>

							<?php   }  
						} 
							wp_reset_postdata(); 

							$post = $oldPost;

						 $count = 0;

						$args3 = array( 
								'connected_type' => 'locations_to_employees',
								'connected_items' => $post->ID,
								'post_type' => array('location'), 
								'order' => 'ASC',
								'orderby' => 'menu_order',
								'posts_per_page' => -1
								); 

						$postcounts = get_posts($args3); 


					 	foreach ($postcounts as $postcount) { ?>

		        				<?php $count++; ?>

							<?php  } wp_reset_postdata(); ?>


							<?php   //checking for multiple locations -->
							if ($count > 1) { ?>

								<h5 class="branchname more-locations"><a href="<?php echo get_permalink($pageID);  ?>#locationinfo">...more locations</a></h5>
							<?php }  else { ?>


							<?php } ?>


				  <?php  } wp_reset_postdata(); 

				   //end checking multiple locations

				   ?>


							</div>
						</li>
							





					 <?php $wp_query = $original_query;
							rewind_posts();
							the_post();  

					?>


				</ul><!-- directory_list -->


			
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
