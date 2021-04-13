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
				'icon'          => 'fa fa-user',
			),
			'params'     => array(

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
					'default'     => 'landscape',
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

				/* Socials */


				/* Style */


			),
		)
	);
}
