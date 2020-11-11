<?php
/**
 * Custom Heading
 *
 * @author WolfThemes
 * @category Core
 * @package %PACKAGENAME%/Elements
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

/**
 *  Element Parameters
 *
 * @return array
 */
function wolf_core_custom_heading_params() {

	return apply_filters(
		'wolf_core_custom_heading_params',
		array(
			'properties' => array(
				'name'        => esc_html__( 'Heading', '%TEXTDOMAIN%' ),
				'description' => esc_html__( 'A big title with flexible font size', '%TEXTDOMAIN%' ),
				'vc_base'     => 'vc_custom_heading',
				'vc_category' => esc_html__( 'Typography', '%TEXTDOMAIN%' ),
				'el_base'     => 'custom-heading',
				'icon'        => 'fa fa-text-width',
			),
			'params'     => array(
				array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Text', '%TEXTDOMAIN%' ),
					'param_name'  => 'text',
					'default'     => esc_html__( 'My Headline', '%TEXTDOMAIN%' ),
					'description' => sprintf( esc_html__( 'You can use the %s short tag to display the current page title.', '%TEXTDOMAIN%' ), '{{post_title}}' ),
					'admin_label' => true,
				),
				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Font Size', '%TEXTDOMAIN%' ),
					'param_name' => 'font_size',
					'default'    => apply_filters( 'wolf_core_default_custom_heading_font_size', 48 ),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Behavior', '%TEXTDOMAIN%' ),
					'param_name' => 'responsive',
					'options'    => array(
						'no'  => esc_html__( 'Static', '%TEXTDOMAIN%' ),
						'yes' => esc_html__( 'Responsive', '%TEXTDOMAIN%' ),
					),
					'default'    => 'no',
				),
				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Minimum Font Size', '%TEXTDOMAIN%' ),
					'param_name' => 'min_font_size',
					'default'    => 18,
					'condition'  => array(
						'responsive' => 'yes',
					),
				),
				array(
					'type'        => 'font_family',
					'label'       => esc_html__( 'Font', '%TEXTDOMAIN%' ),
					'param_name'  => 'font_family',
					'admin_label' => true,
					'default'     => apply_filters( 'wolf_core_default_custom_heading_font_family', '' ),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Text Alignment', '%TEXTDOMAIN%' ),
					'param_name' => 'text_align',
					'options'    => array(
						'center' => esc_html__( 'Center', '%TEXTDOMAIN%' ),
						'left'   => esc_html__( 'Left', '%TEXTDOMAIN%' ),
						'right'  => esc_html__( 'Right', '%TEXTDOMAIN%' ),
					),
					'default'    => 'left',
				),
				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Center Aligned on Mobile', '%TEXTDOMAIN%' ),
					'param_name'   => 'text_align_mobile',
					'label_on'     => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
					'label_off'    => esc_html__( 'No', '%TEXTDOMAIN%' ),
					'return_value' => 'center',
					'default'      => 'center',
				),
				array(
					'type'        => 'font_weight',
					'label'       => esc_html__( 'Font Weight', '%TEXTDOMAIN%' ),
					'param_name'  => 'font_weight',
					'admin_label' => true,
					'default'     => apply_filters( 'wolf_core_default_custom_heading_font_weight', '' ),
					'placeholder' => apply_filters( 'wolf_core_default_custom_heading_font_weight', '' ),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Text Transform', '%TEXTDOMAIN%' ),
					'param_name' => 'text_transform',
					'options'    => array(
						''          => esc_html__( 'Default', '%TEXTDOMAIN%' ),
						'none'      => esc_html__( 'None', '%TEXTDOMAIN%' ),
						'uppercase' => esc_html__( 'Uppercase', '%TEXTDOMAIN%' ),
						'lowercase' => esc_html__( 'Lowercase', '%TEXTDOMAIN%' ),
					),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Font Style', '%TEXTDOMAIN%' ),
					'param_name' => 'font_style',
					'options'    => array(
						''       => esc_html__( 'Default', '%TEXTDOMAIN%' ),
						'italic' => esc_html__( 'Italic', '%TEXTDOMAIN%' ),
					),
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Letter Spacing', '%TEXTDOMAIN%' ),
					'param_name'  => 'letter_spacing',
					'placeholder' => '0',
					'default'     => apply_filters( 'wolf_core_default_custom_heading_letter_spacing', '' ),
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Line Height', '%TEXTDOMAIN%' ),
					'param_name'  => 'letter_height',
					'placeholder' => '1',
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'HTML Tag', '%TEXTDOMAIN%' ),
					'param_name' => 'html_tag',
					'options'    => array(
						'h2' => 'h2',
						'p'  => 'p',
						'h5' => 'h5',
						'h4' => 'h4',
						'h3' => 'h3',
						'h1' => 'h1',
					),
					'default'    => 'h2',
				),
				array(
					'type'        => 'link',
					'label'       => esc_html__( 'Link', '%TEXTDOMAIN%' ),
					'param_name'  => 'link',
					'placeholder' => 'http://',
				),
			),
		)
	);
}
