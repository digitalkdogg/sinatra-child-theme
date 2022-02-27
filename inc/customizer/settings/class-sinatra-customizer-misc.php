<?php
/**
 * Sinatra Misc section in Customizer.
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

if ( ! class_exists( 'Sinatra_Customizer_Misc' ) ) :
	/**
	 * Sinatra Misc section in Customizer.
	 */
	class Sinatra_Customizer_Misc {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Registers our custom options in Customizer.
			 */
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
			$options['section']['sinatra_section_misc'] = array(
				'title'    => esc_html__( 'Misc Settings', 'sinatra' ),
				'panel'    => 'sinatra_panel_general',
				'priority' => 60,
			);

			// Excerpt more.
			$options['setting']['sitename'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'section'     => 'sinatra_section_misc',
					'label'       => esc_html__( 'site', 'sinatra' ),
					'description' => esc_html__( 'Site Name', 'sinatra' ),
				),
			);

			// Schema toggle.
			$options['setting']['stripe_use_test_data'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'        => 'sinatra-toggle',
					'label'       => esc_html__( 'Stripe Use Test Data', 'sinatra' ),
					'description' => esc_html__( 'Use the stripe data options.', 'sinatra' ),
					'section'     => 'sinatra_section_misc',
				),
			);

			// Excerpt more.
			$options['setting']['stripe_test_key'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'section'     => 'sinatra_section_misc',
					'label'       => esc_html__( 'Stripe Test Key', 'sinatra' ),
					'description' => esc_html__( 'Test key for the stripe api', 'sinatra' ),
				),
			);

			$options['setting']['stripe_test_secret'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'section'     => 'sinatra_section_misc',
					'label'       => esc_html__( 'Stripe Test Secret', 'sinatra' ),
					'description' => esc_html__( 'Test secret for the stripe api', 'sinatra' ),
				),
			);

			// Excerpt more.
			$options['setting']['stripe_live_key'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'section'     => 'sinatra_section_misc',
					'label'       => esc_html__( 'Stripe Live Key', 'sinatra' ),
					'description' => esc_html__( 'Live key for the stripe api', 'sinatra' ),
				),
			);

			$options['setting']['stripe_live_secret'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'section'     => 'sinatra_section_misc',
					'label'       => esc_html__( 'Stripe Live Secret', 'sinatra' ),
					'description' => esc_html__( 'Live secret for the stripe api', 'sinatra' ),
				),
			);

			$options['setting']['stripe_base_path'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'section'     => 'sinatra_section_misc',
					'label'       => esc_html__( 'Stripe Base Path', 'sinatra' ),
					'description' => esc_html__( 'Select the path so that it picks up the stripe helper library', 'sinatra' ),
				),
			);

			// Schema toggle.
			$options['setting']['sinatra_enable_schema'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'        => 'sinatra-toggle',
					'label'       => esc_html__( 'Schema Markup', 'sinatra' ),
					'description' => esc_html__( 'Add structured data to your content.', 'sinatra' ),
					'section'     => 'sinatra_section_misc',
				),
			);

			// Custom form styles.
			$options['setting']['sinatra_custom_input_style'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'        => 'sinatra-toggle',
					'label'       => esc_html__( 'Custom Form Styles', 'sinatra' ),
					'description' => esc_html__( 'Custom design for checkboxes and radio buttons.', 'sinatra' ),
					'section'     => 'sinatra_section_misc',
				),
			);

			// Page Preloader heading.
			$options['setting']['sinatra_preloader_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-heading',
					'label'   => esc_html__( 'Page Preloader', 'sinatra' ),
					'section' => 'sinatra_section_misc',
				),
			);

			// Enable/Disable Page Preloader.
			$options['setting']['sinatra_preloader'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'        => 'sinatra-toggle',
					'label'       => esc_html__( 'Enable Page Preloader', 'sinatra' ),
					'description' => esc_html__( 'Show animation until page is fully loaded.', 'sinatra' ),
					'section'     => 'sinatra_section_misc',
					'required'    => array(
						array(
							'control'  => 'sinatra_preloader_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Preloader visibility.
			$options['setting']['sinatra_preloader_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_select',
				'control'           => array(
					'type'        => 'sinatra-select',
					'label'       => esc_html__( 'Device Visibility', 'sinatra' ),
					'description' => esc_html__( 'Devices where Page Preloader is displayed.', 'sinatra' ),
					'section'     => 'sinatra_section_misc',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'sinatra' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'sinatra' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'sinatra' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'sinatra' ),
					),
					'required'    => array(
						array(
							'control'  => 'sinatra_preloader_heading',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_preloader',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Scroll Top heading.
			$options['setting']['sinatra_scroll_top_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-heading',
					'label'   => esc_html__( 'Scroll Top Button', 'sinatra' ),
					'section' => 'sinatra_section_misc',
				),
			);

			// Enable/Disable Scroll Top.
			$options['setting']['sinatra_enable_scroll_top'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'        => 'sinatra-toggle',
					'label'       => esc_html__( 'Enable Scroll Top Button', 'sinatra' ),
					'description' => esc_html__( 'A sticky button that allows users to easily return to the top of a page.', 'sinatra' ),
					'section'     => 'sinatra_section_misc',
					'required'    => array(
						array(
							'control'  => 'sinatra_scroll_top_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Scroll Top device visibility.
			$options['setting']['sinatra_scroll_top_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_select',
				'control'           => array(
					'type'        => 'sinatra-select',
					'label'       => esc_html__( 'Device Visibility', 'sinatra' ),
					'description' => esc_html__( 'Devices where the button is displayed.', 'sinatra' ),
					'section'     => 'sinatra_section_misc',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'sinatra' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'sinatra' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'sinatra' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'sinatra' ),
					),
					'required'    => array(
						array(
							'control'  => 'sinatra_enable_scroll_top',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_scroll_top_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Sinatra_Customizer_Misc();
