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
 *  Element Parameters
 *
 * @return array
 */
function wolf_core_album_disc_params() {

	return apply_filters(
		'wolf_core_album_disc_params',
		array(
			'properties' => array(
				'name'        => esc_html__( 'Album Disc', '%TEXTDOMAIN%' ),
				'description' => esc_html__( 'A stylish presentation for your release', '%TEXTDOMAIN%' ),
				'vc_base'     => 'wolf_core_album_disc',
				'el_base'     => 'album-disc',
				'vc_category' => esc_html__( 'Music', '%TEXTDOMAIN%' ),
				'icon'        => 'dashicons-before dashicons-album',
			),

			'params'     => array(
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Alignment', '%TEXTDOMAIN%' ),
					'param_name' => 'alignment',
					'default'    => 'left',
					'options'      => array(
						'left'   => esc_html__( 'Left', '%TEXTDOMAIN%' ),
						'center' => esc_html__( 'Center', '%TEXTDOMAIN%' ),
						'right'  => esc_html__( 'Right', '%TEXTDOMAIN%' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Type', '%TEXTDOMAIN%' ),
					'param_name' => 'type',
					'options'      => array(
						'cd'    => esc_html__( 'CD', '%TEXTDOMAIN%' ),
						'vinyl' => esc_html__( 'Vinyl', '%TEXTDOMAIN%' ),
					),
				),

				array(
					'type'        => 'image',
					'label'       => esc_html__( 'Cover Image', '%TEXTDOMAIN%' ),
					'param_name'  => 'cover_image',
					'description' => esc_html__( 'Select image from media library.', '%TEXTDOMAIN%' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'image',
					'label'       => esc_html__( 'Disc Image', '%TEXTDOMAIN%' ),
					'param_name'  => 'disc_image',
					'description' => esc_html__( 'A secondary image that will be used for the CD or vinyl artwork.', '%TEXTDOMAIN%' ),
					'admin_label' => true,
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Link', '%TEXTDOMAIN%' ),
					'param_name' => 'link',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Worn Border Effect', '%TEXTDOMAIN%' ),
					'param_name' => 'worn_border',
					'options'      => array(
						'yes' => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
						'no'  => esc_html__( 'No', '%TEXTDOMAIN%' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Disc Rotate Effect', '%TEXTDOMAIN%' ),
					'param_name' => 'rotate',
					'default'    => 'hover',
					'options'      => array(
						'hover'      => esc_html__( 'On Hover', '%TEXTDOMAIN%' ),
						'hover-stop' => esc_html__( 'Stop On Hover', '%TEXTDOMAIN%' ),
						'always'     => esc_html__( 'Always', '%TEXTDOMAIN%' ),
						'none'       => esc_html__( 'None', '%TEXTDOMAIN%' ),
					),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Image Size', '%TEXTDOMAIN%' ),
					'param_name'  => 'img_size',
					'placeholder' => apply_filters( 'wolf_core_default_album_disc_img_size', '375x375' ),
					'default'     => apply_filters( 'wolf_core_default_album_disc_img_size', '375x375' ),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Disc Rotation Speed (in ms)', '%TEXTDOMAIN%' ),
					'param_name'  => 'rotation_speed',
					'placeholder' => apply_filters( 'wolf_core_default_album_disc_rotation_speed', 3500 ),
					'default'     => apply_filters( 'wolf_core_default_album_disc_rotation_speed', 3500 ),
				),
			),
		)
	);
}
