<?php 
/* Template Name: New Front Page */ ?>
<!DOCTYPE html>

<html  class="no-js" <?php language_attributes(); fh_html(); ?>>
<head profile="https://gmpg.org/xfn/11">

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <?php if(is_singular()){
        get_post();?>

    <!-- OpenGraph Metadata for Facebook -->
        <meta property="og:title" content="<?php the_title();?>" />
        <meta property="og:type" content="article" />
        <?php if ( has_post_thumbnail() ) {
            $og_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large'); } ?>
        <meta property="og:image" content="<?php echo $og_url[0];?>" />
        <meta property="og:url" content="<?php the_permalink(); ?>" />
        <meta property="og:description" content="<?php echo esc_attr(get_the_excerpt()); ?>" />

    <!-- Twitter -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="<?php the_title();?>" />

    <?php } ?>

    <title><?php wp_title(''); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); echo '?v=2'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/style-print.css" media="print">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/newhomepage.css" />

    <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="image_src" href="<?php bloginfo('stylesheet_directory'); ?>/screenshot.jpg" />

    <?php if (function_exists('add_favicon_link')) add_favicon_link(); ?>
    <!-- WP
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
      -->
    <?php wp_enqueue_script('jquery'); ?>
    <?php wp_head(); ?>

    <script src="https://www.google.com/jsapi" type="text/javascript"></script>

    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/inc/toggleLabel.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/inc/AnythingSlider/css/anythingslider.css" />
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/inc/AnythingSlider/js/jquery.anythingslider.min.js"></script>
    <!-- Load ie.css for IE 6 and 7. Delete the below if you do not need an IE-specific stylesheet, or change the LTE value if you need it to apply to 8 or 9 as well. -->
    <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/ie.css" />
    <![endif]-->


    <?php /* extra og:image added to handle Brafton images, since the original versions
                     aren't uploaded correctly. */
    if ( has_post_thumbnail() && is_single() ) {
            $og_url_med = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_large'); } ?>
    <meta property="og:image" content="<?php echo $og_url_med[0]; ?>" />

</head>
<?php
    $home_id = get_option('page_on_front');
    $home_thumbnail_img = wp_get_attachment_url( get_post_thumbnail_id( $home_id ) );
?>
<body <?php body_class(); ?> style="background-image:url(<?php echo $home_thumbnail_img; ?>)">

    <!-- Facebook Developer API -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <?php echo do_shortcode( '[fhalert]' ); ?>

    <img id="print-logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" width="309" height="124"/>

    <div id="fb-root"></div>

    <script>

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=120774358133383";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

    </script>


    <div id="wrapper">

        <div id="header" class="cf">
        <div class="black-top">
            <div class="inner">
            <ul id="ancillary" class="nav-menu">
                <li <?php fh_check_active(21); ?>><a href="<?php echo get_permalink(21); ?>">Login</a>
                            <?php
                                    $args = array(
                                        'depth'        => 1,
                                        'child_of'     => 21,
                                        'title_li'     => ""
                                    );
                                    $pages = array(
                                        'child_of' => 21
                                    );

                                    $children = get_pages($pages);

                                    if( count( $children ) != 0 ) { ?>
                                        <ul class="subpages">
                                            <?php wp_list_pages( $args ); ?>
                                        </ul>
                                    <?php }
                                    else {  }
                                ?>
                </li>
                <li <?php fh_check_active(23); ?>><a href="<?php echo get_permalink(23); ?>">Locations/ATMs</a>
                            <?php
                                    $args = array(
                                        'depth'        => 1,
                                        'child_of'     => 23,
                                        'title_li'     => ""
                                    );
                                    $pages = array(
                                        'child_of' => 23
                                    );

                                    $children = get_pages($pages);

                                    if( count( $children ) != 0 ) { ?>
                                        <ul class="subpages">
                                            <?php wp_list_pages( $args ); ?>
                                        </ul>
                                    <?php }
                                    else {  }
                                ?>
                        </li>
                <?php /*<li><a href="<?php echo get_permalink(25); ?>">ATMs</a></li>
                <li><a href="<?php echo get_permalink(27); ?>">Contact</a></li>*/ ?>
                <li <?php fh_check_active(29); ?>><a href="<?php echo get_permalink(29); ?>">About</a>
                            <?php
                                    $args = array(
                                        'depth'        => 1,
                                        'child_of'     => 29,
                                        'title_li'     => ""
                                    );
                                    $pages = array(
                                        'child_of' => 29
                                    );

                                    $children = get_pages($pages);

                                    if( count( $children ) != 0 ) { ?>
                                        <ul class="subpages">
                                            <?php wp_list_pages( $args ); ?>
                                        </ul>
                                    <?php }
                                    else {  }
                                ?>
                        </li>
                <li id="nav-help" <?php fh_check_active(14); ?>><a href="<?php echo get_permalink(14); ?>">Help</a>
                            <?php
                                    $args = array(
                                        'depth'        => 1,
                                        'child_of'     => 14,
                                        'title_li'     => ""
                                    );
                                    $pages = array(
                                        'child_of' => 14
                                    );

                                    $children = get_pages($pages);

                                    if( count( $children ) != 0 ) { ?>
                                        <ul class="subpages">
                                            <?php wp_list_pages( $args ); ?>
                                        </ul>
                                    <?php }
                                    else {  }
                                ?>
                        </li>
                <li>

                                <div id="search">

                <form action="<?php bloginfo('url'); ?>/search/" id="cse-search-box">


                    <input type="hidden" name="cx" value="003074495176662961374:n2v17u_bwoi" />
                    <input type="hidden" name="cof" value="FORID:11" />

                    <input type="hidden" name="ie" value="UTF-8" />
          <input type="submit" name="sa" value="Search" id="searchbutton" title="Search" />
                    <label class="input">
                        <span>Search here...</span>
                        <input type="text" id="searchfield" name="q" />
                    </label>

                    <input type="hidden" name="sa" value="Search" />
                    <div class="clear"></div>
                </form>
            </div><!-- #search -->

        </li>

            </ul><!-- #ancillary -->
            </div><!--.inner-->
        </div><!--.black-top-->
            <div class="inner navcontainer">

            <div class="top-container">

                <?php if (is_front_page())  {

                        $header_element = 'h1';

                    } else {

                        $header_element = 'div';

                    } ?>

                    <<?php echo $header_element; ?> id="logo">
                        <a href="<?php bloginfo('url'); ?>">
                            <span>Bank Midwest</span>
                        </a>

                    </<?php echo $header_element; ?>>

          </div><!--.top-container-->

        <ul id="nav" class="nav-menu">

            <li id="link1" <?php fh_check_active(4); ?>>
                <a href="<?php echo get_permalink(4); ?>"><span>Bank</span></a>

                <ul class="subpages mega bank">

                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(63); ?>">Personal</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=63&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>


                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(67); ?>">Business &amp; Farm</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=67&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>

                    <li class="sub last"><div class="head"><a href="<?php echo get_permalink(740); ?>">Service</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=740&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>

                </ul>
            </li>

            <li id="link2" <?php fh_check_active(18); ?>>
                <a href="<?php echo get_permalink(18); ?>"><span>Borrow</span></a>

                <ul class="subpages mega borrow">

                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(446); ?>">Personal</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=446&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>


                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(75); ?>">Business &amp; Farm</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=75&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>

                    <li class="sub last"><div class="head"><a href="<?php echo get_permalink(747); ?>">Service</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=747&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>

                </ul>
            </li>

            <li id="link3" <?php fh_check_active(7); ?>>
                <a href="<?php echo get_permalink(7); ?>"><span>Insure</span></a>

                <ul class="subpages mega insure">

                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(663); ?>">Personal</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=663&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>


                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(93); ?>">Business &amp; Farm</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=93&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>

                    <li class="sub last"><div class="head"><a href="<?php echo get_permalink(702); ?>">Service</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=702&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>

                </ul>
            </li>

            <li id="link4" <?php fh_check_active(9); ?>>
                <a href="<?php echo get_permalink(9); ?>"><span>Invest</span></a>

                <ul class="subpages mega two-col invest">

                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(573); ?>">Investment Services</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=573&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>


                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(766);; ?>">Service</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=766&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>

                </ul>
            </li>

            <li id="link5" <?php fh_check_active(7806); ?>>
                <a href="<?php echo get_permalink(7806); ?>"><span>Trust</span></a>

                <ul class="subpages mega two-col trust">

                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(585); ?>">Trust Services</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=585&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>


                    <li class="sub"><div class="head"><a href="<?php echo get_permalink(8093); ?>">Support</a></div>
                        <ul>
                            <?php
                                $pages = NULL; $pages = wp_list_pages('child_of=8093&depth=1&title_li=&echo=0');
                                if ($pages) {
                                echo '<li>' . $pages . '<li/>';
                            } ?>
                        </ul>
                    </li>

                </ul>
            </li>

            </ul><!-- #nav -->

            </div><!--.inner-->

        </div><!-- #header -->

<?php

global $wp_query; 
$oldquery = $wp_query; 

?>

		<div id="main">
			<div class="inner">
			     <div class="slider">
					<div class="slider-main-image">
                        <div class="overlay">
                        <div class="slider-inner">
                        <div class="new-login-box">
						  <iframe src="https://ib790.lanxtra.com/servlet/SLogin?template=/c/custom/rloginsc.vm"></iframe>
                        </div>
						</div><!--.inner-->
						</div><!--.overlay-->

                        <div class="banner-text">
                            <h2><?php echo get_field('banner_heading'); ?></h2>
                            <h3><?php echo get_field('banner_subhead'); ?></h3>
                            <a class="button" href="<?php echo get_field('banner_button_url'); ?>"><?php echo get_field('banner_button_text'); ?></a>
                        </div>

                        <div class="dates">
                            <div class="inner">
                                <div class="dates-sep">
                                    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/homepage/impdates.png
                                    " />
                                </div>
                                <h2>Important Dates</h2>
                                <div class="date">
                                    <h3><?php echo get_field('date_1'); ?></h3>
                                    <p><?php echo get_field('date_1_txt'); ?></p>
                                </div>
                                <div class="date">
                                    <h3><?php echo get_field('date_2'); ?></h3>
                                    <p><?php echo get_field('date_2_text'); ?></p>
                                </div>
                                <div class="date">
                                    <h3><?php echo get_field('date_3'); ?></h3>
                                    <p><?php echo get_field('date_3_txt'); ?></p>
                                </div>
                            </div>
                        </div>

                        </div><!--.slider-main-image-->
					</div><!--.slider-->
			     </div><!--.inner-->
            
            <div class='clear'></div>
            <div class="how">
                <div class="inner">
                    <h2><span><?php echo get_field('how_heading'); ?></span></h2>

                    <div class="service">
                        <a href="<?php echo get_field('icon_1_url'); ?>">
                            <img src="<?php echo get_field('icon_1'); ?>" />
                            <p><?php echo get_field('icon_1_text'); ?></p>
                        </a>
                    </div>

                    <div class="service">
                        <a href="<?php echo get_field('icon_2_url'); ?>">
                            <img src="<?php echo get_field('icon_2'); ?>" />
                            <p><?php echo get_field('icon_2_text'); ?></p>
                        </a>
                    </div>

                    <div class="service">
                        <a href="<?php echo get_field('icon_3_url'); ?>">
                            <img src="<?php echo get_field('icon_3'); ?>" />
                            <p><?php echo get_field('icon_3_text'); ?></p>
                        </a>
                    </div>

                    <div class="service">
                        <a href="<?php echo get_field('icon_4_url'); ?>">
                            <img src="<?php echo get_field('icon_4'); ?>" />
                            <p><?php echo get_field('icon_4_text'); ?></p>
                        </a>
                    </div>

                    <div class="service">
                        <a href="<?php echo get_field('icon_5_url'); ?>">
                            <img src="<?php echo get_field('icon_5'); ?>" />
                            <p><?php echo get_field('icon_5_text'); ?></p>
                        </a>
                    </div>

                    <div class="service">
                        <a href="<?php echo get_field('icon_6_url'); ?>">
                            <img src="<?php echo get_field('icon_6_img'); ?>" />
                            <p><?php echo get_field('icon_6_text'); ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="community">
                <div class="inner">
                    <h2><div><span><?php echo get_field('community_heading'); ?></span></div></h2>
                    <h3><?php echo get_field('community_subhead'); ?></h3>
                    <?php echo get_field('community_text'); ?>
                </div>
            </div>
            <div class="stats">
                <div class="overlay">
                    <div class="inner">
                        <div class="stat">
                            <span class="top"><?php echo get_field('stat_1_top'); ?></span>
                            <span class="amount"><?php echo get_field('stat_1_amount'); ?></span>
                            <span class="type"><?php echo get_field('stat_1_type'); ?></span>
                        </div>
                        <div class="stat">
                            <span class="top"><?php echo get_field('stat_2_top'); ?></span>
                            <span class="amount"><?php echo get_field('stat_2_amount'); ?></span>
                            <span class="type"><?php echo get_field('stat_2_type'); ?></span>
                        </div>
                        <div class="stat">
                            <span class="top"><?php echo get_field('stat_3_top'); ?></span>
                            <span class="amount"><?php echo get_field('stat_3_amount'); ?></span>
                            <span class="type"><?php echo get_field('stat_3_type'); ?></span>
                        </div>
                        <div class="stat">
                            <span class="top"><?php echo get_field('stat_4_top'); ?></span>
                            <span class="amount"><?php echo get_field('stat_4_amount'); ?></span>
                            <span class="type"><?php echo get_field('stat_1_type'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hoh">
                <div class="site-inner">
                    <h2><span>News & Education</span></h2>
                    <?php // queue the hot topix

                    $topix_array = array('posts_per_page' => 3, 'post_type' => array('post', 'news'));
                    $topixloop = new WP_QUERY ($topix_array);

                    if ($topixloop->have_posts() ) :

                    while ($topixloop->have_posts() ) : $topixloop->the_post();
                    
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );?>   

                            <div class="col">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="feat" style="background-image: url('<?php echo $thumb[0]; ?>')"></div>
                                </a>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php the_excerpt(); ?></p>
                            </div>

                        <?php endwhile; endif; wp_reset_query(); ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- #main -->
        
<!-- footer -->
<div class="inner testingClass">
    <div class="inner-hm-content">
        <div id="footer">

            <div class="container">

                <div class="footer-left">

                    <h2>Contact Us!</h2>
                    <p class="contact-info">Customer Support<br />
                        <strong>Phone:</strong> 888.902.5662<br />
                        <strong>Monday-Friday:</strong> 7am - 7pm<br />
                        <strong>Saturday:</strong> 8am - 12pm<br />
                        <strong>Email:</strong> <a href="mailto:customersupport@bankmidwest.com">customersupport@bankmidwest.com</a>
                    </p>
                    <div id="copyright">

                <?php $footer= slt_cf_field_value('footer_options');

                if ( $footer == 'footer_invest' || $investFooter == true ) { ?>

                    <p>IMPORTANT CONSUMER INFORMATION</p>
                    <p>
                    This site is for informational purposes only and is not intended to be a solicitation or offering of any security and:
                    </p><p>
                    Representatives of a Registered Broker-Dealer ("BD") or Registered Investment Advisor ("IA") may only conduct business in a state if the representatives and the BD or IA they represent (a) satisfy the qualification requirements of, and are approved to do business by, that state; or (b) are excluded or exempted from that state’s registration requirements.
                    </p><p>
                    Representatives of a BD or IA are deemed to conduct business in a state to the extent that they would provide individualized responses to investor inquiries that involve (a) effecting, or attempting to effect, transactions in securities; or (b) rendering personalized investment advice for compensation.
                    </p><p>
                    <strong>We are registered to offer securities in the following states:</strong> Alabama, Arkansas, Arizona, California, Colorado, Florida, Georgia, Iowa, Illinois, Indiana, Kansas, Kentucky, Louisiana, Michigan, Minnesota, Mississippi, Missouri, Montana, Nebraska, New Mexico, North Carolina, North Dakota, Oklahoma, South Carolina, South Dakota, Tennessee, Texas, Washington, and
                    Wisconsin.
                    </p><p>
                    <strong>Fee-based advisory services are available only to residents of:</strong> Arizona, California, Illinois, Iowa, Kentucky, Minnesota, South Dakota, Texas, and Wisconsin.
                    </p><p>
                    <strong>We are licensed to sell insurance products in the following states of:</strong> Iowa, Minnesota, North Dakota, South Dakota, and Wisconsin. I acknowledge that I am a resident of one of the states listed above.
                    </p><p>
                    SII Investments, Inc.&reg; member <a href="http://www.finra.org/" target=“_blank" title="FINRA">FINRA</a>, <a href="http://www.sipc.org/" target=“_blank" title"SIP">SIPC</a> and a Registered Investment Advisor is not affiliated with Bank Midwest or Bank Midwest Wealth Management. Securities and advisory services offered through SII Investments Inc.&reg; are not insured by the FDIC or any other Federal Government Agency, not a deposit or other obligation of, or guaranteed by any bank or their affiliates, and are subject to risks including the possible loss of principal amount invested.</p>

                <?php }

                elseif ( $footer == 'footer_bank' ) { ?>

                <?php }

                else { ?>

                    <p>Securities and insurance products are not deposits, not FDIC insured, not insured by any federal government agency, not guaranteed by the bank, and may go down in value.</p>

                <?php } ?>

                <p>

                <?php

                if ($footer != 'footer_home'  && $footer != 'footer_invest' ) { ?>

                    <a href="/">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                <?php }

                if ($footer != 'footer_invest' ) { ?>

                    <a href="<?php echo get_permalink(529); ?>">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo get_permalink(532); ?>">Customer ID Policy</a>

                <?php }

                if (($footer == 'footer_home') || ($footer == 'footer_bank') || ($post->post_type=='news') || ($post->post_type=='post')) { ?>

                    &nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo get_permalink(535); ?>">Equal Housing Lender Disclosure</a>

                <?php }

                if ( $footer == 'footer_invest') { ?>

                    <a href="https://www.siionline.com/public/forms/sii_madv6130a.pdf">SII Privacy Policy</a></br></br></br>

                <?php } 


                ?>

                </p>

                    <p>
                    <?php if ( $footer == 'footer_invest' ) { ?>

                    <a href="/">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                <?php }
                ?>
                    Copyright &copy;<?php echo date('Y'); ?> Bank Midwest  |  All Rights Reserved.<br />

                <?php

                if (($footer == 'footer_home') || ($footer == 'footer_bank') || ($post->post_type=='news') || ($post->post_type=='post')) { ?>
                <?php   if ($footer != 'footer_insure') { ?>
                    Member FDIC  | <img src="<?php bloginfo('stylesheet_directory'); ?>/images/house.png" width="21" height="18" /> Equal Housing Lender

                <?php  }
                        }
                

                        


                ?>

                    </p>

                </div><!-- copyright -->


                    <!--<div id="hippo">
                        <div class="left"><a href="http://www.flyinghippo.com" target="_blank">Iowa Web Design</a></div>
                        <div class="middle"><a href="http://www.flyinghippo.com" target="_blank"><span>Flying Hippo Web Technologies</span></a></div>
                        <div class="right"><a href="http://www.flyinghippo.com" target="_blank">by Flying Hippo</a></div>
                    </div><!--.hippo-->

                    </div><!--.footer-left-->

                <div id="social">

                        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/homepage/moneypass.png" />
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/homepage/appstore-apple.png" />
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/homepage/appstore-google.png" />

                    <ul class="connect-icons">


                        <?php
                        if ( $footer == 'footer_invest') { ?>
                            <li></li>
                        <?php } else { ?>
                            <li id="social-facebook"><a href="https://www.facebook.com/BankMidwest" target="_blank"><span>Facebook</span></a></li>
                            <li id="social-twitter"><a href="https://twitter.com/bankmidwest" target="_blank"><span>Twitter</span></a></li>
                            <li id="social-linkedin">
                                <a href="https://www.linkedin.com/company/2444559?trk=tyah&trkInfo=tarId%3A1412695809903%2Ctas%3Abank%20midwest%2C%20one%20place%2Cidx%3A1-1-1" target="_blank" title="LinkedIn">
                                    <span>LinkedIn</span>
                                </a>
                            </li>
                            <li id="social-email"><a href="<?php echo get_permalink(823); ?>" title="Sign up for our Weekly Market Update"><span>Newsletter</span></a></li>
                            <li id="social-rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><span>RSS</span></a></li>
                        <?php } ?>
                        <?php if( is_front_page() ) { ?>

                        <?php } ?>
                    </ul>
                </div><!--#social-->

                <div class="dozer"></div><!--.dozer-->

            </div><!-- .container -->

        </div><!-- #footer -->

        </div><!--inner-hm-content-->
    </div><!--.inner-->
    </div><!-- #wrapper -->

    <?php wp_footer(); ?>
    
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/inc/scripts.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function(){
            // BEGIN offsite link notification
            var anchors = jQuery("a[href]");

            for(var i = 0; i < anchors.length; i++)
            {
                var a = jQuery(anchors[i]);
                if(a.hasClass('accordionButton')) {
                    continue;
                }
                var $href = a.attr("href");
                if(
                    <?php
                    $urls = get_option("filter_domains");   // our option name is filter_domains
                    if(empty($urls))
                    {
                        echo "false";
                    }
                    else
                    {
                        // Split on new line
                        $urls_arr = explode("\n", $urls);
                        $first = true;
                        foreach($urls_arr as $url_val)
                        {
                            if(!$first)
                            {
                                echo " || ";
                            }
                            $first = false;
                            ?>
                    $href.indexOf("<?php echo preg_replace("%[^a-zA-Z0-9:./@]%", "", $url_val); ?>") >= 0
                            <?php
                        }
                    }
                    ?>
                    || (
                        $href.indexOf("<?php echo get_bloginfo('url'); ?>") >= 0
                        || $href.indexOf("javascript") >= 0
                        || $href.indexOf("/") == 0
                        || $href.indexOf("#") == 0
                        || $href.indexOf("mailto:") == 0
                    )
                )
                {
                    // NOP
                }
                else
                {
                    a.click(function(){
                        alert( "<?php echo preg_replace(
                            '%[\"]%',
                            "\\\1",
                                preg_replace( "%[\n\r]%", "", str_replace( "\n", "\\n", get_option( "alert_text" ) ) )
                            ); ?>");
                    });
                }
            }
            // END offsite link notification
        });
    </script>

