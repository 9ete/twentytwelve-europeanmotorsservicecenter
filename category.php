<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( "At European Motors we fix %s's", 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
		<?php //get_template_part( 'content', 'none' ); ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( "At European Motors we fix %s's", 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
		<?php endif; ?>
			<section id='catpage-tagged-media' class='catpage-tagged-media'>
				<?php
					$tag_var = strtolower(single_cat_title('',false));
					$wp_query = new WP_Query();
					$query_images_args = array(
						'tag' => $tag_var,
						'post_type' => 'attachment', 
						'post_mime_type' =>'image', 
						'post_status' => 'inherit',
						'posts_per_page' => -1,
					);

					$query_images = new WP_Query( $query_images_args );
					$images = array();
					foreach ( $query_images->posts as $image) {
						$images[]= wp_get_attachment_url( $image->ID );
						echo "<div class='catpage-tagged-image-wrap'><img class='catpage-tagged-image' src='".wp_get_attachment_url( $image->ID )."' /></div>";
					}
				?>
			</section>

		</div><!-- #content -->
	</section><!-- #primary -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>