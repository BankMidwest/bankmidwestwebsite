<?php
get_header();

the_post();

global $post, $wpdb;
$terms = wp_get_post_terms( $post->ID, 'employee_categories');

$employeeTitle= slt_cf_field_value('employee_title');
$employeeName= slt_cf_field_value('employee_name');
$employeePhone = slt_cf_field_value('employee_phone');
$employeeFax = slt_cf_field_value('employee_fax');
$application = slt_cf_field_value('employee_application');
$employeeEmail = slt_cf_field_value('employee_email');
$employeeLinkedin = slt_cf_field_value('employee_linkedin');

?>

<div id="main" class="<?php
		if ( $terms != null ){
		foreach( $terms as $term ) {

		print $term->slug ;

		unset($term);
		}
		}
		?>">
	<div class="inner">
		<div class="inner-hm-content">
			<div class="hm-content">

				<div class="title-image">

					<h2 class="page-title"><?php the_title(); ?></h2>

				</div><!--.title-image-->
				<div class="dozer"></div><!--.dozer-->

				<div id="sidebar">
					<?php get_sidebar('employee'); ?>
				</div><!-- #sidebar -->

				<div id="content">


					<div id="inner-content">
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

									$terms = wp_get_post_terms( $post->ID, 'employee_categories');
									$key = slt_cf_field_key('employee_lname'); 

									foreach ($terms as $term ) { 

										$term_id = $term->term_id;

									} ?>

									<i class="<?php echo $term->slug; ?>"></i>

								<h2 class="biotitle">
									<?php the_title();

									if($employeeTitle)
									{
										?>
									<span><?php echo $employeeTitle; ?></span>
										<?php
									}
									?>
								</h2>
							</div><!-- title -->

							<a href="/about-us/directory/<?php
								if ( $terms != null ){
                                    $i=0;
									foreach( $terms as $term ) {
                                        if ($i++ == 0) {
										  print $term->slug ;
										  unset($term);
                                        }
									} 
								}
								?>" class="back employee">Back to <?php
								if ( $terms != null ) {
                                    $i=0;
									foreach( $terms as $term ) {
                                        if ($i++ == 0 ){
										  print $term->name ;
										  unset($term);
                                        }
									}
								}
								?><i></i></a>

							<div id="employee-info" class="cf">

								<div class="photo profile">
									<div>
										<span class="crv lft"></span>
										<span class="crv rt"></span>
										<?php
										the_post_thumbnail('employee_large');

										if($employeeEmail)
										{
											$form_container_page = $wpdb->get_var("
												SELECT ID
													FROM $wpdb->posts
													WHERE post_title = 'Form Container'
														AND post_status = 'publish'
														AND post_type = 'page'
													LIMIT 1;");
											if($form_container_page) {
												?>
										<a id="emailLink" href="<?php echo add_query_arg("employee_id", get_the_ID(), get_permalink($form_container_page)); ?>" class="emailme iframe"><i></i> Contact me</a><br />	
												<?php
											}
										}

										if($employeePhone)
										{
											?>

										P: <?php echo $employeePhone;  ?>

											<?php
										}

										if($employeeFax)
										{
											?>

										<br/>

										F: <?php echo $employeeFax; ?>

											<?php
										}

										if ($employeeLinkedin)
										{
											?>

										<br/>

										<a href="<?php echo $employeeLinkedin; ?>" class="linkedin" title="Find <?php the_title(); ?> on LinkedIn"></a>

											<?php
										}
										?>
									</div>

									<span class="crv btm"></span>
									<?php
									$NMLS = slt_cf_field_value('NMLS');
									$employeeSharefile = slt_cf_field_value('employee_sharefile');
									if ($NMLS || $employeeSharefile)
									{
										?>
									<div class="crv-under">
										<?php
										if($NMLS)
										{
											?><span class="NMLS"><strong>NMLS:</strong> <?php echo $NMLS; ?></span><br/>
											<?php
										}
										if($application)
										{
											?>

											<a class="send" href="<?php echo $application; ?>" target="_blank"><i></i>APPLY FOR A MORTGAGE</a>
										<br/>					
											<?php
										}
										
										if($employeeSharefile)
										{
											?>
											<a id="shareFile" href="<?php echo $employeeSharefile; ?>" class="send iframe"><i></i>SEND FILE</a>
											<?php
										}
										?>
									</div>
										<?php
									}
									?>
								</div><!-- photo profile -->

								<div class="bio">

									<div class="bioinner">
										<div class="branch">

										<?php
										$args2 = array(
											"connected_type" => "locations_to_employees",
											"connected_items" => $post->ID,
											'post_type' => array('location'),
											"posts_per_page" => 1,
											'order' => 'DESC'
										);
										$ids = array(); 

										$connection = new WP_Query ($args2);
										while($connection->have_posts())
										{
											$connection->the_post();
											

											$ids[] = get_the_ID();?>

											<i></i> 		<a href="<?php the_permalink(); ?>"><?php  the_title();  ?></a>
											<?php
										}
										wp_reset_postdata();
										?>
										</div><!-- employee-info -->

									<?php the_content(); /*$employeeDesc= slt_cf_field_value('employee_description'); if($employeeDesc) { echo $employeeDesc; }*/ ?>

									</div><!-- bioinner -->
									<span class="crv lft"></span><span class="crv rt"></span>
								</div><!-- bio -->

								<script type="text/javascript">
									jQuery(document).ready(function() {
										jQuery("#emailLink").fancybox({
											type: 'iframe',
											width: 650,
											height: 900,
											autoDimensions: false,
											fitToView: false,
											autoScale: false
										});

										jQuery("#shareFile").fancybox({
											type: 'iframe',
											width: 375,
											height: 500,
											autoDimensions: false,
											fitToView: false,
											autoScale: false
										});
									});
								</script>
							</div>

							<div class="moreinfo" id="locationinfo">

								<h3><?php the_title();?>&#8217;s Service Locations</h3>

								<ul>

								<?php 
									$args2 = array(
										"connected_type" => "locations_to_employees",
										"connected_items" => $post->ID,
										'post_type' => array('location'),
										'posts_per_page' => -1,
										'order' => 'DESC',
										'orderby' => 'menu_order'//,
										//'post__not_in' => $ids
									);
									$connection = new WP_Query ($args2);
									if($connection->have_posts()) {
										while($connection->have_posts())
										{
											$connection->the_post();
											?>
												<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
											<?php
										}
									}
									wp_reset_postdata();
								?>

								</ul>

							</div><!-- moreinfo -->

							<?php /*
							<div class="moreinfo">
								<h3>More Information about Loans &amp; Credit</h3>

								<ul>
									<li><a href="">Changes in SBA Capital Loan Requirements</a></li>
									<li><a href="">Ten Tips for Managing Receivables</a></li>
								</ul>

							</div><!-- moreinfo --> */ ?>

						</div><!-- int-text -->




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
