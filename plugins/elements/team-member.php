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
 * Returns the element markup
 *
 * @param array $atts The element attributes.
 */
function wolf_core_team_member( $atts ) {

	$atts = apply_filters(
		'wolf_core_team_member_atts',
		wp_parse_args(
			$atts,
			array(
				'image_id'            => '',
				'img_size'            => 'medium',
				'custom_img_size'     => '',
				'layout'              => apply_filters( 'wolf_core_default_team_member_layout', 'standard' ),
				'alignment'           => '',
				'v_alignment'         => 'middle',
				'name'                => '',
				'title_tag'           => 'h3',
				'role'                => '',
				'tagline'             => '',
				'show_socials'        => '',
				'link'                => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	// Add social attributes.
	$wolf_core_team_member_socials = wolf_core_get_team_member_socials();
	$social_services               = array();

	foreach ( $wolf_core_team_member_socials as $social ) {

		if ( isset( $atts[ $social ] ) ) {
			$social_services[ $social ] = $atts[ $social ];
		}
	}

	if ( is_array( $image_id ) && isset( $image_id['id'] ) ) {
		$image_id = $image_id['id'];
	}

	$output = '';

	$class = $el_class; // init container CSS class.

	$text_style = '';
	$text_color = '';

	$class .= " wolf-core-team-member-container wolf-core-team-member-layout-$layout wolf-core-text-$alignment wolf-core-tm-valign-$v_alignment wolf-core-element";

	if ( 'custom' === $img_size ) {
		$img_size = $custom_img_size;
	}

	if ( wp_attachment_is_image( $image_id ) ) {

		$img = wolf_core_get_img_by_size(
			array(
				'attach_id'  => $image_id,
				'thumb_size' => $img_size,
			)
		);

		$img = $img['thumbnail'];
	} else {
		$output .= wolf_core_placeholder_img( $img_size );
	}

	$html_atts = wolf_core_render_html_attributes(
		array(
			'class' => wolf_core_sanitize_html_classes( $class ),
			'style' => wolf_core_esc_style_attr( $inline_style ),
		)
	);

	$output  = '<div ' . $html_atts;
	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<div class="wolf-core-team-member-inner">';

	if ( $img ) {
		$output .= '<div class="wolf-core-team-member-image">';

		if ( is_array( $link ) && isset( $link['url'] ) ) {
			$output .= '<a class="wolf-core-team-member-link" rel="' . esc_attr( $link['rel'] ) . '"';
			$output .= ' target="' . esc_attr( $link['target'] ) . '"';
			$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '"></a>';
		}

		$output .= $img;

		$output .= apply_filters( 'wolf_core_team_member_image_end', '', $atts );

		$output .= '</div><!--.wolf-core-team-member-image-->';
	}

	$output .= '<div class="wolf-core-team-member-caption-container">';

	$output .= '<div class="wolf-core-team-member-caption">';

	$headings_array = array( 'h2', 'h3', 'h4', 'h5', 'h6' );
	$title_tag      = ( in_array( $title_tag, $headings_array, true ) ) ? $title_tag : 'h3';

	if ( $name ) {
		$output .= "<$title_tag class='wolf-core-team-member-name' style='" . wolf_core_esc_style_attr( $text_style ) . "'>";
		$output .= "<span>$name</span>";
		$output .= "</$title_tag>";
	}

	if ( $role ) {
		$output .= '<span class="wolf-core-team-member-role"';
		if ( $text_color ) {
			$output .= ' style="color:' . $text_color . '"';
		}

		$output .= '>' . $role . '</span>';
	}

	if ( $tagline ) {

		$output .= '<span class="wolf-core-team-member-tagline"';
		if ( $text_color ) {
			$output .= ' style="color:' . $text_color . '"';
		}

		$output .= '><p>' . $tagline . '</p></span>';
	}

	if ( is_array( $link ) && isset( $link['url'] ) ) {
		$output .= '</a>';
	}

	if ( ! empty( $show_socials ) && array() !== $social_services ) {
		$output .= '<div class="wolf-core-team-member-social-container">';

		$wolf_core_socials_args             = apply_filters( 'wolf_core_team_member_socials_args', array() );
		$wolf_core_socials_args['services'] = $social_services;

		$output .= wolf_core_social_icons( $wolf_core_socials_args );

		$output .= '</div><!--.wolf-core-team-member-social-container-->';
	}

	$output .= '</div><!--.wolf-core-team-member-caption-->';

	$output .= '</div><!--.wolf-core-team-member-caption-container-->';

	$output .= '</div><!--.wolf-core-team-member-inner-->';

	$output .= '</div><!--.wolf-core-team-member-container-->';

	return $output;
}
