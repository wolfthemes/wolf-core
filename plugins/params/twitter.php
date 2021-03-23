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

	return apply_filters( 'wolf_core_twitter_params', [
		'properties' => [
			'name' => esc_html__( 'Twitter Feed', 'wolf-core' ),
			'description' => esc_html__( 'Your last tweets', 'wolf-core' ),
			'vc_base' => '_twitter',
			'vc_category' => esc_html__( 'Socials' , 'wolf-core' ),
			'el_base' => 'twitter',
            'icon' => 'fa fa-twitter',
		],
		'params' => [
			[
				'type' => 'textfield',
				'label' => esc_html__( 'Username', 'wolf-core' ),
				'param_name' => 'username',
				'default' => wolf_core_get_twitter_usename(),
				'admin_label' => true,
            ],

			[
				'type' => 'dropdown',
				'label' => esc_html__( 'Type', 'wolf-core' ),
				'param_name' => 'type',
				'default' => [
					'single' => esc_html__( 'Single', 'wolf-core' ),
					'list' => esc_html__( 'List', 'wolf-core' ),
                ],
            ],

			[
				'type' => 'dropdown',
				'label' => esc_html__( 'Text Alignment', 'wolf-core' ),
				'param_name' => 'text_align',
				'default' => [
					'default' => esc_html__( 'Default', 'wolf-core' ),
					'center' => esc_html__( 'Center', 'wolf-core' ),
					'left' => esc_html__( 'Left', 'wolf-core' ),
					'right' => esc_html__( 'Right', 'wolf-core' ),
                ],
                'condition' => [
					'type' => 'single',
				],
            ],

			[
				'type' => 'textfield',
				'label' => esc_html__( 'Count', 'wolf-core' ),
				'param_name' => 'count',
				'default' => 3,
                'condition' => [
					'type' => 'list',
				],
            ],
		]
	] );
}
