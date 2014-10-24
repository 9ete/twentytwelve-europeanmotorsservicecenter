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
<?php

function return_post_by_tag($post_type, $tag) {
	wp_reset_query();
	$query_images_args = array(
	    'tag' => $tag,
	    'post_type' => $post_type, 
	    'post_mime_type' =>'image', 
	    'post_status' => 'inherit',
	    'posts_per_page' => -1,
	    'suppress_filters'=>true,
	);

	$query_images = new WP_Query( $query_images_args );
	$images = array();
	foreach ( $query_images->posts as $image) {
	    $images[]= wp_get_attachment_url( $image->ID );
	    ?>
	    <a href='<?php echo wp_get_attachment_url( $image->ID ); ?>'>
	    	<img src='<?php echo wp_get_attachment_url( $image->ID ); ?>' />
	    </a>
	    <?php
	}

	//var_dump($images);
}

//return_post_by_tag('attachment', 'bmw')

?>
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
		</div><!--  -->
		<div class="footer-column footer-column-four">
			<?php dynamic_sidebar( 'footer_column_four' ); ?>
		</div><!--  -->
	</div><!--  -->
</footer><!-- #colophon -->

<?php wp_footer(); 

/*

<?php do_action( 'twentytwelve_credits' ); ?>
		<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>

*/
?>
</body>
</html>