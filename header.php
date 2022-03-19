<?php
/**
 * Header template for the theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 * 
 * @package WordPress
 * @subpackage ElevenWider
 * @since ElevenWider 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed">
<div id="topbranding">
	<nav id="topaccess">
		<h3 class="assistive-text"><?php _e( 'Secondary menu', 'elevenwider' ); ?></h3>
		<?php
		/*
			* Alternative navigation menu. If one isn't filled out,
			* wp_nav_menu() falls back to wp_login_menu().
			*/
		wp_nav_menu( array( 'theme_location' => 'secondary',
							'fallback_cb' => 'elevenwider_fallback_topmenu', ) );
		?>
	</nav></div>
	<header id="branding">
			<hgroup>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>

			<?php
				// Check to see if the header image has been removed.
				$header_image = get_header_image();
			if ( $header_image ) :
				// Compatibility with versions of WordPress prior to 3.4.
				if ( function_exists( 'get_custom_header' ) ) {
					/*
					 * We need to figure out what the minimum width should be for our featured image.
					 * This result would be the suggested width if the theme were to implement flexible widths.
					 */
					$header_image_width = get_theme_support( 'custom-header', 'width' );
				} else {
					$header_image_width = HEADER_IMAGE_WIDTH;
				}
				?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				/*
				 * The header image.
				 * Check if this is a post or page, if it has a thumbnail, and if it's a big one
				 */
				$image = false;
				if ( is_singular() && has_post_thumbnail( $post->ID ) ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) );
				}
				if ( $image && $image[1] >= $header_image_width ) {
					// Houston, we have a new header image!
					echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
				} else {
					// Compatibility with versions of WordPress prior to 3.4.
					if ( function_exists( 'get_custom_header' ) ) {
						$header_image_width  = get_custom_header()->width;
						$header_image_height = get_custom_header()->height;
					} else {
						$header_image_width  = HEADER_IMAGE_WIDTH;
						$header_image_height = HEADER_IMAGE_HEIGHT;
					}
					?>
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( $header_image_width ); ?>" height="<?php echo esc_attr( $header_image_height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					<?php
				} // End check for featured image or standard header.
				?>
			</a>
			<?php endif; // End check for removed header image. ?>

			<?php
				// Has the text been hidden?
			if ( 'blank' === get_header_textcolor() ) :
				$header_image_class = '';
				if ( $header_image ) {
					$header_image_class = ' with-image';
				}
				?>
			<div class="only-search<?php echo $header_image_class; ?>">
				<?php get_search_form(); ?>
			</div>
				<?php
				else :
					?>
					<?php get_search_form(); ?>
			<?php endif; ?>

			<nav id="access">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'elevenwider' ); ?></h3>
				<?php
				/*
				 * Our navigation menu. If one isn't filled out, wp_nav_menu() falls back to wp_page_menu().
				 * The menu assigned to the primary location is the one used.
				 * If one isn't assigned, the menu with the lowest ID is used.
				 */
				wp_nav_menu( array( 'theme_location' => 'primary' ) );
				?>
			</nav><!-- #access -->
	</header><!-- #branding -->


	<div id="main">
