<?php
/**
 * The default template for displaying content
 *
 * @package Cell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrapper">

		<?php if ( cell_has_post_thumbnail() ) : ?>
		<div class="entry-image-wrapper">
			<?php cell_post_thumbnail(); ?>
		</div><!-- .entry-image-wrapper -->
		<?php endif; ?>

		<div class="entry-content-wrapper">

			<?php if ( 'post' === get_post_type() ) : // For Posts ?>
			<div class="entry-meta entry-meta-header-before">
				<ul>
					<?php
					cell_posted_on( '<li>', '</li>' );
					cell_first_category( '<li>', '</li>' );
					cell_sticky_post( '<li>', '</li>' );
					?>
				</ul>
			</div><!-- .entry-meta -->
			<?php endif; ?>

			<header class="entry-header">
				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%1$s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			</header><!-- .entry-header -->

			<?php if ( cell_has_excerpt() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php endif; ?>

			<div class="more-link-wrapper">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php esc_html_e( 'Continue Reading', 'cell' ); ?></a>
			</div><!-- .more-link-wrapper -->

		</div><!-- .entry-content-wrapper -->

	</div><!-- .entry-wrapper -->

</article><!-- #post-## -->
