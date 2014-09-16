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
		<div class='sticky-back'>
		</div>
		<div class='sticky-holder sticky-holder-one'>
			

			<nav id="site-navigation" class="main-navigation wrapper" role="navigation">
				<nav id="top-navigation" class="top-navigation wrapper" role="navigation">
					<ul id='social-menu' class='social-menu menu'>
						<li class='menu-item'><a href='http://facebook.com'>FB</a></li>
						<li class='menu-item'><a href='http://twitter.com'>TW</a></li>
						<li class='menu-item'><a href='http://pintrist.com'>Pi</a></li>
						<li class='menu-item'><a href='http://instagram.com'>In</a></li>
					</ul>
					<ul id='customer-menu' class='customer-menu'>
						<li class='menu-item'><a href='/wp-admin'>Customer Login</a></li>
						<li class='menu-item'><a href='/contact'>Schedule Today</a></li>
					</ul>
				</nav><!-- #top-navigation -->
				<button class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></button>
				<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav><!-- #site-navigation -->
			
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
	<section id='auto-brands' class='auto-brands'>

	</section>
	<div id="main" class="main wrapper">