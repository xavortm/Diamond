<?php
/**
 * Single page template for Subtle.
 *
 * @package WordPress
 */

get_header(); ?>

<div id="main-content" class='wrapper'>
	<div id="primary" class="site-content" role="main">
	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
				<ul class="pager">
					<li class="previous"><?php previous_post_link(); ?></li>
					<li class="next"><?php next_post_link(); ?></li>
				</ul>
			<?php
		endwhile;
	?>
	</div><!-- /primary -->

	<aside id="secoundary" class='site-sidebar'>
		<?php get_sidebar(); ?>
	</aside>

</div><!-- /main-content -->

<?php 
get_footer();