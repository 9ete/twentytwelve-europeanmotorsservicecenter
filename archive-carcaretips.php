<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
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
			<?php echo category_description( $category_id ); ?> 


		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Car Care Tips: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Car Care Tips: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Car Care Tips: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
					else :
						_e( 'Car Care Tips', 'twentytwelve' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			global $query_string;
			query_posts( $query_string . '&posts_per_page=-1' );

			while ( have_posts() ) : the_post(); 

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if (!is_front_page()) : ?>
						<header class="entry-header">
							<?php if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
							<?php the_post_thumbnail(); ?>
							<?php endif; ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'pre-content-widget' ) ) : ?>
						<div id="pre-content-widget-holder" class="pre-content-widget-holder" role="complementary">
							<?php dynamic_sidebar( 'pre-content-widget' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					<?php if ( is_active_sidebar( 'post-content-widget' ) ) : ?>
						<div id="post-content-widget-holder" class="post-content-widget-holder" role="complementary">
							<?php dynamic_sidebar( 'post-content-widget' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->
				<?php
			endwhile;
			wp_reset_query();
			//twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>