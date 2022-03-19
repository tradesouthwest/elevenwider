<?php
/**
 * ElevenWider functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * @package WordPress
 * @package ClassicPress
 * @subpackage ElevenWider
 * @since ElevenWider 1.0
 */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}


/*
 * Tell WordPress to run _setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'elevenwider_setup' );

/**
	* Set up theme defaults and registers support for various WordPress features.
	* @uses register_nav_menus()       To add support for navigation menus.
	* @since ElevenWider 1.0
	*/
function elevenwider_setup() {
	/**
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
	/**
	* Make Twenty Eleven available for translation.
	* Translations can be added to the /languages/ directory.
	*/
	load_theme_textdomain( 'elevenwider', get_template_directory() . '/languages' );
	
	// Add support to manage the document title.
    add_theme_support( 'title-tag' );

	// rss feederz
    add_theme_support( 'automatic-feed-links' ); 
	
	// remove a parent hook
	remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

	// This theme uses wp_nav_menu() as an additional menu.
	register_nav_menu( 'secondary', __( 'Secondary Menu - above header', 'elevenwider' ) );

	//Register Customizer assets
	include_once (get_stylesheet_directory() . '/inc/customize.php' );

	do_action('elevenwider_use_googlfont');
}

/**
 * Enqueue scripts and styles for front end.
 *
 * @since ElevenWider 1.0
 */
function elevenwider_scripts_styles() {
	// Theme stylesheet.
	$parent_style = 'twentyeleven';  

	//Enqueue parent and child theme style.css 
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' ); 
	wp_enqueue_style( 'elevenwider-style', get_stylesheet_uri(),
        			array( $parent_style ), '20220404' 
					);
}
add_action( 'wp_enqueue_scripts', 'elevenwider_scripts_styles' );

/**
 * Set the post excerpt length to 70 words.
 *
 *
 * @since ElevenWider 1.0
 *
 * @param int $length The number of excerpt characters.
 * @return int The filtered number of characters.
 */
function elevenwider_excerpt_length( $length ) {

	$leg    = elevenwider_theme_option_excerpt_length();
	if ( $leg > 0 ) { 
		$length = absint($leg);
	} 
	elseif ( empty( $leg ) ) {
		$length = "";
	} 
	else {
		$length = 70; 
	}

		return $length;
}
add_filter( 'excerpt_length', 'elevenwider_excerpt_length' );

// Show home page if no secondary menu set 
function elevenwider_fallback_topmenu(){

	return wp_page_menu('show_home=1&include=99999');

} 


/**
 * Get the excerpt length option from theme_mod.
 *
 * @since ElevenWider 1.0
 *
 * @param int $option The theme_mod from customizer.
 * @return HTML 
 */
function elevenwider_theme_option_excerpt_length(){

	$tmod = get_theme_mod( 'elevenwider_theme_options_excerpt_length' );
	
	$leng = ( '' != $tmod ) ? $tmod : 70;

		return $leng;
}

/**
 * Get the google font option from theme_mod.
 *
 * @since ElevenWider 1.0.11
 *
 * @param $option The theme_mod from customizer.
 * @return Boolean 
 */
function elevenwider_theme_option_use_googlfont(){

	$tmod = get_theme_mod( 'elevenwider_theme_options_googlefont' );
	
	if ( $tmod == true ){ 
		add_action( 'wp_enqueue_scripts', 'elevenwider_fonts' ); 
		add_action( 'init', 'elevenwider_mce_google_fonts_styles' );
	} else {
		remove_action( 'wp_enqueue_scripts', 'elevenwider_fonts' ); 
		remove_action( 'init', 'elevenwider_mce_google_fonts_styles' );
		//wp_dequeue_style( 'elevenwider-fonts' );
	}
		return false;
}
add_action('elevenwider_use_googlfont','elevenwider_theme_option_use_googlfont');

/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
*/
// Add Google Scripts for use with the editor
if ( ! function_exists( 'elevenwider_mce_google_fonts_styles' ) ) {
	function elevenwider_mce_google_fonts_styles() {
	   $font_url = 'https://fonts.googleapis.com/css?family=Raleway';
           add_editor_style( str_replace( ',', '%2C', esc_url( $font_url ) ) );
	}
}

/**
 * Loads custom font CSS file.
 *
 * To disable in a child theme, use wp_dequeue_style()
 * function elevenwider_dequeue_fonts() {
 *     wp_dequeue_style( 'elevenwider-fonts' );
 * }
 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
 *
 * @return void
 */
function elevenwider_fonts() {
	$fonts_url = elevenwider_fonts_url();
	if ( ! empty( $fonts_url ) ) {
        wp_enqueue_style( 'elevenwider-fonts', esc_url_raw( $fonts_url ), array(), null );
	}
}

/*
 * Translators: If there are characters in your language that are not
 * supported by Raleway, translate this to 'off'. Do not translate
 * into your own language.
 */
function elevenwider_fonts_url() {
    $fonts_url = '';

    $Raleway = _x( 'on', 'Raleway font: on or off', 'appeal' );
	if ( 'off' !== $Raleway  ) {
		$font_families = array();
		if ( 'off' !== $Raleway ) {
			$font_families[] = rawurlencode( 'Raleway' );
		}
		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}
	return esc_url( $fonts_url );
}

/**
 * Set the footer replacement script from theme_mod.
 *
 *
 * @since ElevenWider 1.0
 *
 * @param int $option The theme_mod from customizer.
 * @return HTML 
 */
add_action( 'elevenwider_footer_copyright', 'elevenwider_replace_footer_copyright' );
function elevenwider_replace_footer_copyright(){

	$html = '';

	if ( ''!= get_theme_mod( 'elevenwider_theme_options_footer_copyright' ) ) :

	$html .= '<p class="elevenwider-copyright">' . esc_html( 
			get_theme_mod( 'elevenwider_theme_options_footer_copyright' ) ) . '</p>';

	else: 
	$html .= '<p><a href="' . esc_url( 'https://tradesouthwest.com/' ) . '" 
			class="imprint" title="' . esc_attr__( 'tradesouthwest website delevopment', 'elevenwider' ) .'">'
			. esc_html__('Proudly built by TradeSouthWest', 'elevenwider' ) . '</a></p>';
	endif;

	if ( ''!= get_theme_mod( 'elevenwider_theme_options_footer_backtop' ) ) :
		$top = get_theme_mod( 'elevenwider_theme_options_footer_backtop' );
	$html .= '<a href="#page" class="elevenwider-backtop" title="' . esc_attr($top) . '">' 
			. esc_html($top) . '</a>';
		
	else:
	
	$html .= '';
	endif;
		
		echo $html;
}

?>