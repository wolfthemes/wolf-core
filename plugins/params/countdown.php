<?php
/**
 * Countdown
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
function wolf_core_countdown_params() {

	return apply_filters(
		'wolf_core_countdown_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Countdown', 'wolf-core' ),
				'description'   => esc_html__( 'See the seconds tick down', 'wolf-core' ),
				'vc_base'       => 'wolf_core_countdown',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'countdown',
				'icon'          => 'fa fa-bell-o',
			),
			'params'     => array(

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Date', 'wolf-core' ),
					'param_name'  => 'date',
					'description' => sprintf( __( 'formatted like %s', 'wolf-core' ), '12/24/' . date( 'Y' ) . ' 12:00:00' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'UTC Timezone offset', 'wolf-core' ),
					'param_name'  => 'offset',
					'placeholder' => '-5',
					'description' => sprintf( __( 'e.g : -5 for NY. <a href="%s" target="_blank">More info</a>.', 'wolf-core' ), esc_url( 'https://en.wikipedia.org/wiki/List_of_UTC_time_offsets' ) ),
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Format', 'wolf-core' ),
					'param_name'  => 'format',
					'admin_label' => true,
					'default'     => 'dHMS',
					'options'       => array(
						'yowdHMS' => esc_html__( 'Auto (show all values as needed)', 'wolf-core' ),
						'dHMS'    => esc_html__( 'By Days', 'wolf-core' ),
						'wdHM'    => esc_html__( 'By Weeks', 'wolf-core' ),
						'odHM'    => esc_html__( 'By Month', 'wolf-core' ),
						'custom'  => esc_html__( 'Custom', 'wolf-core' ),
					),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Custom Format', 'wolf-core' ),
					'param_name'  => 'custom_format',
					'value'       => 'dHMS',
					'description' => sprintf( wolf_core_kses( __( 'You can check all avalable format codes <a href="%s" target="_blank">here</a>.', 'wolf-core' ) ), 'http://keith-wood.name/countdown.html' ),
					'condition'   => array(
						'format' => 'custom',
					),
				),

				array(
					'type'        => 'font_family',
					'label'       => esc_html__( 'Font', 'wolf-core' ),
					'param_name'  => 'font_family',
					'admin_label' => true,
					'group'       => esc_html__( 'Number Font', 'wolf-core' ),
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Font Size', 'wolf-core' ),
					'param_name' => 'font_size',
					// 'default' => 72,
					'group'      => esc_html__( 'Number Font', 'wolf-core' ),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Font Weight', 'wolf-core' ),
					'param_name'  => 'font_weight',
					'placeholder' => 700,
					'group'       => esc_html__( 'Number Font', 'wolf-core' ),
					'default'     => apply_filters( 'wolf_core_default_countdown_font_weight', 700 ),
				),

				array(
					'type'       => 'dropdown',
					'label'      => esc_html__( 'Number Font Color', 'wolf-core' ),
					'param_name' => 'number_font_color',
					'options'    => array_merge(
						array( 'default' => esc_html__( 'Default color', 'wolf-core' ) ),
						wolf_core_get_shared_colors(),
						array( 'custom' => esc_html__( 'Custom color', 'wolf-core' ) )
					),
					'group'      => esc_html__( 'Colors', 'wolf-core' ),
				),

				array(
					'type'        => 'colorpicker',
					'label'       => esc_html__( 'Number Font Custom Color', 'wolf-core' ),
					'param_name'  => 'number_font_custom_color',
					'description' => esc_html__( 'Select custom single pie chart track color.', 'wolf-core' ),
					'condition'   => array(
						'number_font_color' => 'custom',
					),
					'group'       => esc_html__( 'Colors', 'wolf-core' ),
				),

				array(
					'type'       => 'dropdown',
					'label'      => esc_html__( 'Text Font Color', 'wolf-core' ),
					'param_name' => 'text_font_color',
					'options'    => array_merge(
						array( 'default' => esc_html__( 'Default color', 'wolf-core' ) ),
						wolf_core_get_shared_colors(),
						array( 'custom' => esc_html__( 'Custom color', 'wolf-core' ) )
					),
					'group'      => esc_html__( 'Colors', 'wolf-core' ),
				),

				array(
					'type'        => 'colorpicker',
					'label'       => esc_html__( 'Text Font Custom Color', 'wolf-core' ),
					'param_name'  => 'text_font_custom_color',
					'description' => esc_html__( 'Select custom text color.', 'wolf-core' ),
					'condition'   => array(
						'text_font_color' => 'custom',
					),
					'group'       => esc_html__( 'Colors', 'wolf-core' ),
				),
			),
		)
	);
}
