<?php
/**
 * Album Disc
 *
 * @author WolfThemes
 * @package WolfCore/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Element Parameters
 *
 * @return array
 */
function wolf_core_album_disc_params() {

	return apply_filters(
		'wolf_core_album_disc_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Album Disc', 'wolf-core' ),
				'description'   => esc_html__( 'A stylish presentation for your release', 'wolf-core' ),
				'vc_base'       => 'wolf_core_album_disc',
				'el_base'       => 'album-disc',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'keywords'      => array( 'music' ),
				'icon'          => 'dashicons-before dashicons-album',
				'scripts'       => array( 'wow', 'waypoints' ),
			),

			'params'     => array(

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
						'{{WRAPPER}} .wolf-core-album-disc' => 'margin-{{VALUE}}: 0;',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'options'      => array(
						'center' => esc_html__( 'Center', 'wolf-core' ),
						'left'   => esc_html__( 'Left', 'wolf-core' ),
						'right'  => esc_html__( 'Right', 'wolf-core' ),
					),
					'page_builder' => 'vc',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Type', 'wolf-core' ),
					'param_name' => 'type',
					'options'    => array(
						'cd'    => esc_html__( 'CD', 'wolf-core' ),
						'vinyl' => esc_html__( 'Vinyl', 'wolf-core' ),
					),
				),

				array(
					'type'        => 'image',
					'label'       => esc_html__( 'Cover Image', 'wolf-core' ),
					'param_name'  => 'cover_image',
					'description' => esc_html__( 'Select image from media library.', 'wolf-core' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'image',
					'label'       => esc_html__( 'Disc Image', 'wolf-core' ),
					'param_name'  => 'disc_image',
					'description' => esc_html__( 'A secondary image that will be used for the CD or vinyl artwork.', 'wolf-core' ),
					'admin_label' => true,
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Worn Border Effect', 'wolf-core' ),
					'param_name' => 'worn_border',
					'default'    => 'no',
					'options'    => array(
						'yes' => esc_html__( 'Yes', 'wolf-core' ),
						'no'  => esc_html__( 'No', 'wolf-core' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Disc Rotate Effect', 'wolf-core' ),
					'param_name' => 'rotate',
					'default'    => 'hover',
					'options'    => array(
						'hover'      => esc_html__( 'On Hover', 'wolf-core' ),
						'hover-stop' => esc_html__( 'Stop On Hover', 'wolf-core' ),
						'always'     => esc_html__( 'Always', 'wolf-core' ),
						'none'       => esc_html__( 'None', 'wolf-core' ),
					),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Image Size', 'wolf-core' ),
					'param_name'  => 'img_size',
					'placeholder' => apply_filters( 'wolf_core_default_album_disc_img_size', '375x375' ),
					'default'     => apply_filters( 'wolf_core_default_album_disc_img_size', '375x375' ),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Disc Rotation Speed (in ms)', 'wolf-core' ),
					'param_name'  => 'rotation_speed',
					'placeholder' => apply_filters( 'wolf_core_default_album_disc_rotation_speed', 3500 ),
					'default'     => apply_filters( 'wolf_core_default_album_disc_rotation_speed', 3500 ),
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Link', 'wolf-core' ),
					'param_name' => 'link',
				),
			),
		)
	);
}
