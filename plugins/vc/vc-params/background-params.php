<?php
/**
 * Background params for containers
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Background params
 */
function wolf_core_background_params() {
	return array(

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background type', 'wolf-core' ),
			'param_name' => 'background_type',
			'value'      => array(
				esc_html__( 'Default', 'wolf-core' )                  => 'default',
				esc_html__( 'Image and Color', 'wolf-core' )          => 'image',
				esc_html__( 'Slideshow', 'wolf-core' )                => 'slideshow',
				esc_html__( 'Video', 'wolf-core' )                    => 'video',
				esc_html__( 'No Background', 'wolf-core' )            => 'transparent',
				esc_html__( 'Post Featured Image', 'wolf-core' )      => 'featured_image',
				esc_html__( 'Default WordPress Header', 'wolf-core' ) => 'default_header',
			),
			'std'        => apply_filters( 'wolf_core_default_background_type', 'default' ),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Background Color', 'wolf-core' ),
			'param_name'         => 'background_color',
			'value'              => array_merge(
				array( esc_html__( 'Default', 'wolf-core' ) => 'default' ),
				array_flip( wolf_core_get_shared_colors() ),
				array( esc_html__( 'Custom color', 'wolf-core' ) => 'custom' ),
				array( esc_html__( 'Transparent', 'wolf-core' ) => 'transparent' )
			),
			'std'                => 'default',
			'description'        => esc_html__( 'Select a background color.', 'wolf-core' ),
			'group'              => esc_html__( 'Style', 'wolf-core' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'dependency'         => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
		),

		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Background Color', 'wolf-core' ),
			'param_name' => 'background_custom_color',
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
			'dependency' => array(
				'element' => 'background_color',
				'value'   => 'custom',
			),
		),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Background Image', 'wolf-core' ),
			'param_name' => 'background_img',
			'value'      => '',
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background position', 'wolf-core' ),
			'param_name' => 'background_position',
			'value'      => array(
				esc_html__( 'center center', 'wolf-core' ) => 'center center',
				esc_html__( 'center top', 'wolf-core' )    => 'center top',
				esc_html__( 'left top', 'wolf-core' )      => 'left top',
				esc_html__( 'right top', 'wolf-core' )     => 'right top',
				esc_html__( 'center bottom', 'wolf-core' ) => 'center bottom',
				esc_html__( 'left bottom', 'wolf-core' )   => 'left bottom',
				esc_html__( 'right bottom', 'wolf-core' )  => 'right bottom',
				esc_html__( 'left center', 'wolf-core' )   => 'left center',
				esc_html__( 'right center', 'wolf-core' )  => 'right center',
			),
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
			// 'edit_field_class' => 'wvc-half-start',
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background repeat', 'wolf-core' ),
			'param_name' => 'background_repeat',
			'value'      => array(
				esc_html__( 'no repeat', 'wolf-core' ) => 'no-repeat',
				esc_html__( 'repeat', 'wolf-core' )    => 'repeat',
				esc_html__( 'repeat-x', 'wolf-core' )  => 'repeat-x',
				esc_html__( 'repeat-y', 'wolf-core' )  => 'repeat-y',
			),
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
			// 'edit_field_class' => 'wvc-half-end',
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background Size', 'wolf-core' ),
			'param_name' => 'background_size',
			'value'      => array(
				esc_html__( 'cover', 'wolf-core' )   => 'cover',
				esc_html__( 'default', 'wolf-core' ) => 'default',
				esc_html__( 'contain', 'wolf-core' ) => 'contain',
			),
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background Effect', 'wolf-core' ),
			'param_name' => 'background_effect',
			'value'      => apply_filters(
				'wolf_core_background_effects',
				array(
					esc_html__( 'None', 'wolf-core' )     => 'none',
					esc_html__( 'Parallax', 'wolf-core' ) => 'parallax',
					esc_html__( 'Zoom', 'wolf-core' )     => 'zoomin',
					esc_html__( 'Fixed', 'wolf-core' )    => 'fixed',
					esc_html__( 'Marquee', 'wolf-core' )  => 'marquee',
					esc_html__( 'Blur', 'wolf-core' )     => 'blur',
				)
			),
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image', 'default_header', 'featured_image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Marquee Image Position', 'wolf-core' ),
			'param_name' => 'background_marquee_position',
			'value'      => array(
				esc_html__( 'stretch', 'wolf-core' ) => 'stretch',
				esc_html__( 'top', 'wolf-core' )     => 'top',
				esc_html__( 'middle', 'wolf-core' )  => 'middle',
				esc_html__( 'bottom', 'wolf-core' )  => 'bottom',
			),
			'dependency' => array(
				'element' => 'background_effect',
				'value'   => array( 'marquee' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'LazyLoad', 'wolf-core' ),
			'param_name' => 'background_img_lazyload',
			'value'      => array( esc_html__( 'Yes', 'wolf-core' ) => true ),
			'std'        => true,
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image', 'default_header', 'featured_image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		// Video URL
		array(
			'type'        => 'wolf_core_video_url',
			'heading'     => esc_html__( 'Video URL', 'wolf-core' ),
			'param_name'  => 'video_bg_url',
			'value'       => '',
			'description' => esc_html__( 'A YouTube, Vimeo, or mp4 URL.', 'wolf-core' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', 'wolf-core' ),
			'weight'      => 0,
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Video Start Time', 'wolf-core' ),
			'param_name'  => 'video_bg_start_time',
			'value'       => '',
			'description' => esc_html__( 'Set at which second the video will start (beta).', 'wolf-core' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', 'wolf-core' ),
			'weight'      => 0,
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Video End Time', 'wolf-core' ),
			'param_name'  => 'video_bg_end_time',
			'value'       => '',
			'description' => esc_html__( 'Set at which second the video will end (beta).', 'wolf-core' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', 'wolf-core' ),
			'weight'      => 0,
		),

		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Video Parallax', 'wolf-core' ),
			'param_name' => 'video_bg_parallax',
			'value'      => '',
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Loop video.', 'wolf-core' ),
			'param_name'  => 'video_bg_loop',
			'value'       => array(
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
				esc_html__( 'No', 'wolf-core' )  => 'no',
			),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', 'wolf-core' ),
			'weight'      => 0,
			'description' => esc_html__( 'Beta: If set to "No", the video will stop at the end only for YouTube video when parallax is not enabled.', 'wolf-core' ),
		),

		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Video Image Fallback', 'wolf-core' ),
			'param_name'  => 'video_bg_img',
			'value'       => '',
			'description' => esc_html__( 'An image to display when the video is loading.', 'wolf-core' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', 'wolf-core' ),
			'weight'      => 0,
		),

		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Video Image Mobile Fallback', 'wolf-core' ),
			'param_name'  => 'video_bg_img_mobile',
			'value'       => '',
			'description' => esc_html__( 'An image to display when the video can\'t be played. The image above will be used if empty.', 'wolf-core' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', 'wolf-core' ),
			'weight'      => 0,
		),

		// Slideshow images
		array(
			'type'       => 'attach_images',
			'heading'    => esc_html__( 'Slideshow Images', 'wolf-core' ),
			'param_name' => 'slideshow_img_ids',
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'slideshow' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		// Slideshow speed
		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Slideshow Speed', 'wolf-core' ),
			'param_name'  => 'slideshow_speed',
			'description' => esc_html__( 'In milliseconds.', 'wolf-core' ),
			'placeholder' => 5000,
			'std'         => '5000',
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'slideshow' ),
			),
			'group'       => esc_html__( 'Style', 'wolf-core' ),
			'weight'      => 0,
		),

		// Overlay
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Add Overlay', 'wolf-core' ),
			'param_name' => 'add_overlay',
			'value'      => array(
				esc_html__( 'No', 'wolf-core' )  => '',
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
		),

		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Overlay Color', 'wolf-core' ),
			'param_name'         => 'overlay_color',
			'value'              => array_merge(
				array( esc_html__( 'Auto', 'wolf-core' ) => 'auto' ),
				wolf_core_get_shared_gradient_colors(),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', 'wolf-core' ) => 'custom' )
			),
			'std'                => 'black',
			'description'        => esc_html__( 'Select an overlay color.', 'wolf-core' ),
			'group'              => esc_html__( 'Style', 'wolf-core' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'dependency'         => array(
				'element' => 'add_overlay',
				'value'   => array( 'yes' ),
			),
		),

		// Overlay color
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Overlay Custom Color', 'wolf-core' ),
			'param_name' => 'overlay_custom_color',
			// 'value' => '#000000',
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'dependency' => array(
				'element' => 'overlay_color',
				'value'   => 'custom',
			),
		),

		// Overlay opacity
		array(
			'type'        => 'wolf_core_numeric_slider',
			'heading'     => esc_html__( 'Overlay Opacity in Percent', 'wolf-core' ),
			'param_name'  => 'overlay_opacity',
			'description' => '',
			'value'       => 60,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'dependency'  => array(
				'element' => 'add_overlay',
				'value'   => array( 'yes' ),
			),
			'group'       => esc_html__( 'Style', 'wolf-core' ),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Add Top Shape Divider', 'wolf-core' ),
			'param_name' => 'add_top_shape_divider',
			'value'      => array(
				esc_html__( 'No', 'wolf-core' )  => '',
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Add Bottom Shape Divider', 'wolf-core' ),
			'param_name' => 'add_bottom_shape_divider',
			'value'      => array(
				esc_html__( 'No', 'wolf-core' )  => '',
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		// Particles
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Add Particles', 'wolf-core' ),
			'param_name' => 'add_particles',
			'value'      => array(
				esc_html__( 'No', 'wolf-core' )  => '',
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
		),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Particles Type', 'wolf-core' ),
		// 'param_name' => 'particles_type',
		// 'value' => array(
		// esc_html__( 'Default', 'wolf-core' ) => 'default',
		// esc_html__( 'Yes', 'wolf-core' ) => 'yes',
		// ),
		// 'dependency' => array( 'element' => 'add_particles', 'value' => array( 'yes' ) ),
		// 'group' => esc_html__( 'Style', 'wolf-core' ),
		// ),
	);
}
