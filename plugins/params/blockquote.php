<?php
/**
 * Blockquote
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
function wolf_core_blockquote_params() {

	return apply_filters(
		'wolf_core_blockquote_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Blockquote', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_blockquote',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'wolf_core_blockquote',
				'icon'          => 'linea-basic-elaboration linea-basic-elaboration-message-dots',
			),
			'params'     => array(
				array(
					'type'       => 'textarea',
					'label'      => esc_html__( 'Text', 'wolf-core' ),
					'param_name' => 'text',
				),
				array(
					'type'       => 'text',
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

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'blockquote_text_color',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-blockquote'            => 'color: {{VALUE}}!important;',
						'{{WRAPPER}} .wolf-core-blockquote blockquote' => 'color: {{VALUE}}!important;',
					),
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Background Color', 'wolf-core' ),
					'param_name'   => 'custom_background_color', // backward compatiblity name (WVC plugin).
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-blockquote' => 'background-color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),
			),
		)
	);
}
