<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?><?php sinatra_schema_markup( 'html' ); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="description" content="<?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'sinatra_before_page_wrapper' ); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sinatra' ); ?></a>

	<?php do_action( 'sinatra_before_masthead' ); ?>

	<header id="masthead" class="site-header" role="banner"<?php sinatra_masthead_atts(); ?><?php sinatra_schema_markup( 'header' ); ?>>
		<?php do_action( 'sinatra_header' ); ?>
		<?php do_action( 'sinatra_page_header' ); ?>
	</header><!-- #masthead .site-header -->

	<?php do_action( 'sinatra_after_masthead' ); ?>

	<?php do_action( 'sinatra_before_main' ); ?>
	<div id="main" class="site-main">

		<?php do_action( 'sinatra_main_start' ); ?>
