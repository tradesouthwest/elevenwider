<?php
/**
 * ElevenWider Theme Options
 *
 * @package WordPress and ClassicPress
 * @subpackage ElevenWider
 * @since ElevenWider 1.0
 */

/**
 * Implements Elevenwider theme options into Customizer
 *
 * @since Elevenwider 1.0
 * @see https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function elevenwider_customizer_register( $wp_customize ) {
	global $wp_customize;

	$wp_customize->add_section('elevenwider_custom_section', array(
            'title'             => __( 'ElevenWider Theme Controls', 'elevenwider' ),
            'priority'          => 45
        ));
	//$options  = get_theme_mod();
	$wp_customize->add_setting(
		// $id
		'elevenwider_theme_options_footer_copyright',
		// $arguments
		array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	$wp_customize->add_setting(
		// $id
		'elevenwider_theme_options_footer_backtop',
		// $arguments
		array(
			'type'              => 'theme_mod',
			'default'           => 'Top',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	$wp_customize->add_setting(
		'elevenwider_theme_options_excerpt_length',
		array(
			'type'              => 'theme_mod',
			'default'           => '70',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	$wp_customize->add_setting(
		'elevenwider_theme_options_googlefont',
		array(
			'type'              => 'theme_mod',
			'default'           => 'Raleway',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	$wp_customize->add_setting(
		'elevenwider_theme_options_sidebarin_single',
		array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);

	// Controls for settings
	$wp_customize->add_control(
		'elevenwider_footer_copyright',
		array(
			'label'   => __( 'Copyright Info in Footer', 'elevenwider' ),
			'section'  => 'elevenwider_custom_section',
			'settings'  => 'elevenwider_theme_options_footer_copyright',
			'type'       => 'text',
			'description' => __( 'Wording for footer copyright space. Replaces Proudly By text.', 'elevenwider' ),
		)
	);

	$wp_customize->add_control(
		'elevenwider_footer_backtop',
		array(
			'label'   => __( 'Back to Top in Footer', 'elevenwider' ),
			'section'  => 'elevenwider_custom_section',
			'settings'  => 'elevenwider_theme_options_footer_backtop',
			'type'       => 'text',
			'description' => __( 'Wording for Back to Top. Leave blank to not have button in footer.', 'elevenwider' ),
		)
	);

	$wp_customize->add_control(
		'elevenwider_excerpt_length',
		array(
			'label'   => __( 'Excerpts in Blog', 'elevenwider' ),
			'section'  => 'elevenwider_custom_section',
			'settings'  => 'elevenwider_theme_options_excerpt_length',
			'type'       => 'number',
			'description' => __( 'Set number of words to display for post excerpts in blog.', 'elevenwider' ),
		)
	);

	$wp_customize->add_control( 'elevenwider_theme_googlefont', array(
                'label'   => 'Use Google Raleway Font',
                'type'     => 'checkbox', // this indicates the type of control
                'section'   => 'elevenwider_custom_section',
                'settings'   => 'elevenwider_theme_options_googlefont',
				'description' => __( 'Check box to change fonts on website to Raleway font.', 'elevenwider'),
    	)
	);

	$wp_customize->add_control( 'elevenwider_sidebarin_single', array(
                'label'   => 'Add Footer to Single Posts',
                'type'     => 'checkbox', // this indicates the type of control
                'section'   => 'elevenwider_custom_section',
                'settings'   => 'elevenwider_theme_options_sidebarin_single',
				'description' => __( 'Check box to have a sidebar on the bottom of your single post page.', 'elevenwider'),
    	)
	);

}
add_action( 'customize_register', 'elevenwider_customizer_register' );
