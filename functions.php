<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'sinatra-styles' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', 'before');
wp_enqueue_script( 'customjs', get_stylesheet_directory_uri() . '/assets/js/base.js' );
wp_enqueue_style( 'millwood-base', get_stylesheet_directory_uri() . '/assets/css/base.css' );

if ( ! defined( 'SINATRA_THEME_PATH' ) ) {
  define( 'SINATRA_THEME_PATH', get_parent_theme_file_path() . '-child');
}

// Customizer.
require_once SINATRA_THEME_PATH . '/inc/customizer/class-sinatra-customizer.php';

$all_settings = get_theme_mods();


// END ENQUEUE PARENT ACTION
