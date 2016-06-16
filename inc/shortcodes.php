<?php
/**
 * Add shortcodes.
 *
 * @package TestAccordion
 * @since   1.0.0
 */
 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display 'participant' post type in alphabetical order.
 * 
 * @since  1.0.0
 * @param  array $atts The attributes to pass to the shortcode
 * @param  string $content The content of the shortcode
 * @return string $participants_list The data to return for the shortcode
 */
function test_accordion_participants_shortcode( $atts, $content = null ) {
	
	$atts = shortcode_atts( array(
		'category' => null,
	), $atts );
	
	// Set participants list.
	$participants_list = '';
	
	// Set args for getting participants list.
	$participants_args = array(
		'numberposts'   => 500,
		'orderby'       => 'title',
		'order'         => 'ASC',
		'post_type'     => 'participant',
		'post_status'   => 'publish',
		'no_found_rows' => true // Skip SQL_CALC_FOUND_ROWS for performance (no pagination).
    );
	
	// Start WP Query.
	$participants = new WP_Query( $participants_args );
	
	if ( $participants->have_posts() ) :
	
		$participants_list .= '<ul class="accordion" data-accordion data-allow-all-closed="true">';
	
		while ( $participants->have_posts() ) : $participants->the_post();
		
			$participants_list .= '<li class="accordion-item" data-accordion-item>';
				$participants_list .= '<a href="#" class="accordion-title">' . esc_html( get_the_title() ) . '</a>';
				$participants_list .= '<div class="accordion-content" data-tab-content>' . wp_kses_post( wpautop( get_the_content() ) ) . '</div>';
			$participants_list .= '</li>';
		
		endwhile;
		
		$participants_list .= '</ul>';
	
	endif;
	
	// Reset post data.
	wp_reset_postdata();
	
	// Return participant list.
	return $participants_list;
}
add_shortcode( 'participants', 'test_accordion_participants_shortcode' );