<?php
/**
 * Twitter Feed
 *
 * Wolf Twitter Plugin
 *
 * @author %AUTHOR%
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
function wolf_core_twitter_params() {

	return apply_filters( 'wolf_core_twitter_params', [
		'properties' => [
			'name' => esc_html__( 'Twitter Feed', '%TEXTDOMAIN%' ),
			'description' => esc_html__( 'Your last tweets', '%TEXTDOMAIN%' ),
			'vc_base' => '_twitter',
			'vc_category' => esc_html__( 'Socials' , '%TEXTDOMAIN%' ),
			'el_base' => 'twitter',
            'icon' => 'fa fa-twitter',
		],
		'params' => [
			[
				'type' => 'textfield',
				'label' => esc_html__( 'Username', '%TEXTDOMAIN%' ),
				'param_name' => 'username',
				'default' => wolf_core_get_twitter_usename(),
				'admin_label' => true,
            ],

			[
				'type' => 'dropdown',
				'label' => esc_html__( 'Type', '%TEXTDOMAIN%' ),
				'param_name' => 'type',
				'default' => [
					'single' => esc_html__( 'Single', '%TEXTDOMAIN%' ),
					'list' => esc_html__( 'List', '%TEXTDOMAIN%' ),
                ],
            ],

			[
				'type' => 'dropdown',
				'label' => esc_html__( 'Text Alignment', '%TEXTDOMAIN%' ),
				'param_name' => 'text_align',
				'default' => [
					'default' => esc_html__( 'Default', '%TEXTDOMAIN%' ),
					'center' => esc_html__( 'Center', '%TEXTDOMAIN%' ),
					'left' => esc_html__( 'Left', '%TEXTDOMAIN%' ),
					'right' => esc_html__( 'Right', '%TEXTDOMAIN%' ),
                ],
                'condition' => [
					'type' => 'single',
				],
            ],

			[
				'type' => 'textfield',
				'label' => esc_html__( 'Count', '%TEXTDOMAIN%' ),
				'param_name' => 'count',
				'default' => 3,
                'condition' => [
					'type' => 'list',
				],
            ],
		]
	] );
}