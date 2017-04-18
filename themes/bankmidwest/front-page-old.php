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
					<?php while (have_posts()) : the_post(); 
                    $imageLink = slt_cf_field_value('homepage_slider_link');
                    ?>
<li>
<?php if( $imageLink ){ echo '<a href="'.$imageLink.'">';} else { echo '<a href="#">';}?>
	<img src="<?php echo wp_get_attachment_url(slt_cf_field_value('homepage_slider_image' ));?>" alt="<?php $homepageSlider = slt_cf_field_value('homepage_slider_descr'); if($homepageSlider) { echo $homepageSlider; } ?>" />
<!--width="868" height="440"-->
	</a>
        
</li>
					<?php endwhile; ?>

							</ul>
						</div><!-- slider Container -->
					</div><!--.slider-main-image-->
				<div class="right-arrow">
                
                    <div class="home-slider-social">
                        <ul class="connect-icons">
                            <li id="social-facebook">
                                <a target="_blank" href="https://www.facebook.com/BankMidwest">
                                    <span>Facebook</span>
                                </a>
                            </li>
                            <li id="social-twitter">
                                <a target="_blank" href="https://twitter.com/bankmidwest">
                                    <span>Twitter</span>
                                </a>
                            </li>
                            <li id="social-linkedin">
                                <a target="_blank" href="https://www.linkedin.com/company/2444559?trk=tyah&trkInfo=tarId%3A1412695809903%2Ctas%3Abank%20midwest%2C%20one%20place%2Cidx%3A1-1-1" title='LinkedIn'>
                                    <span>LinkedIn</span>
                                </a>
                            </li>                            

                            <li id="social-email">
                                <a title="Sign up for our Weekly Market Update" href="http://www.bankmidwest.com/plan/service/weekly-market-update/">
                                    <span>Newsletter</span>
                                </a>
                            </li>
                            <li id="social-rss">
                                <a target="_blank" href="http://www.bankmidwest.com/feed/">
                                    <span>RSS</span>
                                </a>
                            </li>                            
                        </ul>
                    </div><!--social-->
                
                </div><!--.right-arrow-->
			</div><!--.slider-->
            
            <div class='clear'></div>
            
			<div class="inner-hm-content">
                <!-- Rename once function is clear -->
                <div class='featured-banner'>
                    <div class="events-news-blog-container">
                        <div class="events-module">
                            <div class='event-inner'>
                                <h3>
                                    <a href="/events" class="news-title">Events</a>
                                </h3>
                                <?php
                                $q = new WP_Query(array(
                                    "post_type" => "event",
                                    "posts_per_page" => 2,
                                    "event_filter" => "upcoming"
                                ));

                                while ($q->have_posts())
                                {
                                    $q->the_post();

                                    $end_date = preg_replace("/000$/", "", slt_cf_field_value("end_date"));
                                ?>
                                <div class='single-event'>
                                    <div class="event-date">
                                        <?php
                                        $event_date = slt_cf_field_value("event_date");
                                        if ( !empty( $event_date ) ) {
                                            $fh_date = date("n/d", preg_replace("/000$/", "", $event_date));
                                            echo $fh_date;
                                        }
                                        ?>                            
                                    </div>

                                    <div class="event-description">
                                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><img src="<?php echo get_template_directory_uri(); ?>/images/arrow-green.png" width="5" height="9" class="arrow" /> 
                                    </div>
                                    <div class='clear'></div>
                                </div><!--single-event-->
                                <?php }
                                wp_reset_query(); 
                                ?>
                                <div class="dozer"></div>
                            </div> 
                        </div><!--events-module-->
                        <div class="news-module">
                            <div class='news-inner'>
                                <h3><a href="/news" class="news-title">News</a> <a href="/news/rss" class="rss" target="_blank">RSS</a></h3>
                                <?php query_posts( array( 'post_type' => array('news'), 'showposts' => 2  ) ); ?>
                                <?php while (have_posts()) : the_post(); ?>

                                    <div class="single-news">
                                        <div class="news-date">
                                            <?php the_time('n/d') ?>
                                        </div>
                                        <div class="news-text">
                                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-green.png" width="5" height="9" class="arrow" /> 
                                        </div>
                                        <div class='dozer'></div>
                                    </div>
                                <?php endwhile; wp_reset_query(); ?>     
                                <div class='clear'></div>
                            </div>
                        </div><!--news-module-->
                        
                        <div class='blog-module'>
                            <div class='blog-inner'>
                                <h3>
                                    <a href="<?php echo get_permalink(257) ?>">Blog</a> 
                                    <a href="<?php bloginfo('rss2_url'); ?>" target="_blank" class="rss">RSS</a>
                                </h3>
                                <?php query_posts('showposts=1'); ?>
                                <?php while (have_posts()) : the_post(); ?>
                                <div class='single-blog'>
                                    <div class="blog-title"> 
                                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                    </div>
                                    <div class="blog-text">
                                        <span class="blog-date"><?php the_time('n/d'); ?> </span>
                                        <p class='excerpt'><?php echo excerpt(10); ?></p>
                                    </div><!--.blog-text-->
                                    <!--<a href="<?php the_permalink() ?>" class="read-more">Read more</a>-->
                                </div>
                                <?php endwhile; wp_reset_query(); ?>
                                <div class='dozer'></div>
                            </div>
                        </div><!--blog-module-->
                        
                        <div class='dozer'></div>
                    </div><!-- blog-news-events-container-->
                </div><!--featured-banner-->

                <div class="hm-content">
                    <div class="alerts-module">

                        <?php query_posts( array( 
                            'post_type' => array('home_announcements'), 
                            'showposts' => 3, 
                            'orderby' => 'menu_order', 
                            'order' => 'ASC'  ) ); 

                            $i=0;
                            $isfirst = true;
                            if (have_posts()) {
                                while (have_posts()) {
                                    the_post(); 
                                    $alert_title = slt_cf_field_value('announcement_title');
                                    $alertlink = slt_cf_field_value('announcement_link');
                                    
                                    if ( has_post_thumbnail()) {
                                        $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
                                        /*
                                        if (!empty ( slt_cf_field_value('announcement_link') )) {
                                            $alertlink = slt_cf_field_value('announcement_link');
                                        }
                                        if (!empty ( slt_cf_field_value('announcement_title') )) {
                                            $alert_title = slt_cf_field_value('announcement_title');
                                        }
                                        */
                                        
                                        ?>
                                        <div class='alert-box image box<?php echo $i;?>' style='background-image: url("<?php echo $url[0]; ?>"); background-repeat:no-repeat;background-size:cover;'>
                                            <a href="<?php echo $alertlink;?>">
                                            </a> 
                                        </div><!--alert-box-->                                                   
                                    <?php } else {                                        
                                        
                                        $url = ''; 
                                        ?>
                                        <div class='alert-box text box<?php echo $i;?>' style=''>
                                            <a class="learn-more" href="<?php echo $alertlink;?>">                   
                                                <div class='alert-box-inner'>
                                                    <h3 class="alert-title">
                                                        <?php if (!empty($alert_title)){echo $alert_title;}?>
                                                    </h3>
                                                    <?php echo the_content(); ?>
                                                </div>
                                            </a> 
                                        </div><!--alert-box-->   
                                        <?php }
                                    $i++;
                                }
                            } wp_reset_query(); //endif ?>
                        <div class='dozer'></div>
                    </div><!--alerts-module-->    
                    
                    <div class="hm-text">
                    <?php 
                        $wp_query = $oldquery; 
                        the_post();  wp_reset_query();
                    ?>      

                                <?php the_content();  ?>


                    </div><!--hm-text-->

                    <div class='home-sidebar'>
                        <?php // get_sidebar('home') ?>
                        <div class='sidebar-button'>
                            <a class="contact" href="<?php echo get_permalink(299); ?>">Contact Us</a>
                        </div>
                        <div class='sidebar-button'>
                            <a title="Available on the App Store" href="http://itunes.apple.com/us/app/bank-midwest-mobile/id533868909?mt=8" target="_blank">
                                <img class="alignright" title="Available on the App Store" src="https://www.bankmidwest.com/wp-content/uploads/2013/08/icon_App_Store_Badge.png" alt="App Store" width="145" height="50" />
                            </a>
                        </div>
                        <div class='sidebar-button'>
                            <a href="https://play.google.com/store/apps/details?id=com.fi6235.godough" target="_blank">
                                <img class="alignright" title="Get it on Google Play" src="https://www.bankmidwest.com/wp-content/uploads/2013/08/icon_get_it_on_play_logo_170x60.png" alt="Mobile Banking App: Get It On Google Play" width="144" height="50" />
                            </a>
                        </div>
                        
                    </div><!--home-sidebar-->

                    <div class="dozer"></div><!--.dozer-->
				</div><!--.hm-content-->
				
			</div><!--.inner-hm-content-->
				<!-- Content exclusive to the homepage goes here. -->
				<div class="dozer"></div><!--.dozer-->
			</div><!--.inner-->
        </div><!-- #main -->
        

<?php get_footer(); ?>
