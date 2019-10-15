<?php
if ( ! function_exists( 'ntn_categorized_blog' ) ) :
/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own twentysixteen_categorized_blog() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function ntn_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ntn_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ntn_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so twentysixteen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so twentysixteen_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in twentysixteen_categorized_blog().
 *
 * @since Twenty Sixteen 1.0
 */
function ntn_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ntn_categories' );
}
add_action( 'edit_category', 'ntn_category_transient_flusher' );
add_action( 'save_post',     'ntn_category_transient_flusher' );

if ( ! function_exists( 'ntn_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Twenty Sixteen 1.2
 */
function ntn_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;