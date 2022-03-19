<?php
/**
 * Header template for the theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 * @package WordPress
 * @package ClassicPress
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