<?php
if (is_page('search')) { ?>
<script type="text/javascript">
  function parseQueryFromUrl () {
    var queryParamName = "q";
    var search = window.location.search.substr(1);
    var parts = search.split('&');
    for (var i = 0; i < parts.length; i++) {
      var keyvaluepair = parts[i].split('=');
      if (decodeURIComponent(keyvaluepair[0]) == queryParamName) {
        return decodeURIComponent(keyvaluepair[1].replace(/\+/g, ' '));
      }
    }
    return '';
  }
  google.load('search', '1', {language : 'en'});
  google.setOnLoadCallback(function() {
    // NOTE: The ID in the next line must be updated to use the ID for the client's account (which should match the ID in header.php's search code)
    var customSearchControl = new google.search.CustomSearchControl('003074495176662961374:n2v17u_bwoi');
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.enableSearchResultsOnly();
    customSearchControl.draw('cse', options);
    var queryFromUrl = parseQueryFromUrl();
    if (queryFromUrl) {
      customSearchControl.execute(queryFromUrl);
    }
  }, true);
</script>
<?php } ?>

<?php
if ( is_page( 8170 ) ) 
{
?>

    <script type="text/javascript">
        var cdCampaignKey = 'CMP-01228-M3G4R6';
    </script>

<?php
}

global $post;

$fullPages = getPageTemplateId( 'template-no-sidebar' );

if( !in_array( $post->ID, $fullPages ) )
{
?>

    <script type="text/javascript">
      var cdJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
      document.write(unescape("%3Cscript src='" + cdJsHost + "analytics.clickdimensions.com/ts.js' type='text/javascript'%3E%3C/script%3E"));
    </script>

    <script type="text/javascript">
      var cdAnalytics = new clickdimensions.Analytics('analytics.clickdimensions.com');
      cdAnalytics.setAccountKey('aQFJ5d8fu9Ui8XlIvqg0KQ');
      cdAnalytics.setDomain('bankmidwest.com');
      cdAnalytics.trackPage();
    </script>

<?php
}
?>

</body>
</html>
<!-- END footer.php -->
