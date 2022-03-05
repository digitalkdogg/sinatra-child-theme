<?php
/**
 * Template Name: Millwood Home Page
 *
 * 100% wide page template without vertical spacing with spot for hero.
 *
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content/homepage', 'page' );
	endwhile;
endif;
get_footer();