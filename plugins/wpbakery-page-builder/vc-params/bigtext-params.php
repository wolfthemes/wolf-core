<?php
/**
 * WPBakery Page Builder Extension big text params
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get bigtext params
 *
 * @return array
 */
function wolf_core_bigtext_params() {

	return array(
		'name' => esc_html__( 'Big Text', 'wolf-core' ),
		'base' => 'wolf_core_bigtext',
		'description' => esc_html__( 'A big line of text that will take the full width of its container', 'wolf-core' ),
		'category' => esc_html__( 'Typography' , 'wolf-core' ),
		'icon' => 'fa fa-text-width',
		'show_settings_on_create' => true,
		//'admin_enqueue_js' => wolf_core_JS . '/admin/font-preview.js',
		'params' => array(

			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Text', 'wolf-core' ),
				'param_name' => 'text',
				'value' => esc_html__( 'My mega big text', 'wolf-core' ),
				'admin_label' => true,
				'description' => esc_html__( 'You can add several lines of text.', 'wolf-core' ) . '<br>' . sprintf( esc_html__( 'You can use the %s short tag to display the current page title.', 'wolf-core' ), '{{post_title}}' ),
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Text Color', 'wolf-core' ),
				'param_name' => 'color',
				'value' => array_merge( wolf_core_get_shared_colors(), array(
						esc_html__( 'Default color', 'wolf-core' ) => 'default',
						esc_html__( 'Gradient Red', 'wolf-core' ) => 'gradient-red',
						esc_html__( 'Gradient Green', 'wolf-core' ) => 'gradient-green',
						esc_html__( 'Custom color', 'wolf-core' ) => 'custom',
					)
				),
				'std' => 'default',
				'description' => esc_html__( 'Select a text color.', 'wolf-core' ),
				'param_holder_class' => 'wolf_core_colored-dropdown',
			),

			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Color', 'wolf-core' ),
				'param_name' => 'custom_color',
				'dependency' => array(
					'element' => 'color',
					'value' => 'custom',
				),
			),

			array(
				'type' => 'wolf_core_textfield',
				'heading' => esc_html__( 'Font Weight', 'wolf-core' ),
				'param_name' => 'font_weight',
				'value' => apply_filters( 'wolf_core_default_bigtext_font_weight', 700 ),
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Text Transform', 'wolf-core' ),
				'param_name' => 'text_transform',
				'value' => array(
					esc_html__( 'Uppercase', 'wolf-core' ) => 'uppercase',
					esc_html__( 'None', 'wolf-core' ) => 'none',
				),
				'admin_label' => true,
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Font Style', 'wolf-core' ),
				'param_name' => 'font_style',
				'value' => array(
					esc_html__( 'Default', 'wolf-core' ) => '',
					esc_html__( 'Italic', 'wolf-core' ) => 'italic',
				),
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Font Style', 'wolf-core' ),
				'param_name' => 'font_style',
				'value' => array(
					esc_html__( 'Default', 'wolf-core' ) => '',
					esc_html__( 'Italic', 'wolf-core' ) => 'italic',
				),
			),

			array(
				'type' => 'wolf_core_font_family',
				'heading' => esc_html__( 'Font', 'wolf-core' ),
				'param_name' => 'font_family',
				'admin_label' => true,
				'std' => apply_filters( 'wolf_core_default_bigtext_font_family', '' ),
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Tag', 'wolf-core' ),
				'param_name' => 'title_tag',
				'value' => array(
					'h2',
					'p',
					'h5',
					'h4',
					'h3',
					'h1',
				),
			),

			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link', 'wolf-core' ),
				'param_name' => 'link',
				'placeholder' => 'http://',
			),
		)
	);
}
