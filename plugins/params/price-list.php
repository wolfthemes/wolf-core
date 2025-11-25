<?php
/**
 * Price List
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
function wolf_core_price_list_params() {

	return apply_filters(
		'wolf_core_price_list_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Price List', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_price_list',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'wolf_core_price_list',
				'icon'          => 'far fa-list-alt',
			),
			'params'     => array(
				// array(
				// 'type'       => 'select',
				// 'label'      => esc_html__( 'HTML Tag', 'wolf-core' ),
				// 'param_name' => 'title_tag',
				// 'options'    => array(
				// 'h1'   => 'H1',
				// 'h2'   => 'H2',
				// 'h3'   => 'H3',
				// 'h4'   => 'H4',
				// 'h5'   => 'H5',
				// 'h6'   => 'H6',
				// 'div'  => 'div',
				// 'span' => 'span',
				// 'p'    => 'p',
				// ),
				// ),
				array(
					'type'       => 'repeater',
					'param_name' => 'prices',
					'label'      => esc_html__( 'Prices', 'wolf-core' ),
					'params'     => array(

						array(
							'label'      => esc_html__( 'Title', 'wolf-core' ),
							'param_name' => 'title',
						),

						array(
							'label'      => esc_html__( 'Price', 'wolf-core' ),
							'param_name' => 'price',
						),

						array(
							'label'      => esc_html__( 'Description', 'wolf-core' ),
							'param_name' => 'description',
						),
					),
				),
			),
		)
	);
}
