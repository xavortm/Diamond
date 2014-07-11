<?php

/**
 * Get and proccess content that is related to the blog posts like
 * number of words, remaining to read and such sort of functions
 * and print it or return a value. In this class are also functions
 * related to the comments area.
 *
 * Used with Dimaond_Entry::HelpMethod()
 *
 * @package WordPress
 * @subpackage Dimaond
 */


class Diamond_Entry {

	/**
	 * Print the count of words the article has.
	 * 
	 * @since v1.0.0
	 */ 
	public static word_count() {
		global $post;
		echo str_word_count( $post->post_content );
	}

	/**
	 * Return the count of words the article has.
	 * 
	 * @since v1.0.0
	 * @return int The number of words in article
	 */ 
	public static get_word_count() {
		global $post;
		return str_word_count( $post->post_content );
	}

	/**
	 * Print the author link.
	 *
	 * Because of the weird actions from the build in to the core function the_author(  ) i decided
	 * to write my own function. This will print on the screen ( by the right way ) who is the author
	 * and a link to the posts by the given author. No parameters are needed.
	 *
	 * @uses get_the_author_meta()
	 * @uses get_the_author()
	 * @uses get_author_posts_url()
	 * @since 1.0.0
	 * @return Displays the post author link and name.
	 */
	public static function author_link(){ 
		$link = get_author_posts_url( get_the_author_meta( 'ID' ) );
		echo '<a href="'. $link .'">'. get_the_author() .'</a>';
	}

	/**
	 * Print the comments title for single pages. Its separated on another method for better read
	 * insidte the comments template. ( + if its used elsewhere )
	 *
	 * @since  v1.0.0
	 */
	public static function comments_title() {
		printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'thebigmag' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
	}

	/**
	 * Post thumbnail calling. Shorted here, because we make many checks for wich page its called from. 
	 * its used to not use very big images when they are no needed, and by this speeds up the procces of
	 * opening a page.
	 * 
	 * @param string 	$size 		The size of the thumbnail
	 * @param bool 		$nodefault 	Use or not default image when no thumnnail is set.
	 * @since v1.0.0
	 */
	public static function post_thumbnail( $size = '', $nodefault = true ) {

		if( has_post_thumbnail() ) {

			if( isset( $size ) ) {
				the_post_thumbnail( $size );
				return;
			}

			// Check if the current page need large image.
			if( is_single() OR is_page() ) {
				the_post_thumbnail('medium'); 
			}
			else {
				// Now for the small ones
				the_post_thumbnail( 'medium' );
			}

		} // has_post_thumbnail
		else {

			// Set the default image size
			if( $size == '' ) {
				$size = "medium";
			}

			// Do nothing if no default image will be used.
			if( $nodefault ) {
				return;
			}
			
			// Set the default thumbnail.
			$image_directory = get_template_directory_uri() . '/img/default_' . $size . '.png';

			// Print the default post thumbnail
			echo "<img src='{$image_directory}' />";
		}

	}

}