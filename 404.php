<?php
/**
 * 404 template - used when the page the user is
 * trying to open does not exist. This template
 * rewrite the default server or browser error.
 *
 * @package WordPress
 */

get_header(); ?>

<div id="main-content" class='wrapper'>

	<div id="primary" class="site-content" role="main">
		<h1><?php _e( "Error 404", 'diamond' ); ?></h1>
		<p><?php _e( "The page you are trying to access does not exists.", 'diamond' ); ?></p>
		<hr>
		<h5><?php _e( "Recent posts:", 'diamond' ); ?></h5>
		<?php Diamond_Print::posts( 0, 10, 0, true, false ); // $category_ID = 0 , $limit = 3, $offset = 1, $print_ul = true, $show_comments = true ?>
	</div><!-- /primary -->

	<aside id="secoundary" class='site-sidebar'>
		<?php get_sidebar(); ?>
	</aside>

</div> <!-- /main-content -->

<?php 
get_footer();