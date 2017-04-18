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
