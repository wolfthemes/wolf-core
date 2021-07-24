<?php
/**
 * Testimonial Slider
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Element Parameters
 *
 * @return array
 */
function wolf_core_testimonial_slider_params() {

	return apply_filters(
		'wolf_core_testimonial_slider_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Testimonial Slider', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_testimonial_slider',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'testimonial-slider',
				'icon'             => 'eicon-testimonial-carousel',
				'register_scripts' => array(
					'flickity'            => array(
						'src'     => WOLF_CORE_JS . '/lib/flickity.pkgd.min.js',
						'version' => '2.2.1',
					),
					'wolf-core-carousels' => array(
						'src'     => WOLF_CORE_JS . '/carousels.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'flickity', 'wolf-core-carousels' ),
			),
			'params'     => array(
				array(
					'type'       => 'colorpicker',
					'param_name' => 'arrows_color',
					'label'      => esc_html__( 'Arrows Color', 'wolf-core' ),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
					'selectors'  => array(
						'{{WRAPPER}} .flickity-prev-next-button svg' => 'fill: {{VALUE}};',
					),
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'dots_color',
					'label'      => esc_html__( 'Dots Color', 'wolf-core' ),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
					'selectors'  => array(
						'{{WRAPPER}} .flickity-page-dots .dot:after' => 'background:{{VALUE}};border-color:{{VALUE}};',
					),
				),
				array(
					'type'       => 'repeater',
					'param_name' => 'testimonials',
					'label'      => esc_html__( 'Testimonials', 'wolf-core' ),
					'params'     => array(
						array(
							'type'       => 'textarea',
							'label'      => esc_html__( 'Text', 'wolf-core' ),
							'param_name' => 'text',
						),

						array(
							'label'      => esc_html__( 'Tagline', 'wolf-core' ),
							'param_name' => 'tagline',
						),

						array(
							'type'       => 'text',
							'label'      => esc_html__( 'Author Name', 'wolf-core' ),
							'param_name' => 'cite',
						),
						array(
							'type'       => 'image',
							'label'      => esc_html__( 'Avatar', 'wolf-core' ),
							'param_name' => 'avatar',
						),

						// array(
						// 'type'        => 'image',
						// 'label'       => esc_html__( 'Rating', 'wolf-core' ),
						// 'param_name'  => 'rating',
						// ),
					),
				),
			),
		)
	);
}
