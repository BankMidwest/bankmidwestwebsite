<?php
/* Template Name: People Home Page */

get_header();

the_post(); 
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
        
        <div id="inner-content">
        	<!-- begin the_content(); -->
			 <div class="int-text">

			 				 	<div class="crumb">    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>  </div>


        		<h2>Find employees by department</h2>
			</div>

			<ul id="directory">
                <!-- BANK -->
				<li class="bank">
                    <a href="<?php echo get_permalink(117); ?>"><i></i>BANK<span>one place</span>
                        <div class="outer">
                            <div class="inner">
                                <p>From account opening to online management. Bank on us.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- BORROW -->
                <li class="borrow">
                    <a href="<?php echo get_permalink(185); ?>"><i></i>BORROW<span>lending</span>
                        <div class="outer">
                            <div class="inner">
                                <p>Find a lender or mortgage specialist near you.</p>
                            </div>
                        </div>
                    </a>
				</li>
                <!-- INSURE -->
				<li class="insure">
                    <a href="<?php echo get_permalink(187); ?>"><i></i>INSURE<span>protect</span>
                        <div class="outer">
                            <div class="inner">
                                <p>Questions about your policy or need a quote? We&#8217;re here for you.</p>
                            </div>
                        </div>
                    </a>                        
				</li>
                
                <!-- PLAN used to be class 'grow' -->
				<li class="plan">
                    <a href="<?php echo get_permalink(189); ?>"><i></i>Plan<span>investments</span>
                        <div class="outer">
                            <div class="inner">
                                <p>Talk to us about planning for a financially secure future.</p>
                            </div>
                        </div>
                    </a>                        
				</li>
                <!-- TRUST -->
				<li class="trust">
                    <a href="<?php echo get_permalink(5961); ?>"><i></i>Trust<span>transition</span>
                        <div class="outer">
                            <div class="inner"><p>Establish certainty for the future of your estate, farm or business.</p></div>
                        </div>
                    </a>    
				</li>

            </ul>

			  <div class="int-text">

			  	<?php the_content(); ?>

			</div><!--.int-text-->

			<br class="clear"/>
			<div class="cf int-text">

			 <h2>All employees</h2>

			</div><!--.int-text-->

			<ul class="directory_list">



	        <?php 

			$employeeLname= slt_cf_field_value('employee_lname'); 

	        global $wp_query;
			// Stash our original query:
			$original_query = $wp_query;
            $loopCount = 0;
	        $args = array(
	        		'post_type' => 'employee',
	        		'nopaging' => true,
	        		'order' => ASC,
	        		'orderby' => $employeeLname
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

	     			 
                if ($loopCount %2 == 0) {
                    $clearClass = "style=clear:left;";
                } else {
                    $clearClass = '';
                }
                $loopCount++;    
	     		?> 
                    
				<li <?php echo $clearClass; ?> >
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