<?php
/**
 * Template Name: No Banner Page
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage ElevenWider
 */

get_header('nobanner'); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // End of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
