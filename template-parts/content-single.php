<?php
/**
 * Template part for displaying single posts.
 *
 * @package Cell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-header-wrapper">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title entry-title-single">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-meta entry-meta-header-after">
			<ul>
				<?php
				cell_posted_by( '<li>', '</li>' );
				cell_posted_on( '<li>', '</li>' );
				?>
			</ul>
		</div><!-- .entry-meta -->
	</div><!-- .entry-header-wrapper -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cell' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta entry-meta-footer">
		<?php cell_entry_footer(); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-## -->
