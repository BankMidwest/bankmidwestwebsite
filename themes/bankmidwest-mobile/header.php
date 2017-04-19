<!DOCTYPE html>

<html  class="no-js" <?php language_attributes(); fh_html(); ?>>
<head profile="http://gmpg.org/xfn/11">

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <!-- APP store banner info-->
    <!-- <meta name="apple-itunes-app" content="app-id=533868909">-->

    <meta name="google-play-app" content="app-id=com.fi6235.godough">
    <meta name="apple-itunes-app" content="app-id=533868909">

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

   	<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

	<?php if (function_exists('add_favicon_link')) add_favicon_link(); ?>
	<!-- WP
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
      -->
	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/inc/smartbanner/jquery.smartbanner.css" type="text/css" media="screen">
	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/inc/smartbanner/jquery.smartbanner.js"></script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/inc/toggleLabel.js"></script></script>

	<?php /* extra og:image added to handle Brafton images, since the original versions
					 aren't uploaded correctly. */
	if ( has_post_thumbnail() && is_single() ) {
			$og_url_med = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium'); } ?>
	<meta property="og:image" content="<?php echo $og_url_med[0]; ?>" />

</head>
<?php 
	$home_id = get_option('page_on_front');
	$home_thumbnail_img = wp_get_attachment_url( get_post_thumbnail_id( $home_id ) );
?>
<body <?php body_class(); ?> id="top" style="background-image:url(<?php echo $home_thumbnail_img; ?>)">
	<?php echo do_shortcode( '[fhalert]' ); ?>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=120774358133383";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div id="wrapper">

		<div id="header">

            <nav id="ancillary" class="nav-menu">

                <ul>
                    <li<?php fh_check_active(4); ?>>
                        <a href="<?php echo get_permalink(21); ?>" id="login">Login</a>
                    </li>

                    <li <?php fh_check_active(23); ?>>
                        <a href="<?php echo get_permalink(23); ?>"  id="locations" ><span>Locations</span></a>
                    </li>

                    <li <?php fh_check_active(29); ?>>
                        <a href="#" class='ancillary-menu-trigger' id="about" >
                            <span>About</span>
                        </a>
                    </li>
                    <li <?php fh_check_active(14); ?>>
                        <a href="#" class='ancillary-menu-trigger' id="help">
                            <span>Help</span>
                        </a>
                    </li>
                </ul>

                <div class='mobile-sub-menus'>
                    <?php
                            $about_children = wp_list_pages(array(
                                'child_of'     => 29,
                                'depth'        => 1,
                                'echo'         => 0,
                                'exclude'      => '',
                                'link_after'   => '',
                                'link_before'  => '',
                                'post_type'    => 'page',
                                'post_status'  => 'publish',
                                'sort_order'   => 'menu_order',
                                'title_li'     => '',
                            ));
                        ?>
                    <ul class='sub-menu about'>
                        <li class='head'>
                            <a href="<?php echo get_permalink(29);?>">
                                <span>About Home</span>
                            </a>
                        </li>
                        <?php echo $about_children; wp_reset_postdata();?>
                    </ul>

                    <?php
                        $help_children = wp_list_pages(array(
                            'child_of'     => 14,
                            'depth'        => 1,
                            'echo'         => 0,
                            'exclude'      => '',
                            'link_after'   => '',
                            'link_before'  => '',
                            'post_type'    => 'page',
                            'post_status'  => 'publish',
                            'sort_order'   => 'menu_order',
                            'title_li'     => '',
                        ));
                    ?>
                    <ul class='sub-menu help'>
                        <li class='head'>
                            <a href="<?php echo get_permalink(14); ?>">
                                <span>Help Home</span>
                            </a>
                        </li>
                        <?php echo $help_children; wp_reset_postdata();?>
                    </ul>
                </div>

            </nav>

        <div class="black-top">

		<nav id="nav" class="nav-menu">

			<ul>

				<li<?php fh_check_active(4); ?>>
					<a href="<?php echo get_permalink(4); ?>"  id="bank" ><span>Bank</span></a>
				</li>

				<li <?php fh_check_active(18); ?>>
					<a href="<?php echo get_permalink(18); ?>"  id="borrow" ><span>Borrow</span></a>
				</li>

				<li <?php fh_check_active(7); ?>>
					<a href="<?php echo get_permalink(7); ?>"  id="insure" ><span>Insure</span></a>
				</li>

				<li <?php fh_check_active(9); ?>>
					<a href="<?php echo get_permalink(9); ?>"  id="plan"><span>Invest</span></a>
				</li>

				<li <?php fh_check_active(7806); ?>>
					<a href="<?php echo get_permalink(7806); ?>"  id="trust"><span>Trust</span></a>
				</li>

			</ul>

			<div class="subpages">
			<ul class="bank">

					<li><a class="highlight" href="<?php echo get_permalink(4); ?>">Bank Home</a></li>


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

					<li class="sub"><div class="head"><a href="<?php echo get_permalink(740); ?>">Service</a></div>
						<ul>
							<?php
								$pages = NULL; $pages = wp_list_pages('child_of=740&depth=1&title_li=&echo=0');
								if ($pages) {
								echo '<li>' . $pages . '<li/>';
							} ?>
						</ul>
					</li>

				</ul><!-- bank -->

				<ul class="borrow">

					<li><a class="highlight" href="<?php echo get_permalink(18); ?>">Borrow Home</a></li>

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

					<li class="sub"><div class="head"><a href="<?php echo get_permalink(747); ?>">Service</a></div>
						<ul>
							<?php
								$pages = NULL; $pages = wp_list_pages('child_of=747&depth=1&title_li=&echo=0');
								if ($pages) {
								echo '<li>' . $pages . '<li/>';
							} ?>
						</ul>
					</li>

				</ul><!-- borrow -->

				<ul class="insure">

					<li><a class="highlight" href="<?php echo get_permalink(7); ?>">Insure Home</a></li>

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

					<li class="sub"><div class="head"><a href="<?php echo get_permalink(702); ?>">Service</a></div>
						<ul>
							<?php
								$pages = NULL; $pages = wp_list_pages('child_of=702&depth=1&title_li=&echo=0');
								if ($pages) {
								echo '<li>' . $pages . '<li/>';
							} ?>
						</ul>
					</li>

				</ul><!-- insure -->


				<ul class="plan">

					<li><a class="highlight" href="<?php echo get_permalink(9); ?>">Invest Home</a></li>

					<li class="sub"><div class="head"><a href="<?php echo get_permalink(573); ?>">Investment Services</a></div>
						<ul>
							<?php
								$pages = NULL; $pages = wp_list_pages('child_of=573&depth=1&title_li=&echo=0');
								if ($pages) {
								echo '<li>' . $pages . '<li/>';
							} ?>
						</ul>
					</li>


					<li class="sub"><div class="head"><a href="<?php echo get_permalink(8090); ?>">Support</a></div>
						<ul>
							<?php
								$pages = NULL; $pages = wp_list_pages('child_of=8090&depth=1&title_li=&echo=0');
								if ($pages) {
								echo '<li>' . $pages . '<li/>';
							} ?>
						</ul>
					</li>

				</ul><!-- plan -->

				<ul class="trust">

					<li><a class="highlight" href="<?php echo get_permalink(7806); ?>">Trust Home</a></li>

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

				</ul><!-- plan -->

			</div><!-- subpages -->


               <?php /*
				 <li id="link5">
					<a href="<?php echo get_permalink(12); ?>"><span>Learn & Tools</span></a>
				<!-- WP
				<?php
					$pages = NULL; $pages = wp_list_pages('child_of=12&depth=1&title_li=&echo=0');
					if ($pages) {
						echo '<ul>' . $pages . '</ul>';
					} ?>
				-->
				</li>

				<li id="link6">
					<a href="<?php echo get_permalink(14); ?>"><span>Get Help</span></a>
				<!-- WP
				<?php
					$pages = NULL; $pages = wp_list_pages('child_of=14&depth=1&title_li=&echo=0');
					if ($pages) {
						echo '<ul>' . $pages . '</ul>';
					} ?>
				-->
				</li> */ ?>

            </nav><!-- #nav -->


		</div><!--.black-top-->

			<div class="top-container">
				<div>Mobile theme</div>



			<?php if (is_front_page()) $header_element = 'h1'; else $header_element = 'div';
				echo '<' . $header_element . ' id="logo">'; ?>
				<a href="<?php bloginfo('url'); ?>">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/bank-midwest-logo.png"/>
				</a>
			<?php echo '</' . $header_element . '>'; ?>

          </div><!--.top-container-->


        </div><!-- #header -->
