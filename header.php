<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<!-- <div class='background-image-slider'>
		</div>
		<div class='sticky-back'>
		</div> -->
		<div class='sticky-holder sticky-holder-one'>
			<nav id="site-navigation" class="main-navigation wrapper" role="navigation">
				<nav id="top-navigation" class="top-navigation wrapper" role="navigation">
					<ul id='social-menu' class='social-menu menu'>
						<li class='menu-item facebook-li'><a href='https://www.facebook.com/europeanmotors.wa'>FB</a></li>
						<li class='menu-item twitter-li'><a href='https://twitter.com/euromotoservcen'>TW</a></li>
						<li class='menu-item linkedin-li'><a href='https://www.linkedin.com/company/european-motors-service-center'>Pi</a></li>
						<li class='menu-item google-plus-li'><a href='https://plus.google.com/100002154887378139579/about'>In</a></li>
					</ul>
					<ul id='customer-menu' class='customer-menu'>
						<li class='menu-item'><a href='/wp-admin'>Customer Login</a></li>
						<li class='menu-item'><a href='make-an-appointment/'>Schedule Today</a></li>
					</ul>
				</nav><!-- #top-navigation -->
				<button class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></button>
				<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav><!-- #site-navigation -->
			<?php 
				if (!is_front_page()){
					 wp_nav_menu( array( 'theme_location' => 'auto-brands-menu' ) ); 
				} 
			?>
			<?php if ( get_header_image() ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
			<?php endif; ?>
		</div>
		<div class='sticky-holder sticky-holder-two'>
		<hgroup class='hgroup'>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
	</div>

	</header><!-- #masthead -->
	<div id="backgroundimage"></div>
	<div id="nextimg"></div>
	<?php 
		if (is_front_page()){
			?><section id='auto-brands' class='auto-brands'>
			<?php
			 wp_nav_menu( array( 'theme_location' => 'auto-brands-menu' ) ); 
			?></section>
			<?php
		} 
	?>
	<?php /*<section id='auto-brands' class='auto-brands'>
		<nav class='brands-serviced-nav'>
			<ul class='brands-serviced-menu'>
				<!-- make function to return random set of 6
					input: li one, li two, date in seconds
					check if date is even or odd (changes every second), if even return a if odd return b
				 -->
				<li class='brands-serviced-brand brands-serviced-brand-astonmartin'><a href='/'><img src='/wp-content/uploads/2014/09/Aston-Martin-fullcrop.png' /></a></li>
				<li class='brands-serviced-brand brands-serviced-brand-bmw'><a href='/'><img src='/wp-content/uploads/2014/09/Bmw-fullcrop.png' /></a></li>
				<li class='brands-serviced-brand brands-serviced-brand-mercedes'><a href='/fix-my-mercedes-benz-automobile-services-tacoma-seattle-washington/'><img src='/wp-content/uploads/2014/09/mercedes-benz-fullcrop.png' /></a></li>
				<li class='brands-serviced-brand brands-serviced-brand-ferrari'><a href='/'><img src='/wp-content/uploads/2014/09/Ferrari-totalcrop.png' /></a></li>
				<li class='brands-serviced-brand brands-serviced-brand-alfaromeo'><a href='/'><img src='/wp-content/uploads/2014/09/Alfa-Romeo-totalcrop.png' /></a></li>
				<li class='brands-serviced-brand brands-serviced-brand-astonmartin'><a href='/'><img src='/wp-content/uploads/2014/09/Porsche_wordmark.png' /></a></li>
				<!-- volkswagon -->
				<!-- land rover -->
				<!-- peugeot -->
				<!-- jaguar -->
				<!-- tesla -->
				<!-- fiat -->
				
			</ul>
		</nav>
	</section> */?>
	<div id="main" class="main">
		<div id="main-inner" class="main-inner wrapper">
