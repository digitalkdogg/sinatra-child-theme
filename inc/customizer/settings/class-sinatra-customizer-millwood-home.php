<?php
/**
 * Millwood Homepage Sections Settings in Customizer.
 *
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Sinatra_Customizer_Millwood_Home' ) ) :
	/**
	 * Millwood Homepage Sections Settings in Customizer.
	 */
	class Sinatra_Customizer_Millwood_Home {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_filter( 'sinatra_customizer_options', array( $this, 'register_options' ) );
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_options( $options ) {

			// Section.
			$options['section']['sinatra_section_millwood_home'] = array(
				'title'    => esc_html__( 'Millwood Homepage Sections', 'sinatra' ),
				'priority' => 4,
			);

			// Quick info enable.
			$options['setting']['millwood_enable_quick_info'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-toggle',
					'section' => 'sinatra_section_millwood_home',
					'label'   => esc_html__( 'Enable Quick Info Strip', 'sinatra' ),
				),
			);

			$options['setting']['millwood_service_times_text'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'label'       => esc_html__( 'Service Times Text', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_quick_info',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			$options['setting']['millwood_location_text'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'label'       => esc_html__( 'Location Text', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_quick_info',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			$options['setting']['millwood_location_link'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
				'control'           => array(
					'type'        => 'sinatra-text',
					'label'       => esc_html__( 'Location Link (map URL)', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_quick_info',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			$options['setting']['millwood_planvisit_text'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'label'       => esc_html__( 'Plan A Visit Text', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_quick_info',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			$options['setting']['millwood_planvisit_link'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
				'control'           => array(
					'type'        => 'sinatra-text',
					'label'       => esc_html__( 'Plan A Visit Link', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_quick_info',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			// Give banner enable.
			$options['setting']['millwood_enable_give_banner'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-toggle',
					'section' => 'sinatra_section_millwood_home',
					'label'   => esc_html__( 'Enable Giving Banner', 'sinatra' ),
				),
			);

			$options['setting']['millwood_give_banner_heading'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'label'       => esc_html__( 'Giving Banner Heading', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_give_banner',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			$options['setting']['millwood_give_banner_text'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-textarea',
					'label'       => esc_html__( 'Giving Banner Text', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_give_banner',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			$options['setting']['millwood_give_banner_cta'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'label'       => esc_html__( 'Giving Banner Button Text', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_give_banner',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			$options['setting']['millwood_give_banner_link'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
				'control'           => array(
					'type'        => 'sinatra-text',
					'label'       => esc_html__( 'Giving Banner Button Link', 'sinatra' ),
					'section'     => 'sinatra_section_millwood_home',
					'required'    => array(
						array(
							'control'  => 'millwood_enable_give_banner',
							'value'    => true,
							'operator' => '==',
						),
					)
				),
			);

			return $options;
		}
	}
endif;
new Sinatra_Customizer_Millwood_Home();
