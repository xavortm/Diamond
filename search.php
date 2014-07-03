<?php
/**
 * Search template. The only diference is, that
 * at the top of the page is shown the search query.
 *
 * @package WordPress
 */

get_header(); ?>

<div id="main-content" class='wrapper'>
	<div id="primary" class="site-content" role="main">

	<h1 class='page-title'><?php echo get_search_query() ?></h1>
	<?php if( have_posts() ) : ?>	

	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile; ?>
		<div class="navigation"><p><?php posts_nav_link(); ?></p></div>
		<?php
		else: 
			get_template_part( 'content', 'none' );
		endif;
	?>
	</div><!-- /primary -->

	<aside id="secoundary" class='site-sidebar'>
		<?php get_sidebar(); ?>
	</aside>

</div><!-- /main-content -->

<?php 
get_footer();

