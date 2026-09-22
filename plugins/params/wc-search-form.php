<?php
/**
 * WC Search Form
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
function wolf_core_wc_search_form_params() {

	return apply_filters(
		'wolf_core_wc_search_form_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'WooCommerce Search Form', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_wc_search_form',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'wc-search-form',
				'icon'          => 'ei ei-search2',
			),
			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Title', 'wolf-core' ),
					'param_name'  => 'title',
					'placeholder' => esc_html__( 'My video title', 'wolf-core' ),
					'admin_label' => true,
				),
			),
		)
	);
}
