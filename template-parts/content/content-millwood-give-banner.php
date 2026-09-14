<?php
/**
 * Millwood homepage giving call-to-action banner.
 *
 * @package Sinatra
 */

$all_settings = get_theme_mods();

$give_heading = ! empty( $all_settings['millwood_give_banner_heading'] ) ? $all_settings['millwood_give_banner_heading'] : 'Generosity Changes Lives';
$give_text    = ! empty( $all_settings['millwood_give_banner_text'] ) ? $all_settings['millwood_give_banner_text'] : 'Your giving helps our church love our neighbors and reach our community.';
$give_cta     = ! empty( $all_settings['millwood_give_banner_cta'] ) ? $all_settings['millwood_give_banner_cta'] : 'Give Online';
$give_link    = ! empty( $all_settings['millwood_give_banner_link'] ) ? $all_settings['millwood_give_banner_link'] : home_url( '/donate' );
?>
<div class="force-full-width millwood-give-banner">
	<div class="give-banner-inner">
		<div class="give-banner-copy">
			<h2><?php echo esc_html( $give_heading ); ?></h2>
			<p><?php echo esc_html( $give_text ); ?></p>
		</div>
		<a class="hero-btn hero-btn-primary" href="<?php echo esc_url( $give_link ); ?>"><?php echo esc_html( $give_cta ); ?></a>
	</div>
</div>
