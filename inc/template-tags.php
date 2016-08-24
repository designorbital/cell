<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cell
 */

if ( ! function_exists( 'cell_the_posts_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function cell_the_posts_pagination() {

	// Previous/next posts navigation @since 4.1.0
	the_posts_pagination( array(
		'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Previous Page', 'cell' ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next Page', 'cell' ) . '</span>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'cell' ) . ' </span>',
	) );

}
endif;

if ( ! function_exists( 'cell_the_post_pagination' ) ) :
/**
 * Previous/next post navigation.
 *
 * @return void
 */
function cell_the_post_pagination() {

	// Previous/next post navigation @since 4.1.0.
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav">' . esc_html__( 'Next', 'cell' ) . '</span> ' . '<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav">' . esc_html__( 'Prev', 'cell' ) . '</span> ' . '<span class="post-title">%title</span>',
	) );

}
endif;

if ( ! function_exists( 'cell_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function cell_posted_on( $before = '', $after = '' ) {

	// No need to display date for sticky posts
	if ( cell_has_sticky_post() ) {
		return;
	}

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf( '<span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark"> %3$s</a>',
		esc_html_x( 'Posted on', 'post date', 'cell' ),
		esc_url( get_permalink() ),
		$time_string
	);

	$posted_on_string = '<span class="posted-on">' . $posted_on . '</span>';

	echo $before . $posted_on_string . $after; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'cell_posted_by' ) ) :
/**
 * Prints author.
 */
function cell_posted_by( $before = '', $after = '' ) {

	// Author Name Display Control
	if ( ! cell_mod( 'cell_author_name' ) ) {
		return;
	}

	// Global Post
	global $post;

	// We need to get author meta data from both inside/outside the loop.
	$post_author_id = get_post_field( 'post_author', $post->ID );

	// Post Author
	$post_author = sprintf( '<span class="entry-author author vcard"><a class="entry-author-link url fn n" href="%1$s" rel="author"><span class="entry-author-name">%2$s</span></a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ),
		esc_html( get_the_author_meta( 'display_name', $post_author_id ) )
	);

	// Byline
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'cell' ),
		$post_author
	);

	$byline_string = '<span class="byline"> ' . $byline . '</span>';

	echo $before . $byline_string . $after; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'cell_sticky_post' ) ) :
/**
 * Prints HTML label for the sticky post.
 */
function cell_sticky_post( $before = '', $after = '' ) {

	// Sticky Post Validation
	if ( ! cell_has_sticky_post() ) {
		return;
	}

	$sticky_post_string = sprintf( '<span class="post-label post-label-sticky">%1$s</span>',
		esc_html_x( 'Featured', 'sticky post label', 'cell' )
	);

	echo $before . $sticky_post_string . $after; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'cell_first_category' ) ) :
/**
 * Prints first category for the current post.
 *
 * @return void
*/
function cell_first_category( $before = '', $after = '' ) {

	// Show the First Category Name Only
	$category = get_the_category();
	if ( $category[0] ) {
		$category_string = sprintf( '<span class="first-category"><a href="%1$s">%2$s</a></span>', esc_url( get_category_link( $category[0]->term_id ) ), esc_html( $category[0]->cat_name ) );
		echo $before . $category_string . $after; // WPCS: XSS OK.
	}

}
endif;

if ( ! function_exists( 'cell_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function cell_entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'cell' ) );
		if ( $categories_list && cell_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'cell' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'cell' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'cell' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link( sprintf( esc_html__( 'Edit %1$s', 'cell' ), '<span class="screen-reader-text">' . the_title_attribute( 'echo=0' ) . '</span>' ), '<span class="edit-link">', '</span>' );

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cell_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'cell_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array (
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cell_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cell_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cell_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in cell_categorized_blog.
 */
function cell_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'cell_categories' );
}
add_action( 'edit_category', 'cell_category_transient_flusher' );
add_action( 'save_post',     'cell_category_transient_flusher' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @return void
*/
function cell_post_thumbnail() {

	// Post password and Post thumbnail check
	if ( ! cell_has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<figure class="post-thumbnail post-thumbnail-single">
		<?php the_post_thumbnail( 'cell-featured', array( 'class' => 'img-featured img-responsive' ) ); ?>
	</figure><!-- .post-thumbnail -->

	<?php else : ?>

	<figure class="post-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'cell-featured', array( 'class' => 'img-featured img-responsive' ) ); ?>
		</a>
	</figure><!-- .post-thumbnail -->

	<?php endif; // End is_singular()
}

/**
 * A helper conditional function.
 * Whether there is a post thumbnail and post is not password protected.
 *
 * @return bool
 */
function cell_has_post_thumbnail() {

	/**
	 * Post Thumbnail Filter
	 * @return bool
	 */
	return apply_filters( 'cell_has_post_thumbnail', (bool) ( ! post_password_required() && has_post_thumbnail() ) );

}

/**
 * A helper conditional function.
 * Post is Sticky or Not
 *
 * @return bool
 */
function cell_has_sticky_post() {

	/**
	 * Full width Filter
	 * @return bool
	 */
	return apply_filters( 'cell_has_sticky_post', (bool) ( is_sticky() && is_home() && ! is_paged() ) );

}

/**
 * A helper conditional function.
 * Theme has Excerpt or Not
 *
 * @return bool
 */
function cell_has_excerpt() {

	// Post Excerpt
	$post_excerpt = get_the_excerpt();

	/**
	 * Excerpt Filter
	 * @return bool
	 */
	return apply_filters( 'cell_has_excerpt', (bool) ! empty ( $post_excerpt ) );

}

/**
 * A helper conditional function.
 * Theme has Sidebar or Not
 *
 * @return bool
 */
function cell_has_sidebar() {

	/**
	 * Sidebar Filter
	 * @return bool
	 */
	return apply_filters( 'cell_has_sidebar', (bool) is_active_sidebar( 'sidebar-1' ) );

}

/**
 * Display the layout classes.
 *
 * @param string $section - Name of the section to retrieve the classes
 * @return void
 */
function cell_layout_class( $section = 'content' ) {

	// Sidebar Position
	$sidebar_position = cell_mod( 'cell_sidebar_position' );
	if ( ! cell_has_sidebar() ) {
		$sidebar_position = 'no';
	}

	// Layout Skeleton
	$layout_skeleton = array(
		'content' => array(
			'content' => 'col-xl-12',
		),

		'content-sidebar' => array(
			'content' => 'col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8',
			'sidebar' => 'col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4',
		),

		'sidebar-content' => array(
			'content' => 'col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-lg-push-4 col-xl-push-4',
			'sidebar' => 'col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-lg-pull-8 col-xl-pull-8',
		),
	);

	// Layout Classes
	switch( $sidebar_position ) {

		case 'no':
		$layout_classes = $layout_skeleton['content']['content'];
		break;

		case 'left':
		$layout_classes = ( 'sidebar' === $section )? $layout_skeleton['sidebar-content']['sidebar'] : $layout_skeleton['sidebar-content']['content'];
		break;

		case 'right':
		default:
		$layout_classes = ( 'sidebar' === $section )? $layout_skeleton['content-sidebar']['sidebar'] : $layout_skeleton['content-sidebar']['content'];

	}

	echo esc_attr( $layout_classes );

}
