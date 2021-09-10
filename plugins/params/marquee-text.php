<?php
/**
 * Marquee Text
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
function wolf_core_marquee_text_params() {

	return apply_filters(
		'wolf_core_marquee_text_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Marquee Text', 'wolf-core' ),
				// 'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_marquee_text',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'marquee_text',
				'icon'             => 'linea-software linea-software-font-tracking',
				'register_scripts' => array(
					'jquery-marquee'    => array(
						'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js',
						'version' => WOLF_CORE_VERSION,
					),
					'wolf-core-marquee' => array(
						'src'     => WOLF_CORE_JS . '/marquee.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'jquery-marquee', 'wolf-core-marquee' ),
			),
			'params'     => array(
				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Text', 'wolf-core' ),
					'param_name' => 'text',
				),

				array(
					'type'         => 'typography',
					'label'        => esc_html__( 'Typography', 'wolf-core' ),
					'param_name'   => 'typography',
					'selector'     => '{{WRAPPER}} .wolf-core-marquee-text',
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-marquee-text' => 'color: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),
			),
		)
	);
}
