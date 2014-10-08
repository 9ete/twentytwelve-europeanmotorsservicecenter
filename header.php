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
						<li class='menu-item'><a href='/schedule-automotive-appointment-lakewood-tacoma-seattle-washington/'>Schedule Today</a></li>
					</ul>
				</nav><!-- #top-navigation -->
				<button class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></button>
				<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
				<?php 
					if(!getMainMenu('primary')){
					  $backup = $wp_query;
					  $wp_query = NULL;
					  $wp_query = new WP_Query(array('post_type' => 'post'));
					  getMainMenu('primary');
					  $wp_query = $backup;
					} //else {wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); }
				?>
			</nav><!-- #site-navigation -->
			<?php if(!is_archive()){
					if (!is_front_page()){randMenu('auto-brands-menu', 7);}
				} else {
					if(!getMainMenu('auto-brands-menu')){
					  $backup = $wp_query;
					  $wp_query = NULL;
					  $wp_query = new WP_Query(array('post_type' => 'post'));
					  getMainMenu('auto-brands-menu');
					  $wp_query = $backup;
					} 
					//randMenu('auto-brands-menu', 7);
				}
			?>
			<?php if ( get_header_image() ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
			<?php endif; ?>
		</div>
		<?php if (is_front_page()) : ?>
		<div class='sticky-holder sticky-holder-two'>
			<hgroup class='hgroup'>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
		</div>
		<?php endif;?>

	</header><!-- #masthead -->
	<?php if (is_front_page()) : ?>
		<div id="backgroundimage" class='bkimage-div'></div>
		<div id="nextimg" class='nxt-bkimage-div'></div>
		<div id='bkimg-nav-button-container' class='bkimg-nav-button-container'>
			<div id="bkimg-next" class='bkimg-next bkimg-nav-button'><a class="next" title="Next" href="javascript:void(0);" id="next">Next</a></div>
			<div id="bkimg-prev" class='bkimg-prev bkimg-nav-button'><a class="prev" title="Previous" href="javascript:void(0);" id="prev">Previous</a></div>
		</div>
		<section id='auto-brands' class='auto-brands'>
			<?php randMenu('auto-brands-menu', 7)?>
		</section>
	<?php endif; ?>
	<div id="main" class="main">
		<div id="main-inner" class="main-inner wrapper">
