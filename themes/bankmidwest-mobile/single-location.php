<?php
get_header();
$obj_id = get_queried_object_id();
$q = new WP_Query(array(
	"post_type" => "location",
	"posts_per_page" => -1
));

$categories = get_terms(
	'location_types',
	array('hide-empty' => 0)
);
?>

	<div id="main">
		<div class="inner">
			<div class="inner-hm-content">
				<div class="hm-content">

					<div class="title-image">
						<h1 class="page-title">Locations</h1>
					</div><!--.title-image-->
					<div class="dozer"></div><!--.dozer-->

					<div id="sidebar">

						<?php get_sidebar('locations'); ?>

					</div><!-- #sidebar -->

					<div id="content">


						<div id="inner-content">
							<div class="int-text">
								<div class="crumb">
									<a href="<?php echo home_url(); ?>">Home</a> / <a href="<?php echo home_url("/location"); ?>">Locations</a> / <?php the_title(); ?>
								</div>

								<?php echo sprintf('<h1 class="locationTitle"><a href=\"%s\>%s</a></h1>', htmlspecialchars(get_permalink()), get_the_title()); ?></h1>

								<script type="text/javascript">
									<?php
									foreach($categories as $category)
									{
										$lslug = preg_replace("%[^a-zA-Z]%", "_", $category->slug);
										echo "var kml_{$lslug} = null;\n";
									}
									?>
									function render_location(node_id)
									{
										// our node_id has all the information we need to retrieve location data.
										jQuery.ajax({
											url: "<?php echo get_bloginfo("stylesheet_directory"); ?>/ws_location_pane.php",
											data: "location=" + node_id,
											dataType: 'json',
											error: function(jqXHR, textStatus, errorThrown) {
												// TODO: figure out a good way to display this error (or not?)
											},
											success: function(data, textStatus, jqXHR) {
												if(data.success)
												{
													// DO SOMETHING?
												}
											}
										});
									}

									var myMarker = null;

									function handle_type_toggle(cbi)
									{
										//jQuery("#console").html(jQuery("#console").html() + "\nhandle_type_toggle();");
										var cb = jQuery(this);

										var slug = cb.attr("id").replace(/lcat-/, "");
										var estr = "kml_" + slug + ".setMap(" + (cb.attr("checked") ? "map" : "null") + ");";

										if(cb.attr("checked"))
										{
											cb.parent().parent().addClass("active");
										}
										else
										{
											cb.parent().parent().removeClass("active");
										}

										//jQuery("#console").html(jQuery("#console").html() + "\neval(\"" + estr + ");\"");
										eval(estr);
									}

									function gm_click(kmlEvent)
									{
										var node_id = kmlEvent.featureData.id.replace(/^[a-zA-Z0-9-]+/, "");
										switch(node_id)
										{
											<?php
											$q = new WP_Query(array(
												"post_type" => "location",
												"post_status" => "publish"
											));
											while($q->have_posts())
											{
												$q->the_post();
												?>
											case "_<?php echo get_the_ID(); ?>":
												window.location.href = "<?php echo htmlspecialchars(get_permalink()); ?>";
												break;
												<?php
											}
											rewind_posts();
											the_post();
											?>
											default:
												break;
										}
									}

									jQuery(document).ready(function(){
									var latlng = new google.maps.LatLng(43.423100,-95.104200);
										var styles = [
											{
												stylers: [
													{ invert_lightness: false }
												]
											}
										];
										var mt = new google.maps.StyledMapType(styles, {name: "InverseMap"});
										var myOptions = {
											zoom: 7,
											center: latlng,
											mapTypeControlOptions: {
												mapTypeId: [google.maps.MapTypeId.ROADMAP, 'inv_map']
											}
										};
										map = new google.maps.Map(document.getElementById("mapFrame"),
											myOptions);
										map.mapTypes.set('inv_map', mt);
										map.setMapTypeId('inv_map');

										<?php
										/*
										// The following section has been blocked out to prevent full range of maps
										// from being visible when looking at a single location:
										foreach ( $categories as $category )
										{
											$lslug = preg_replace("%[^a-zA-Z0-9]%", "_", $category->slug);
											?>
										kml_<?php echo $lslug; ?> = new google.maps.KmlLayer("<?php echo get_bloginfo('stylesheet_directory'); ?>/KML/maps-cat<?php echo $category->term_id; ?>.xml", {preserveViewport: true, suppressInfoWindows: true});

										kml_<?php echo $lslug; ?>.setMap(map);
										google.maps.event.addListener(kml_<?php echo $lslug; ?>, 'click', gm_click);

											<?php
										}
										*/
										?>

										myMarker = new google.maps.Marker({
											position: new google.maps.LatLng(
												<?php
												$pos = slt_cf_field_value("marker_coords");
												echo $pos["marker_latlng"];
												?>
											),
											map: map
										});

										jQuery("input[name='location_cats[]']").click(handle_type_toggle);

									});
								</script>
								<div id="mapFrame" style="width:500px; height:376px; overflow:hidden; display:block; position:relative;">
								</div>
							
								<div class="locationTop cf">
								<div id="locationPanel" class="cf">
										<div class="locationData cf">



											<?php
											if(has_post_thumbnail())
											{ ?>
												<div class="locationImage">
													<?php the_post_thumbnail("location_single"); ?>
												</div>

											<?php } else { 
											}
											?>

									<h3><?php echo preg_replace("~,.*$~", "", get_the_title()) ?> Address</h3>

											<?php
											echo nl2br(htmlentities(slt_cf_field_value("address"))); 
											foreach(array("phone","fax") as $f)
											{
												$$f = slt_cf_field_value($f);
												if(empty($$f))
												{
													continue;
												}
												?>
											<div class="<?php echo $f; ?>">
												<?php echo strtoupper(substr($f, 0, 1)) . ": " . htmlentities($$f); ?>
											</div>
												<?php
											}
											?>
										</div>
							
								</div>




									<?php 		

									$lobbyHours = slt_cf_field_value('lobby_hours');
									$driveHours = slt_cf_field_value('drive_hours');
									$walkHours = slt_cf_field_value('walk_hours'); 

									if ( $lobbyHours || $driveHours || $walkHours ) { ?>

										<div  class="locationHours">

											<h3><?php echo preg_replace("~,.*$~", "", get_the_title()) ?> Hours</h3>

											<ul>

												<?php if($lobbyHours) { ?>
												
													<li>
														<strong>Lobby Hours</strong>
														<p><?php echo $lobbyHours ?></p>
													</li>

												<?php } ?>

												<?php if($driveHours) { ?>

													<li>
														<strong>Drive-Up Hours</strong>
														<p><?php echo $driveHours ?></p>
													</li>

												<?php } ?>

												<?php if($walkHours) { ?>

													<li>
														<strong>Walk-Up Hours</strong>
														<p><?php echo $walkHours ?></p>
													</li>

												<?php } ?>

											</ul>

										</div><!-- locationhours -->

									<?php }  ?>

									<?php $employeeCats = slt_cf_field_value('employee_categories'); ?>

										<?php if($employeeCats) { ?> 

											<div class="services">

												<h3><?php echo preg_replace("~,.*$~", "", get_the_title()) ?> Services</h3>

												<ul>

												<?php 	if (!is_null($employeeCats) && is_array($employeeCats)) { 

													foreach ($employeeCats as $term_ID ) {

													$category = get_term($term_ID,'employee_categories' );

													if ($category->name == 'Bank' ) { ?>

														<li><a href="<?php echo get_permalink(4);?>" class="<?php echo $category->name; ?>"><?php echo $category->name; ?><i></i></a></li>

													<?php } elseif ($category->name == 'Plan' )  { ?>

			 											<li><a href="<?php echo get_permalink(9);?>" class="<?php echo $category->name; ?>"><?php echo $category->name; ?><i></i></a></li>
													
													<?php } elseif ($category->name == 'Borrow' )  { ?>

			 											<li><a href="<?php echo get_permalink(18);?>" class="<?php echo $category->name; ?>"><?php echo $category->name; ?><i></i></a></li>

													<?php } elseif ($category->name == 'Insure' )  { ?>

			 											<li><a href="<?php echo get_permalink(7);?>" class="<?php echo $category->name; ?>"><?php echo $category->name; ?><i></i></a></li>

													<?php } else { ?>	

			 										<?php } ?>

			 									<?php } ?>

			 									</ul>


		 								<?php } ?>
		 								
									<?php } ?>


									<?php 

									$hasTerm = has_term('drive-up-atm', 'location_types', $post->ID);

									if($hasTerm) { ?>

											<ul class="services-nolink">
												<li><span class="atm">Drive-Up ATM</span></li>
											</ul>

									<?php } else { ?>	


									<?php }?>

									<?php 

									$hasTerm = has_term('walk-up-atm', 'location_types', $post->ID);

									if($hasTerm) { ?>

											<ul class="services-nolink">
												<li><span class="atm">Walk-Up ATM</span></li>
											</ul>

									<?php } else { ?>	


									<?php }?>


 												

											</div><!-- services -->

							</div><!-- locationTop -->	

							<div class="locationDirectory">

						<?php 

						$employeeBranch = get_the_ID();
						$employeeKey = slt_cf_field_key('employee_branch');


						?>


								<table cellpadding="0" border="0" cellspacing="0">

					<?php 

						$employeeLname = slt_cf_field_key('employee_lname');


						$args = array( 
							'connected_type' => 'locations_to_employees',
  							'connected_items' => get_queried_object(),
							'post_type' => array('employee'), 
							'posts_per_page' => -1,
							'orderby' => 'meta_value',
							'meta_key' => $employeeLname,
							'order' => 'ASC',
							); 


							$q = new WP_Query ($args); 

							if ( $q->have_posts() ) { ?>

							<h3><?php echo preg_replace("~,.*$~", "", get_the_title()) ?> Employees</h3>

									<?php while ( $q->have_posts() ) {
										$q->the_post(); 

										$employee = get_the_ID(); 

										$employeeFname= slt_cf_field_value('employee_fname');
										$employeeLname= slt_cf_field_value('employee_lname');
										?>

									<tr>
										<td><a href="<?php echo get_permalink($employee)?>"><?php echo $employeeFname; ?> <?php echo $employeeLname; ?></a></td>
										<td><?php $employeeTitle = slt_cf_field_value('employee_title'); if($employeeTitle) { echo $employeeTitle; } ?></td>
										<td><?php $employeePhone = slt_cf_field_value('employee_phone'); if($employeePhone) { echo $employeePhone; } ?></td>
										<td><a href="mailto:<?php  $employeeEmail = slt_cf_field_value('employee_email'); if($employeeEmail) { echo $employeeEmail; } ?>" class="emailme"><i></i> Contact</a></td>
									</tr>

							    <?php
							    }
						} else {
						    // no posts found
						}
						/* Restore original Post Data */
						wp_reset_postdata();

						?>

								</table>
							</div>
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
