<?php
/* Homepage template */

global $wp_query; 
$oldquery = $wp_query; 

get_header();
?>

		<div id="main">
			<div class="inner">
			<div class="slider">
				<div class="left-arrow"></div><!--.left-arrow-->
					<div class="slider-main-image">
						<div class="login-box">
							<div id="login-select-wrap"><i></i>
								<select class="select" id="login-select">
									<option value="Banking" selected="selected">Online Banking</option>
									<option value="Deposit">Online Deposit</option>
									<option value="Credit" >Credit Card</option>
									<option value="Prepaid" >Prepaid or Gift Card</option>
									<option value="OtherServices" >Other Services</option>
								</select>
							</div>

							<div id="login-content">

							<div class="Banking active">
								
							<!--	<label for="user_id"></label><input type="text" name="user_id" placeholder="User ID"/> -->
							<script type="text/javascript" src="https://tether.netteller.com/bankmidwest/login.js"></script>
							<script type="text/javascript">
								jQuery(document).ready(function(){
									jQuery("form#login input[name='id']").focus();
								});
							</script>
							<?php /*
								<form name="login" id="login" class="wide" method="post" action="https://cm.netteller.com/login2008/Authentication/Views/Login.aspx?fi=bankmidwest&bn=6b588f49e093b599&burlid=0d7aa04f39c289b0">
                                  <input type="hidden" name="pin" value="" />
							      <h2>Online Banking Login</h2>
							 
							      <table>
							        <tr>
							          <td><label for="id">ID</label></td>
							          <td><input name="id" size="13" type="text"></td>
							 
							          <td><input name="submit" value="Submit" type="submit" class="button"></td>
							        </tr>
							      </table>
							    </form>
								<?php /*<span class="submit"><a class="btn" href="https://cm.netteller.com/login2008/Authentication/Views/Login.aspx?fi=bankmidwest&bn=6b588f49e093b599&burlid=0d7aa04f39c289b0" target="_blank"/>Online Banking Login</a></span> */ ?>
								<p>
									<a href="https://cm.netteller.com/login2008/enroll.aspx?fi=bankmidwest&bn=6b588f49e093b599&burlid=0d7aa04f39c289b0" target="_blank" class="enroll">Enroll Now</a>
								</p>

								<?php if (slt_cf_field_value('homepage_login_banking')){ ?>
									<p class="alert-message">
										<?php echo slt_cf_field_value('homepage_login_banking'); ?>
									</p>
								<?php } ?>
							</div> 
						</div>

							<div class="Deposit">
								<span class="submit"><a class="btn" href="https://ssl.selectpayment.com/mp/bankmidwest/login/page.aspx"  target="_blank">Online Deposit Login</a></span>
								<?php if (slt_cf_field_value('homepage_login_deposit')){ ?>
									<p class="alert-message">
										<?php echo slt_cf_field_value('homepage_login_deposit'); ?>
									</p>
								<?php } ?>
							</div>

							<div class="Credit">
								<span class="submit"><a class="btn" href="https://www.myaccountaccess.com/elanCard/login.do?theme=elan0&loc=2522"  target="_blank">Credit Card Login</a></span>
								<?php if (slt_cf_field_value('homepage_login_credit')){ ?>
									<p class="alert-message">
										<?php echo slt_cf_field_value('homepage_login_credit'); ?>
									</p>
								<?php } ?>
							</div>

							<div class="Prepaid">
								<span class="submit"><a class="btn" href="https://www2.transcard.com/ThemedLogin.aspx" target="_blank">Gift Card Login</a></span>
								<?php if (slt_cf_field_value('homepage_login_prepaid')){ ?>
									<p class="alert-message">
										<?php echo slt_cf_field_value('homepage_login_prepaid'); ?>
									</p>
								<?php } ?>
							</div>

							<div class="OtherServices">
								<span class="submit"><a class="btn" href="<?php echo get_permalink(21); ?>">Other Services</a></span>
								<?php if (slt_cf_field_value('homepage_login_other')){ ?>
									<p class="alert-message">
										<?php echo slt_cf_field_value('homepage_login_other'); ?>
									</p>
								<?php } ?>
							</div>

							</div>

						</div><!--.login-box-->
				
						<div id="sliderContainer">
							<ul id="homeSlider">

					<?php query_posts( array( 'post_type' => array('homepage_slider'), 'orderby' => 'menu_order', 'order' => 'ASC'  ) ); ?>
					<?php while (have_posts()) : the_post(); ?>
