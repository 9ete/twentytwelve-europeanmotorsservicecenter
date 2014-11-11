<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
		</div><!-- #main-inner .wrapper-inner -->
	</div><!-- #main .wrapper -->
</div><!-- #page -->

<footer id="colophon" role="contentinfo" class='colophon-footer'>
	<div class='wrapper'>
		<div class="site-info footer-column footer-column-one">
			<?php dynamic_sidebar( 'footer_column_one' ); ?>
		</div><!-- .site-info -->
		<div class="footer-column footer-column-two">
			<?php dynamic_sidebar( 'footer_column_two' ); ?>
		</div><!--  -->
		<div class="footer-column footer-column-three">
			<?php dynamic_sidebar( 'footer_column_three' ); ?>
			<ul class='automotive-certifications'>
				<li class='auto-cert-item'><a href='https://www.ase.com/' ><img height='50' width='51' alt='ASE Certified Automotive Shop Tacoma Lakewood Seattle Washington'  src='/wp-content/themes/twentytwelve-europeanmotorsservicecenter/img/automotive-certifications/ase-automotive-service-excellence-certified-european-motors-washington-lakewood-tacoma-fix-my-land-rover.png' /></a></li>
				<li class='auto-cert-item'><a href='http://www.iatn.net/' ><img height='50' width='100' alt='iATN Certified Automotive Shop Tacoma Lakewood Seattle Washington' src='/wp-content/themes/twentytwelve-europeanmotorsservicecenter/img/automotive-certifications/iatn-international-automotive-technicians-network-certified-european-motors-washington-lakewood-tacoma-fix-my-land-rover.png' /></a></li>
				<li class='auto-cert-item'><a href='http://asashop.org/' ><img height='50' width='125' alt='ASA Certified Automotive Shop Tacoma Lakewood Seattle Washington' src='/wp-content/themes/twentytwelve-europeanmotorsservicecenter/img/automotive-certifications/asa-automotive-service-association-certified-european-motors-washington-lakewood-tacoma-fix-my-land-rover.png' /></a></li>
			</ul>
		</div><!--  -->
		<div class="footer-column footer-column-four">
			<?php dynamic_sidebar( 'footer_column_four' ); ?>
			<p style='text-align:center; color: whitesmoke; text-shadow: 1px 1px 1px black;'><a style='color: whitesmoke; text-shadow: 1px 1px 1px black;' href="https://www.google.com/maps/preview?q=5911+STEILACOOM+BLVD+SW,+LAKEWOOD,+WA,+98499,+(European+Motors+Service+Center)" target="_blank">5911 STEILACOOM BLVD SW - LAKEWOOD, WA - 98499</a><br />&copy;<?php echo date('Y');?> European Motors Service Center<br /><?php echo do_shortcode( '[phonenumber]' ); ?></p>
		</div><!--  -->
	</div><!--  -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>