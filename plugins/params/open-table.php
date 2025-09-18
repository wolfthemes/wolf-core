<?php
/**
 * Open Table
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
function wolf_core_open_table_params() {

	return apply_filters(
		'wolf_core_open_table_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Open Table', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_open_table',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'open-table',
				'icon'          => 'fa fa-text-width',
			),
			'params'     => array(
				array(
					'label'      => esc_html__( 'Restaurant ID', 'wolf-core' ),
					'param_name' => 'rid',
					'default'    => '412810',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Language', 'wolf-core' ),
					'param_name' => 'lang',
					'options'    => array(
						'en-US' => esc_html__( 'English-US', 'wolf-core' ),
						'fr-CA' => esc_html__( 'Français-CA', 'wolf-core' ),
						'de-DE' => esc_html__( 'Deutsch-DE', 'wolf-core' ),
						'es-MX' => esc_html__( 'Español-MX', 'wolf-core' ),
						'ja-JP' => esc_html__( '日本語-JP', 'wolf-core' ),
						'nl-NL' => esc_html__( 'Español-MX', 'wolf-core' ),
						'es-MX' => esc_html__( 'Nederlands-NL', 'wolf-core' ),
						'it-IT' => esc_html__( 'Italiano-IT', 'wolf-core' ),
					),
					'default'    => 'en-US',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Type', 'wolf-core' ),
					'param_name' => 'theme',
					'options'    => array(
						'standard' => esc_html__( 'Standard (224 x 301 pixels)', 'wolf-core' ),
						'tall'     => esc_html__( 'Tall (288 x 490 pixels)', 'wolf-core' ),
						'wide'     => esc_html__( 'Wide (840 x 350 pixels)', 'wolf-core' ),
						'button'   => esc_html__( 'Button (210 x 113 pixels)', 'wolf-core' ),
					),
					'default'    => 'wide',
				),

				array(
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'type'         => 'choose',
					'options'      => array(
						'left'   => array(
							'title' => esc_html__( 'Left', 'wolf-core' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center' => array(
							'title' => esc_html__( 'Center', 'wolf-core' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'  => array(
							'title' => esc_html__( 'Right', 'wolf-core' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'selectors'    => array(
						'{{WRAPPER}} .ot-dtp-picker' => 'margin-{{VALUE}}: 0!important;',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Theme', 'wolf-core' ),
					'param_name' => 'color',
					'options'    => array(
						'1' => esc_html__( 'Standard', 'wolf-core' ),
						'2' => esc_html__( 'Neutral', 'wolf-core' ),
						'3' => esc_html__( 'Gold', 'wolf-core' ),
						'4' => esc_html__( 'Green', 'wolf-core' ),
						'5' => esc_html__( 'Blue', 'wolf-core' ),
						'6' => esc_html__( 'Red', 'wolf-core' ),
						'7' => esc_html__( 'Teal', 'wolf-core' ),
					),
					'default'    => '2',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Color Scheme', 'wolf-core' ),
					'param_name' => 'dark',
					'options'    => array(
						'false' => esc_html__( 'Light', 'wolf-core' ),
						'true'  => esc_html__( 'Dark', 'wolf-core' ),
					),
					'default'    => 'false',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Open in New Window', 'wolf-core' ),
					'param_name' => 'newtab',
					'options'    => array(
						'false' => esc_html__( 'No', 'wolf-core' ),
						'true'  => esc_html__( 'Yes', 'wolf-core' ),
					),
					'default'    => 'true',
				),

				array(
					'label'      => esc_html__( 'Campaign Name', 'wolf-core' ),
					'param_name' => 'ot_campaign',
				),
			),
		)
	);
}
