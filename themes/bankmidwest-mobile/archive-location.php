<?php
get_header();
$obj_id = get_queried_object_id();

$categories = get_terms(
	'location_types',
	array('hide-empty' => 0)
);
?>

<div id="main">
	<div class="inner">
		<div class="inner-hm-content">
			<div class="hm-content cf">

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
								<a href="<?php echo home_url(); ?>">Home</a> / Locations
							</div>
							<h1>Our Locations</h1>

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
										while(have_posts())
										{
											the_post();
											?>
										case "_<?php echo get_the_ID(); ?>":
											window.location.href = "<?php echo htmlspecialchars(get_permalink()); ?>";
											break;
											<?php
										}
										rewind_posts();
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
									foreach ( $categories as $category )
									{
										$lslug = preg_replace("%[^a-zA-Z0-9]%", "_", $category->slug);
										?>
									kml_<?php echo $lslug; ?> = new google.maps.KmlLayer("<?php echo get_bloginfo('stylesheet_directory'); ?>/KML/maps-cat<?php echo $category->term_id; ?>.xml", {preserveViewport: true, suppressInfoWindows: true});

									kml_<?php echo $lslug; ?>.setMap(map);
									google.maps.event.addListener(kml_<?php echo $lslug; ?>, 'click', gm_click);

										<?php
									}
									?>

									jQuery("input[name='location_cats[]']").click(handle_type_toggle);

								});
							</script>
							<div id="mapFrame" style="width:500px; height:376px; overflow:hidden; display:block; position:relative;">
							</div>

							<div id="locationCells" class="cf">

								<div class="location-type cf">

								<h2>Our Branch Locations</h2>

								<?php

								$args = array(
										'post_type' => 'location',
										'posts_per_page' => -1,
										'tax_query' => array(
											array(
												'taxonomy' => 'location_types',
												'terms' => 'branch-office',
												'field' => 'slug'
											)
										),
										'order' => 'ASC',
										'orderby' => 'name'

								);

								$query = new WP_Query($args);

								while ( $query->have_posts() ) {
										$query->the_post();  ?>

									<div class="cell cf">

										<?php
										if(has_post_thumbnail())
										{ ?>

											<div class="cellImage">
											<?php the_post_thumbnail("employee_thumb"); ?>
											</div><!-- cellImage -->

										<?php }
										else
										{
											// Don't have a thumbnail.  Should probably have a fallback?
										}
										?>
											<div class="cellData">
											<?php
											$permalink = htmlspecialchars(get_permalink());
											echo sprintf("<h3><a href=\"%s\">%s</a></h3>", htmlspecialchars(get_permalink()), get_the_title());
											echo nl2br(htmlentities(slt_cf_field_value("address"))); ?>
											<div class="phone">Ph: <?php echo htmlentities(slt_cf_field_value("phone")); ?>
											</div><!-- phone -->
												<div class="emailLocation">
													<a href="<?php echo $permalink; ?>">view location</a>
														<?php /*
													<?php
													$email = slt_cf_field_value("email");
													if(!empty($email))
													{
														echo sprintf("<a href=\"mailto:%s\">view location</a>", htmlspecialchars($email));
													}
													?> */ ?>
												</div><!-- emailLocation -->
										</div><!-- cellData -->
									</div><!-- cell -->


									<?php
								}
								?>

							</div><!-- location-type -->

								<div class="location-type cf">

									<h2>Our ATM Locations</h2>

									<div class="intro"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/MoneyPassLogo.jpg"/>
										<p>	We have thousands of fee-free ATMs locally and across the country for easy access to your accounts.
											Make a deposit, withdraw some cash or check your balance.
											The following ATM network and locations are available to our customers free of charge.</p>


											<p><a href="http://moneypass.com/atm-locator.aspx">MoneyPass Network</a>&nbsp;&nbsp;&nbsp; Use this ATM locator search to find fee-free ATMs anywhere in the country.</p>



								<?php

								$args = array(
									'post_type' => 'location',
									'posts_per_page' => -1,
									'tax_query' => array(
										array(
											'taxonomy' => 'location_types',
											'terms' => array('drive-up-atm','walk-up-atm'),
											'field' => 'slug'
										)
									),
									'order' => 'ASC',
									'orderby' => 'name'

								);

								$query = new WP_Query($args);

								$i = 0;

								while ( $query->have_posts() ) {
									$query->the_post();  ?>

									<?php if($i>0 && ($i%3==0)) {
										echo '<div class="clearfix"></div>';
									}
										$i++;
									?>


									<div class="cell cf ATM-list">
										<?php /*
										<?php
										if(has_post_thumbnail())
										{ ?>

											<div class="cellImage">
											<?php the_post_thumbnail("employee_thumb"); ?>
											</div><!-- cellImage -->

										<?php }
										else
										{
											// Don't have a thumbnail.  Should probably have a fallback?
										}
										?> */ ?>
											<div class="cellData">
											<?php
											echo sprintf("<h3><a href=\"%s\">%s</a></h3>", htmlspecialchars(get_permalink()), get_the_title());
											echo nl2br(htmlentities(slt_cf_field_value("address"))); ?>
											<?php if(slt_cf_field_value("phone")) { ?>
												<div class="phone">Ph: <?php echo htmlentities(slt_cf_field_value("phone")); ?>
												</div><!-- phone -->
											<?php } ?>
											<?php /*
												<div class="emailLocation">
													<?php
													$email = slt_cf_field_value("email");
													if(!empty($email))
													{
														echo sprintf("<a href=\"mailto:%s\">email location</a>", htmlspecialchars($email));
													}
													?>
												</div><!-- emailLocation --> */?>
										</div><!-- cellData -->
									</div><!-- cell -->


									<?php
								}
								?>
							</div><!-- location-type -->



								</div><!-- locationCells -->

								<div class="clear"></div>
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
