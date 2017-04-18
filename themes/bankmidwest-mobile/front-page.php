<?php
/* Homepage template */

global $wp_query; 
$oldquery = $wp_query; 

get_header();
?>

		<div id="main" class="home">
			<div class="inner">
			<div class="slider">
					<div class="slider-main-image">
						
				
						<div id="sliderContainer">

					<?php 

					$args = array( 	'post_type' => array('homepage_slider'), 
									'orderby' => 'menu_order', 
									'order' => 'ASC',
									'posts_per_page' => 1  );


					query_posts($args); ?>
					<?php while (have_posts()) : the_post(); ?>
	
						<div class="mainimg"><?php the_post_thumbnail('mobile_home');  ?></div>

					<?php endwhile; ?>


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
							<?php if (slt_cf_field_value('homepage_login_banking', 'post', get_option('page_on_front'))){ ?>
									<p>
										<?php echo slt_cf_field_value('homepage_login_banking', 'post', get_option('page_on_front')); ?>
									</p>
								<?php } ?>
							<div id="login-content">

							<div class="Banking active">
								
							<!--	<label for="user_id"></label><input type="text" name="user_id" placeholder="User ID"/> -->
								<?php /*<span class="submit"><a class="btn" href="http://bankmidwestmobile.com/" target="_blank">Online Banking Login</a></span>*/ ?>	<?php /* was https://cm.netteller.com/login2008/Authentication/Views/Login.aspx?fi=bankmidwest&bn=6b588f49e093b599&burlid=0d7aa04f39c289b0 */ ?>
								



								<span class="submit"><a class="btn" href="https://cm.netteller.com/login2008/Authentication/Views/Login.aspx?fi=bankmidwest&bn=6b588f49e093b599&burlid=0d7aa04f39c289b0" target="_blank"/>Online Banking Login</a></span>
								
								<?php if (slt_cf_field_value('homepage_login_banking')){ ?>
									<p>
										<?php echo slt_cf_field_value('homepage_login_banking'); ?>
									</p>
								<?php } ?>
							</div>

							<div class="Deposit">
								<span class="submit"><a class="btn" href="https://ssl.selectpayment.com/mp/bankmidwest/login/page.aspx"  target="_blank">Online Deposit Login</a></span>
								<?php if (slt_cf_field_value('homepage_login_deposit')){ ?>
									<p>
										<?php echo slt_cf_field_value('homepage_login_deposit'); ?>
									</p>
								<?php } ?>
							</div>

							<div class="Credit">
								<span class="submit"><a class="btn" href="https://www.myaccountaccess.com/elanCard/login.do?theme=elan0&loc=2522"  target="_blank">Credit Card Login</a></span>
								<?php if (slt_cf_field_value('homepage_login_credit')){ ?>
									<p>
										<?php echo slt_cf_field_value('homepage_login_credit'); ?>
									</p>
								<?php } ?>
							</div>

							<div class="Prepaid">
								<span class="submit"><a class="btn" href="https://www2.transcard.com/ThemedLogin.aspx" target="_blank">Gift Card Login</a></span>
								<?php if (slt_cf_field_value('homepage_login_prepaid')){ ?>
									<p>
										<?php echo slt_cf_field_value('homepage_login_prepaid'); ?>
									</p>
								<?php } ?>
							</div>

							<div class="OtherServices">
								<span class="submit"><a class="btn" href="<?php echo get_permalink(21); ?>">Other Services</a></span>
								<?php if (slt_cf_field_value('homepage_login_other')){ ?>
									<p>
										<?php echo slt_cf_field_value('homepage_login_other'); ?>
									</p>
								<?php } ?>
							</div>

							</div>

						</div><!--.login-box-->

						</div><!-- slider Container -->
					</div><!--.slider-main-image-->
			</div><!--.slider-->
			
			<div class="inner-hm-content">
				
				
				<div class="hm-content">
				<div class="hm-text">

    	<?php 
    		$wp_query = $oldquery; 
 			the_post();  wp_reset_query();
    	?>      
    							
							
								</br>
								</br>

					<?php the_content();  ?>


				</div><!--.hm-text-->


				<?php get_sidebar('home') ?>

				</div><!--.hm-content-->
				
			</div><!--.inner-hm-content-->
				<!-- Content exclusive to the homepage goes here. -->
			</div><!--.inner-->
        </div><!-- #main -->
        

<?php get_footer(); ?>
