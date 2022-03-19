<?php
/**
 * Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$tmod = get_theme_mod( 'elevenwider_theme_options_sidebarin_single' );
if ( $tmod == true ){ $cls = 'primary-single'; } else { $cls = 'default-single'; }
get_header(); ?>

		<div id="primary" class="<?php echo esc_attr($cls); ?>">
			<div id="content" class="elevenwider-<?php echo esc_attr($cls); ?>" role="main">

				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<nav id="nav-single">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
						<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
					</nav><!-- #nav-single -->

					<?php get_template_part( 'content-single', get_post_format() ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // End of the loop. ?>

			</div><!-- #content -->
		</div><div class="clearfix"></div>
	    
		<?php if ( $tmod == true ): ?>

		<div id="elevenwider-single-sidebar" class="<?php echo esc_attr($cls); ?>">
		
			<?php get_sidebar(); ?>

		</div><div class="clearfix"></div>
		<?php endif; ?>

<?php get_footer(); ?>
