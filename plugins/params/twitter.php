<?php
/**
 * Twitter Feed
 *
 * Wolf Twitter Plugin
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
function wolf_core_twitter_params() {

	return apply_filters(
		'wolf_core_twitter_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Twitter Feed', 'wolf-core' ),
				'description'   => esc_html__( 'Your last tweets', 'wolf-core' ),
				'vc_base'       => 'wolf_core_twitter',
				'vc_category'   => esc_html__( 'Socials', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'twitter',
				'icon'          => 'fab fa-twitter',
			),
			'params'     => array(
				array(
					'type'        => 'textfield',
					'label'       => esc_html__( 'Username', 'wolf-core' ),
					'param_name'  => 'username',
					'default'     => wolf_core_get_twitter_usename(),
					'admin_label' => true,
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Type', 'wolf-core' ),
					'param_name' => 'type',
					'options'    => array(
						'single' => esc_html__( 'Single', 'wolf-core' ),
						'list'   => esc_html__( 'List', 'wolf-core' ),
					),
					'default'    => 'single',
				),

				array(
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'text_align',
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
						'{{WRAPPER}} .wolf-bigtweet-content' => 'text-align:{{VALUE}}!important;',
					),
					'condition'    => array(
						'type' => 'single',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'text_align',
					'options'      => array(
						'default' => esc_html__( 'Default', 'wolf-core' ),
						'center'  => esc_html__( 'Center', 'wolf-core' ),
						'left'    => esc_html__( 'Left', 'wolf-core' ),
						'right'   => esc_html__( 'Right', 'wolf-core' ),
					),
					'condition'    => array(
						'type' => 'single',
					),
					'page_builder' => 'vc',
				),

				array(
					'type'       => 'textfield',
					'label'      => esc_html__( 'Count', 'wolf-core' ),
					'param_name' => 'count',
					'default'    => 3,
					'condition'  => array(
						'type' => 'list',
					),
				),
			),
		)
	);
}
