<?php
/**
 * Team Member
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
function wolf_core_team_member_params() {

	/* Get social params */
	$social_params = array();

	$social_params[] = array(
		'type'       => 'checkbox',
		'label'      => esc_html__( 'Show Socials', 'wolf-core' ),
		'param_name' => 'show_socials',
	);

	foreach ( wolf_core_get_team_member_socials() as $social ) {
		$social_params[] = array(
			'type'        => 'text',
			'label'       => ucfirst( $social ),
			'param_name'  => $social,
			'placeholder' => 'http://',
			'condition'   => array(
				'show_socials' => 'yes',
			),
			// 'group'       => esc_html__( 'Socials', 'wolf-core' ),
		);
	}

	return apply_filters(
		'wolf_core_team_member_params',
		array(
			'properties' => array(
				'name'          => apply_filters( 'wolf_core_team_member_title', esc_html__( 'Team Member', 'wolf-core' ) ),
				'description'   => apply_filters( 'wolf_core_team_member_description', esc_html__( 'Present your staff members', 'wolf-core' ) ),
				'vc_base'       => 'wolf_core_team_member',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'team-member',
				'icon'          => 'lnr lnr-user',
			),
			'params'     => array_merge(
				array(

					/* Content */
					array(
						'type'       => 'image',
						'label'      => esc_html__( 'Photo', 'wolf-core' ),
						'param_name' => 'image_id',
					),

					array(
						'type'        => 'select',
						'label'       => esc_html__( 'Image Size', 'wolf-core' ),
						'param_name'  => 'img_size',
						'options'     => wolf_core_get_image_sizes(),
						'default'     => 'medium',
						'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
						'admin_label' => true,
					),

					array(
						'type'        => 'text',
						'label'       => esc_html__( 'Custom Image Size', 'wolf-core' ),
						'param_name'  => 'custom_img_size',
						'description' => esc_html__( 'Enter size in pixels (Example: 200x100 (Width x Height).', 'wolf-core' ),
						'condition'   => array( 'img_size' => 'custom' ),
					),

					array(
						'type'        => 'text',
						'label'       => esc_html__( 'Name', 'wolf-core' ),
						'param_name'  => 'name',
						'admin_label' => true,
					),

					array(
						'type'       => 'select',
						'label'      => esc_html__( 'HTML Tag', 'wolf-core' ),
						'param_name' => 'title_tag',
						'options'    => array(
							'h4'   => 'H4',
							'h1'   => 'H1',
							'h2'   => 'H2',
							'h3'   => 'H3',
							'h5'   => 'H5',
							'h6'   => 'H6',
							'div'  => 'div',
							'span' => 'span',
							'p'    => 'p',
						),
					),

					array(
						'type'        => 'text',
						'label'       => esc_html__( 'Role', 'wolf-core' ),
						'param_name'  => 'role',
						'admin_label' => true,
					),

					array(
						'type'        => 'textarea',
						'label'       => esc_html__( 'Description', 'wolf-core' ),
						'param_name'  => 'tagline',
						'admin_label' => true,
					),

					array(
						'type'       => 'link',
						'label'      => esc_html__( 'Link', 'wolf-core' ),
						'param_name' => 'link',
					),

					array(
						'type'       => 'typography',
						'param_name' => 'name_typography',
						'label'      => esc_html__( 'Name Typography', 'wolf-core' ),
						'selector'   => '{{WRAPPER}} .wolf-core-team-member-name',
						'group'      => esc_html__( 'Style', 'wolf-core' ),
					),
					array(
						'type'       => 'typography',
						'param_name' => 'role_typography',
						'label'      => esc_html__( 'Role Typography', 'wolf-core' ),
						'selector'   => '{{WRAPPER}} .wolf-core-team-member-role',
						'group'      => esc_html__( 'Style', 'wolf-core' ),
					),

					array(
						'type'       => 'typography',
						'param_name' => 'bio_typography',
						'label'      => esc_html__( 'Bio Typography', 'wolf-core' ),
						'selector'   => '{{WRAPPER}} .wolf-core-team-member-tagline',
						'group'      => esc_html__( 'Style', 'wolf-core' ),
					),

					array(
						'type'       => 'colorpicker',
						'param_name' => 'role_color',
						'label'      => esc_html__( 'Role Color', 'wolf-core' ),
						'selector'   => '{{WRAPPER}} .wolf-core-team-member-tagline',
						'group'      => esc_html__( 'Style', 'wolf-core' ),
					),

					// array(
					// 'type'         => 'colorpicker',
					// 'param_name'   => 'bio_color',
					// 'label'        => esc_html__( 'Bio Color', 'wolf-core' ),
					// 'selector'     => '{{WRAPPER}} .wolf-core-team-member-tagline',
					// 'group'        => esc_html__( 'Style', 'wolf-core' ),
					// ),
				),
				$social_params,
			),
		)
	);
}
