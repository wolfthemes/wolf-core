<?php
/**
 * MailChimp
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
function wolf_core_mailchimp_params() {

	return apply_filters(
		'wolf_core_mailchimp_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'mailchimp', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_mailchimp',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'mailchimp',
				'keywords'      => array( 'newsletter', 'form' ),
				'icon'          => 'fa fa-text-width',
			),
			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'List ID', 'wolf-visual-composer' ),
					'param_name'  => 'list',
					'description' => esc_html__( 'It can be found in your MailChimp account -> Lists -> Your List Name -> Settings -> List Name & default', 'wolf-visual-composer' ),
					'default'     => wolf_core_get_option( 'mailchimp', 'default_mailchimp_list_id' ),
					'admin_label' => true,
				),

				/* VC options (select version) */
				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Ask name', 'wolf-visual-composer' ),
					'param_name'   => 'show_name',
					'options'      => array(
						'no'  => esc_html__( 'No', 'wolf-visual-composer' ),
						'yes' => esc_html__( 'Yes', 'wolf-visual-composer' ),
					),
					'admin_label'  => true,
					'page_builder' => 'vc',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Show Default Background', 'wolf-visual-composer' ),
					'description'  => esc_html__( 'You can set a background in the MailChimp plugin settings.', 'wolf-visual-composer' ),
					'param_name'   => 'show_bg',
					'options'      => array(
						'no'  => esc_html__( 'No', 'wolf-visual-composer' ),
						'yes' => esc_html__( 'Yes', 'wolf-visual-composer' ),
					),
					'admin_label'  => true,
					'page_builder' => 'vc',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Show Default Label', 'wolf-visual-composer' ),
					'description'  => esc_html__( 'You can set a label in the MailChimp plugin settings.', 'wolf-visual-composer' ),
					'param_name'   => 'show_label',
					'options'      => array(
						'no'  => esc_html__( 'No', 'wolf-visual-composer' ),
						'yes' => esc_html__( 'Yes', 'wolf-visual-composer' ),
					),
					'admin_label'  => true,
					'page_builder' => 'vc',
				),

				/* Elementor options (switcher version) */
				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Ask name', 'wolf-visual-composer' ),
					'param_name'   => 'show_name',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Show Default Background', 'wolf-visual-composer' ),
					'description'  => esc_html__( 'You can set a background in the MailChimp plugin settings.', 'wolf-visual-composer' ),
					'param_name'   => 'show_bg',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Show Default Label', 'wolf-visual-composer' ),
					'description'  => esc_html__( 'You can set a label in the MailChimp plugin settings.', 'wolf-visual-composer' ),
					'param_name'   => 'show_label',
					'page_builder' => 'elementor',
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Size', 'wolf-visual-composer' ),
					'param_name'  => 'size',
					'options'     => array(
						'large'  => esc_html__( 'Inline', 'wolf-visual-composer' ),
						'normal' => esc_html__( 'Normal', 'wolf-visual-composer' ),
					),
					'admin_label' => true,
				),

				// array(
				// 'type' => 'select',
				// 'label' => esc_html__( 'Submit Type', 'wolf-visual-composer' ),
				// 'param_name' => 'submit_type',
				// 'value' => array(
				// 'text' => esc_html__( 'Text', 'wolf-visual-composer' ),
				// 'icon' => esc_html__( 'Icon', 'wolf-visual-composer' ),
				// ),
				// 'admin_label' => true,
				// ),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Submit Text', 'wolf-visual-composer' ),
					'param_name'  => 'submit_text',
					'placeholder' => wolf_core_get_option( 'mailchimp', 'subscribe_text', esc_html__( 'Subscribe', 'wolf-visual-composer' ) ),
					'default'     => wolf_core_get_option( 'mailchimp', 'subscribe_text', esc_html__( 'Subscribe', 'wolf-visual-composer' ) ),
					'admin_label' => true,
					// 'dependency' => array(
					// 'element' => 'submit_type',
					// 'value' => 'text',
					// ),
				),

				array(
					'label'        => esc_html__( 'Text Alignment', 'wolf-core' ),
					'param_name'   => 'text_alignment',
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
						'{{WRAPPER}} .wolf-core-mailchimp-form-container' => 'text-align:{{VALUE}};',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Text Alignment', 'wolf-core' ),
					'param_name'   => 'text_alignment',
					'options'      => array(
						'center' => esc_html__( 'Center', 'wolf-core' ),
						'left'   => esc_html__( 'Left', 'wolf-core' ),
						'right'  => esc_html__( 'Right', 'wolf-core' ),
					),
					'page_builder' => 'vc',
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Alignment', 'wolf-visual-composer' ),
					'param_name'  => 'alignment',
					'options'     => array(
						'center' => esc_html__( 'Center', 'wolf-visual-composer' ),
						'left'   => esc_html__( 'Left', 'wolf-visual-composer' ),
						'right'  => esc_html__( 'Right', 'wolf-visual-composer' ),
					),
					'admin_label' => true,
				),
			),
		)
	);
}
