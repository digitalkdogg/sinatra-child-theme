<?php
/**
 * Millwood homepage quick-info strip: service times, location, plan a visit.
 *
 * @package Sinatra
 */

$all_settings = get_theme_mods();

$service_times = ! empty( $all_settings['millwood_service_times_text'] ) ? $all_settings['millwood_service_times_text'] : 'Sundays at 10:00 AM';
$location_text  = ! empty( $all_settings['millwood_location_text'] ) ? $all_settings['millwood_location_text'] : 'Springdale, Arkansas';
$location_link  = ! empty( $all_settings['millwood_location_link'] ) ? $all_settings['millwood_location_link'] : '#';
$visit_text     = ! empty( $all_settings['millwood_planvisit_text'] ) ? $all_settings['millwood_planvisit_text'] : 'First time? We\'d love to meet you.';
$visit_link     = ! empty( $all_settings['millwood_planvisit_link'] ) ? $all_settings['millwood_planvisit_link'] : '#plan-your-visit';
?>
<div id="plan-your-visit" class="force-full-width millwood-quick-info">
	<div class="quick-info-inner">
		<div class="quick-info-card">
			<span class="dashicons dashicons-clock"></span>
			<h3>When We Gather</h3>
			<p><?php echo esc_html( $service_times ); ?></p>
		</div>
		<div class="quick-info-card">
			<span class="dashicons dashicons-location"></span>
			<h3>Where We Are</h3>
			<p><a href="<?php echo esc_url( $location_link ); ?>"><?php echo esc_html( $location_text ); ?></a></p>
		</div>
		<div class="quick-info-card">
			<span class="dashicons dashicons-heart"></span>
			<h3>New Here?</h3>
			<p><a href="<?php echo esc_url( $visit_link ); ?>"><?php echo esc_html( $visit_text ); ?></a></p>
		</div>
	</div>
</div>