<li>
<a href="#">
	<img src="<?php echo wp_get_attachment_url(slt_cf_field_value('homepage_slider_image' ));?>" alt="<?php $homepageSlider = slt_cf_field_value('homepage_slider_descr'); if($homepageSlider) { echo $homepageSlider; } ?>" width="868" height="623"/>
	</a>

		<div id="home-boxes">

				<?php $header1txt = slt_cf_field_value('homepage_slider_btn1_header'); ?>
				<?php if ($header1txt) { ?>


			<div class="box-one">

									<?php $btn1icon = slt_cf_field_value('homepage_slider_btn1_icon');

										$src = wp_get_attachment_image_src($btn1icon, 'full');


									if($btn1icon) { ?>

										<i class="icon" style="background: url(<?php echo $url = $src[0]; ?>)"></i>


									<?php } else {   ?>

										<i class="icon" style="background: url(<?php bloginfo('stylesheet_directory');?>/images/icon_creditcards.png)"></i>
									
									<?php } ?>


							<div class="box-text">

								<a href="<?php $header1link = slt_cf_field_value('homepage_slider_btn1_link'); if($header1link) { echo $header1link; } ?>">
								<h2><?php if($header1txt) { echo $header1txt; } ?></h2>
								<?php $btn1txt = slt_cf_field_value('homepage_slider_btn1_txt'); if($btn1txt) { echo $btn1txt; } ?>	
								</a>						
							</div><!--.box-text-->

							<i class="next"></i>


						</div><!--.box-one-->
						<?php } ?>

				<?php $header2txt = slt_cf_field_value('homepage_slider_btn2_header'); ?>

				<?php if ($header2txt) { ?>

						<div class="box-two">


									<?php $btn2icon = slt_cf_field_value('homepage_slider_btn2_icon');

											$src = wp_get_attachment_image_src($btn2icon, 'full');


									if($btn2icon) { ?>

										<i class="icon" style="background: url(<?php echo $url = $src[0]; ?>);?>"></i>

									<?php } else {   ?>

										<i class="icon" style="background: url(<?php bloginfo('stylesheet_directory');?>/images/icon_creditcards.png)"></i>
									
									<?php } ?>


							<div class="box-text">
								<a href="<?php $header2link = slt_cf_field_value('homepage_slider_btn2_link'); if($header2link) { echo $header2link; } ?>">
								<h2><?php if($header2txt) { echo $header2txt; } ?></h2>
								<?php $btn2txt = slt_cf_field_value('homepage_slider_btn2_txt'); if($btn2txt) { echo $btn2txt; } ?>	
								</a>						
							</div><!--.box-text-->

							<i class="next"></i>

						</div><!--.box-two-->

						<?php } ?>

		</div><!-- home-boxes -->

</li>
					<?php endwhile; ?>

							</ul>
						</div><!-- slider Container -->
					</div><!--.slider-main-image-->
				<div class="right-arrow"></div><!--.right-arrow-->
			</div><!--.slider-->
			
			<div class="inner-hm-content">
				<div class="highlights">



					<?php query_posts( array( 'post_type' => array('home_announcements'), 'showposts' => 3, 'orderby' => 'menu_order', 'order' => 'ASC'  ) ); ?>
					<?php
						$i=0;
						$isfirst = true;
						$wider;
						while (have_posts())
						{
							the_post();
							if ($isfirst == true) {
								$wider = "wider";
							} else {
								$wider = "";
							}
							$isfirst = false;	
							if (has_post_thumbnail()) { ?>


							<div class="alert-image <?php echo $wider; ?>">
								<a href="<?php $alertlink = slt_cf_field_value('announcement_link'); if($alertlink) { echo $alertlink; } ?>"><?php echo the_post_thumbnail('home_announcment_image'); ?></a>
							</div><!--.apply-->
		
						<?php } else { ?>
		
		
								<div class="text <?php echo $wider; ?>">
									<h3 class="alert-title"><?php $alerttitle = slt_cf_field_value('announcement_title'); if($alerttitle) { echo $alerttitle; } ?></h3>
									<?php the_content();/*$alerttext = slt_cf_field_value('announcement_text'); if($alerttext) { echo $alerttext; }*/ ?>
									<a class="learn-more" href="<?php $alertlink = slt_cf_field_value('announcement_link'); if($alertlink) { echo $alertlink; } ?>">Learn More</a>
								</div><!--.text-->
								
						<?php  } ?>
		

					<?php 
					$i++;
					} 
					?>


				</div><!--.highlights-->
				
				<div class="hm-content">
				<div class="hm-text">

    	<?php 
    		$wp_query = $oldquery; 
 			the_post();  wp_reset_query();
    	?>      

					<?php the_content();  ?>


				</div><!--.hm-text-->


				<?php get_sidebar('home') ?>

				<div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				
			</div><!--.inner-hm-content-->
				<!-- Content exclusive to the homepage goes here. -->
				<div class="dozer"></div><!--.dozer-->
			</div><!--.inner-->
        </div><!-- #main -->
        

<?php get_footer(); ?>
