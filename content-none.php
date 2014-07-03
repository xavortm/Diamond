<div id="post-<?php the_ID(); ?>" <?php post_class( "entry" ); ?>>
	<p><?php _e( "Sorry, but no results were found." , "diamond" ); ?></p>

	<?php if( is_search() ) : ?>
	<form method="get" id="searchform" class='form-inline' action="<?php echo home_url() ?>/">
		<div class='form-group'>
			<input class='form-control' type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
		</div>
		<input class='btn btn-default' type="submit" id="searchsubmit" value="Search" />
	</form><!-- /searchform -->
	<?php endif; ?>

</div><!-- /article -->