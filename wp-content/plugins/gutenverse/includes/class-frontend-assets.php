<?php
/**
 * Frontend Assets class
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package gutenverse
 */

namespace Gutenverse;

use WP_Theme_Json_Resolver;

/**
 * Class Frontend Assets
 *
 * @package gutenverse
 */
class Frontend_Assets {
	/**
	 * Init constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ), 99 );
		add_filter( 'gutenverse_global_css', array( $this, 'global_variable_css' ) );
	}

	/**
	 * Global Variable CSS
	 *
	 * @param string $result Global Variable CSS.
	 *
	 * @return string
	 */
	public function global_variable_css( $result = '' ) {

		// RENDER GLOBAL COLORS.

		$global_colors = array();
		$current_theme = wp_get_theme();
		$settings      = WP_Theme_Json_Resolver::get_user_data_from_wp_global_styles( $current_theme );

		if ( ! empty( $settings['post_content'] ) ) {
			$theme_settings = json_decode( $settings['post_content'], true );
			$global_colors  = ! empty( $theme_settings['settings']['color']['palette']['custom'] ) ? $theme_settings['settings']['color']['palette']['custom'] : $global_colors;
		}

		if ( ! empty( $global_colors ) ) {
			$result .= gutenverse_global_color_style_generator( $global_colors );
		}

		// RENDER GLOBAL FONTS.

		$global_fonts = gutenverse_get_global_variable( 'font' );

		if ( ! empty( $global_fonts ) ) {
			$result .= gutenverse_global_font_style_generator( $global_fonts );
		}

		return $result;
	}

	/**
	 * Frontend Script
	 */
	public function frontend_scripts() {
		// Load standalone package for ReactPlayer ref : https://github.com/CookPete/react-player.
		wp_enqueue_script(
			'react-player-dep',
			GUTENVERSE_URL . '/assets/frontend/react-player/ReactPlayer.standalone.js',
			array(),
			GUTENVERSE_VERSION,
			true
		);

		$include = include_once GUTENVERSE_DIR . '/lib/dependencies/frontend.asset.php';

		wp_enqueue_script(
			'gutenverse-frontend-event',
			GUTENVERSE_URL . '/assets/js/frontend.js',
			$include['dependencies'],
			GUTENVERSE_VERSION,
			true
		);

		wp_localize_script( 'gutenverse-frontend-event', 'GutenverseData', $this->gutenverse_data() );

		wp_set_script_translations( 'gutenverse-frontend-event', 'gutenverse', GUTENVERSE_LANG_DIR );

		// Register font awesome.
		wp_enqueue_style(
			'gutenverse-frontend-font-awesome',
			GUTENVERSE_URL . '/assets/fontawesome/css/all.min.css',
			array(),
			GUTENVERSE_VERSION
		);

		wp_register_style(
			'gutenverse-frontend-icon-gutenverse',
			GUTENVERSE_URL . '/assets/gtnicon/gtnicon.css',
			array(),
			GUTENVERSE_VERSION
		);

		wp_enqueue_style(
			'gutenverse-frontend-style',
			GUTENVERSE_URL . '/assets/css/frontend-block.css',
			array( 'gutenverse-frontend-icon-gutenverse' ),
			GUTENVERSE_VERSION
		);

		wp_enqueue_style(
			'gutenverse-frontend-icons',
			GUTENVERSE_URL . '/assets/css/frontend-icon.css',
			array(),
			GUTENVERSE_VERSION
		);

		if ( is_user_logged_in() ) {
			wp_enqueue_style(
				'gutenverse-toolbar',
				GUTENVERSE_URL . '/assets/css/toolbar.css',
				array(),
				GUTENVERSE_VERSION
			);
		}
	}

	/**
	 * Gutenverse Config
	 *
	 * @return array
	 */
	public function gutenverse_data() {
		$config           = array();
		$config['postId'] = get_the_ID();

		return $config;
	}
}
