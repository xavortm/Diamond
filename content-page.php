<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 * Most of the often used functions from WordPress are removed 
 * just to keep the file simpler. 
 *
 * @package WordPress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'diamond' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
	<?php edit_post_link( __( 'Edit', 'diamond' ), '<span class="edit-link">', '</span>' ); ?>
</article><!-- #post-## -->
