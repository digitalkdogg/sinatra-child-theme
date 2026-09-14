<?php
/**
 * Millwood homepage hero.
 *
 * @package Sinatra
 */

$all_settings = get_theme_mods();

$hero_headline   = ! empty( $all_settings['millwood_hero_msg'] ) ? $all_settings['millwood_hero_msg'] : 'You Belong Here';
$hero_eyebrow    = ! empty( $all_settings['millwood_hero_eyebrow'] ) ? $all_settings['millwood_hero_eyebrow'] : 'Millwood Church';
$hero_subtext    = ! empty( $all_settings['millwood_hero_subtext'] ) ? $all_settings['millwood_hero_subtext'] : 'A community in Northwest Arkansas following Jesus together, every single week.';
$hero_meta       = ! empty( $all_settings['millwood_hero_meta'] ) ? $all_settings['millwood_hero_meta'] : 'Sundays at 10:00 AM';

$cta_primary_text  = ! empty( $all_settings['millwood_hero_cta_primary_text'] ) ? $all_settings['millwood_hero_cta_primary_text'] : 'Plan Your Visit';
$cta_primary_link  = ! empty( $all_settings['millwood_hero_cta_primary_link'] ) ? $all_settings['millwood_hero_cta_primary_link'] : '#plan-your-visit';
$cta_secondary_text = ! empty( $all_settings['millwood_hero_cta_secondary_text'] ) ? $all_settings['millwood_hero_cta_secondary_text'] : 'Watch Online';
$cta_secondary_link = ! empty( $all_settings['millwood_hero_cta_secondary_link'] ) ? $all_settings['millwood_hero_cta_secondary_link'] : '#watch-online';
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" />
<div id="hero" class="force-full-width millwood-hero">
	<div class="inner-hero" style="background-image:url(<?php echo esc_url( get_hero_image() ); ?>);"></div>
	<div class="hero-overlay"></div>
	<div class="hero-content">
		<span class="hero-eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></span>
		<h1><?php echo esc_html( $hero_headline ); ?></h1>
		<p class="hero-subtext"><?php echo esc_html( $hero_subtext ); ?></p>
		<div class="hero-meta">
			<span class="dashicons dashicons-clock"></span>
			<?php echo esc_html( $hero_meta ); ?>
		</div>
		<div class="hero-ctas">
			<a class="hero-btn hero-btn-primary" href="<?php echo esc_url( $cta_primary_link ); ?>"><?php echo esc_html( $cta_primary_text ); ?></a>
			<a class="hero-btn hero-btn-secondary" href="<?php echo esc_url( $cta_secondary_link ); ?>"><?php echo esc_html( $cta_secondary_text ); ?></a>
		</div>
	</div>
</div>
