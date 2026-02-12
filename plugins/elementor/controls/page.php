<?php
/**
 * Page settings
 *
 * Add main post meta as document settings
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Controls
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add page settings contols
 *
 * @param \Elementor\PageSettings\Page $page The widget/page object.
 */
function wolf_core_add_elementor_page_settings_controls( $page ) {

	$content_block_posts = get_posts( 'post_type="wolf_content_block"&numberposts=-1' );

	$content_blocks = array(
		''     => '&mdash; ' . esc_html__( 'Default', 'wolf-core' ) . ' &mdash;',
		'none' => esc_html__( 'None', 'wolf-core' ),
	);
	if ( $content_block_posts ) {
		foreach ( $content_block_posts as $content_block_options ) {
			$content_blocks[ $content_block_options->ID ] = $content_block_options->post_title;
		}
	} else {
		$content_blocks[0] = esc_html__( 'No Content Block Yet', 'wolf-core' );
	}

	$post_meta = apply_filters(
		'wolf_core_theme_post_settings',
		array(
			/* Loading Animation */
			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Loading Animation', 'wolf-core' ),
				'param_name' => 'loading_animation_type',
				'default'    => '',
				'options'    => apply_filters(
					'wolf_core_theme_loading_animation_type',
					array(
						''        => '&mdash; ' . esc_html__( 'Default', 'wolf-core' ) . ' &mdash;',
						'none'    => esc_html__( 'None', 'wolf-core' ),
						'overlay' => esc_html__( 'Overlay', 'wolf-core' ),
					)
				),
			),

			/* Menu Layout */
			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Menu Layout', 'wolf-core' ),
				'param_name' => 'menu_layout',
				'default'    => '',
				'options'    => apply_filters(
					'wolf_core_theme_menu_layout',
					array(
						''                 => '&mdash; ' . esc_html__( 'Default', 'wolf-core' ) . ' &mdash;',
						'top-right'        => esc_html__( 'Top Right', 'wolf-core' ),
						'top-justify'      => esc_html__( 'Top Justify', 'wolf-core' ),
						'top-justify-left' => esc_html__( 'Top Justify Left', 'wolf-core' ),
						'centered-logo'    => esc_html__( 'Centered', 'wolf-core' ),
						'top-left'         => esc_html__( 'Top Left', 'wolf-core' ),
						'none'             => esc_html__( 'No Menu', 'wolf-core' ),
					)
				),
			),
			/* Menu Style */
			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Menu Style', 'wolf-core' ),
				'param_name' => 'menu_style',
				'default'    => '',
				'options'    => apply_filters(
					'wolf_core_theme_menu_syle',
					array(
						''                       => '&mdash; ' . esc_html__( 'Default', 'wolf-core' ) . ' &mdash;',
						'solid'                  => esc_html__( 'Solid', 'wolf-core' ),
						'semi-transparent-white' => esc_html__( 'Semi-transparent White', 'wolf-core' ),
						'semi-transparent-black' => esc_html__( 'Semi-transparent Black', 'wolf-core' ),
						'transparent'            => esc_html__( 'Transparent', 'wolf-core' ),
					)
				),
			),

			/* Menu Font Color */
			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Menu Font Tone', 'wolf-core' ),
				'param_name' => 'hero_font_tone',
				'default'    => '',
				'options'    => apply_filters(
					'wolf_core_theme_hero_font_tone',
					array(
						''      => '&mdash; ' . esc_html__( 'Default', 'wolf-core' ) . ' &mdash;',
						'light' => esc_html__( 'Light', 'wolf-core' ),
						'dark'  => esc_html__( 'Dark', 'wolf-core' ),
					)
				),
			),

			/* Header content block */
			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Header Content Block', 'wolf-core' ),
				'param_name' => 'after_header_block',
				'default'    => '',
				'options'    => $content_blocks,
			),

			/* Footer content block */
			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Footer Content Block', 'wolf-core' ),
				'param_name' => 'before_footer_block',
				'default'    => '',
				'options'    => $content_blocks,
			),
		)
	);

	if ( array() !== $post_meta ) {
		wolf_core_convert_params_to_elementor( $page, $post_meta );
	}
}
add_action( 'elementor/element/wp-page/document_settings/before_section_end', 'wolf_core_add_elementor_page_settings_controls' );
add_action( 'elementor/element/wp-post/document_settings/before_section_end', 'wolf_core_add_elementor_page_settings_controls' );
