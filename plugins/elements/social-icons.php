<?php
/**
 * Social Icons
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
function wolf_core_social_icons( $atts ) {

	$atts = apply_filters(
		'wolf_core_social_icons_atts',
		wp_parse_args(
			$atts,
			array(
				'services'                  => '',
				'target'                    => '_blank',
				'rel'                       => '',
				'alignment'                 => 'center',
				'direction'                 => 'horizontal',
				'color'                     => 'default',
				'custom_color'              => '',
				'background_style'          => 'none',
				'background_color'          => '',
				'custom_background_color'   => '',
				'size'                      => 'fa-1x',
				'hover_effect'              => 'opacity',
				'acronym'                   => '',
				'css_animation'             => '',
				'css_animation_delay'       => '',
				'css_animation_each'        => '',
				'el_class'                  => '',
				'hide_class'                => '',
				'css'                       => '',
				'inline_style'              => '',
				'add_spotify_follow_button' => '',
				'data_attrs'                => apply_filters( 'wolf_core_social_icons_data_attrs', array() ),
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class                = $el_class; // init container CSS class.
	$icon_class           = '';
	$icon_style           = '';
	$icon_box_class       = '';
	$icon_box_style       = '';
	$icon_container_style = '';
	$icon_container_class = '';
	$icon_filler_style    = '';
	$fa                   = 'fa';

	$target = ( $target ) ? $target : '_blank';

	/*Animate */
	if ( $css_animation_each ) {
		if ( ! wolf_core_is_new_animation( $css_animation ) ) {
			$icon_box_class .= wolf_core_get_css_animation( $css_animation );
		}
	} elseif ( ! wolf_core_is_new_animation( $css_animation ) ) {
			$class .= wolf_core_get_css_animation( $css_animation );
	}

	if ( 'yes' === $acronym ) {
		$background_style = 'none';
	}

	$class                .= " wolf-core-socials-container wolf-core-si-size-$size wolf-core-align-$alignment wolf-core-si-direction-$direction wolf-core-si-acronym-$acronym wolf-core-element";
	$icon_box_class       .= " wolf-core-social-icon wolf-core-icon-box wolf-core-icon-background-style-$background_style wolf-core-icon-hover-$hover_effect";
	$icon_container_class .= " wolf-core-icon-background-color-$background_color";
	$icon_container_class .= ' wolf-core-icon-container ' . $size;

	if ( 'normal' !== $background_style ) {
		$icon_container_class .= ' fa-stack';
	}

	$data_attr = '';

	foreach ( $data_attrs as $k => $v ) {
		$data_attr .= 'data-' . $k . '="' . $v . '"';
	}

	$output = '<div ' . $data_attr . '  class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	if ( ! $css_animation_each ) {
		$output .= wolf_core_element_aos_animation_data_attr( $atts );
	}

	$output .= '>';

	$background_style = ( $background_style ) ? $background_style : 'none';

	if ( 'none' !== $background_style ) {
		$icon_color = 'default';
	}

	if ( 'none' === $background_style ) {
		$hover_effect = 'none';
	}

	/* Icon color */
	if ( 'custom' === $color ) {
		$color = $custom_color;

		if ( $color ) {
			$icon_style .= 'color:' . wolf_core_sanitize_color( $color ) . ';';
		}
	}

	/* Background color */
	if ( 'custom' === $background_color ) {
		$background_color = $custom_background_color;
		$bg_color         = wolf_core_sanitize_color( $background_color );
		if ( $bg_color ) {
			$icon_container_style .= "background-color:$bg_color;border-color:$bg_color;box-shadow-color:$bg_color;";
			$icon_filler_style    .= "background-color:$bg_color;box-shadow-color:$bg_color;";
		}
	}

	$wolf_core_socials = wolf_core_get_socials();

	$is_list = true;

	if ( '' === $services ) {

		$services = $wolf_core_socials;

	} elseif ( ! is_array( $services ) ) {

		$services = wolf_core_list_to_array( $services );
	} else {
		$is_list = false;
	}

	$wolf_icon_array = array( 'bandsintown', 'evernote', 'grooveshark', 'mailchimp' );
	$socicon_array   = array(
		'8tracks',
		'airbnb',
		'alliance',
		'amplement',
		'appnet',
		// 'bandcamp',
		'baidu',
		'battlenet',
		'beam',
		'beatport',
		'bebee',
		'blizzard',
		'buffer',
		'coderwall',
		'curse',
		'dailymotion',
		'deezer',
		'diablo',
		'discord',
		'disqus',
		'douban',
		'draugiem',
		'endomondo',
		'filmweb',
		'envato',
		'etsy',
		// 'facebook',
		'flattr',
		'forrst',
		'friendfeed',
		'goodreads',
		'formulr',
		'googlegroups',
		'hackerrank',
		'hearthstone',
		'hellocoton',
		'heroes',
		'hitbox',
		'horde',
		'houzz',
		'icq',
		'identica',
		'instagram',
		// 'imdb',
		'issuu',
		'istock',
		// 'itunes',
		'keybase',
		'lanyrd',
		'line',
		'livejournal',
		'lyft',
		'macos',
		'medium',
		'meetup',
		'messenger',
		'modelmayhem',
		'mumble',
		'newsvine',
		'nintendo',
		'npm',
		'odnoklassniki',
		'openid',
		'overwatch',
		'patreon',
		'periscope',
		'persona',
		'player',
		'raidcall',
		'ravelry',
		'researchgate',
		'residentadvisor',
		'reverbnation',
		'smugmug',
		'songkick',
		'starcraft',
		'stayfriends',
		'storehouse',
		'strava',
		'streamjar',
		'swarm',
		'teamspeak',
		'teamviewer',
		'technorati',
		'telegram',
		'tidal',
		'twitch',
		'tripit',
		'triplej',
		'uber',
		'ventrilo',
		'viber',
		'viewbug',
		'warcraft',
		'wykop',
		'yammer',
		'yandex',
		'yelp',
		'younow',
		// 'youtube',
		'zapier',
		'zerply',
		'zomato',
		'zynga',
	);

	$fab_array = array(
		'apple',
		'bandcamp',
		'codepen',
		'dribbble',
		'facebook',
		'flickr',
		'instagram',
		'linkedin',
		// 'messenger',
		'spotify',
		'tiktok',
		'twitter',
		'x',
		'vimeo',
		'vk',
		'youtube',
	);

	$social_services_acronym = apply_filters(
		'wolf_core_social_icon_acronyms',
		array(
			'apple'       => 'ap',
			'facebook'    => 'fb',
			'twitter'     => 'x',
			'x'           => 'x',
			'instagram'   => 'in',
			'tiktok'      => 'tk',
			'linkedin'    => 'li',
			'behance'     => 'be',
			'youtube'     => 'yt',
			'vimeo'       => 'vi',
			'pinterest'   => 'pn',
			'dribbble'    => 'dr',
			'spotify'     => 'sp',
			'de'          => 'de',
			'bandcamp'    => 'bc',
			'bandsintown' => 'bt',
			'github'      => 'gh',
			'vk'          => 'vk',
			'envato'      => 'en',
			'messenger'   => 'mg',
			'flickr'      => 'fl',
			'codepen'     => 'co',
			'telegram'    => 'tl',
			'tumblr'      => 'tb',
			'email'       => 'em',
		)
	);

	if ( function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
		vc_icon_element_fonts_enqueue( 'fontawesome' );

		if ( array_intersect( $services, $wolf_icon_array ) || array_intersect( array_keys( $services ), $wolf_icon_array ) ) {
			vc_icon_element_fonts_enqueue( 'wolficons' );
		}

		if ( array_intersect( $services, $socicon_array ) || array_intersect( array_keys( $services ), $socicon_array ) ) {
			vc_icon_element_fonts_enqueue( 'socicon' );
		}
	} else {
		wp_enqueue_style( 'font-awesome' );

		if ( array_intersect( $services, $wolf_icon_array ) || array_intersect( array_keys( $services ), $wolf_icon_array ) ) {
			wp_enqueue_style( 'wolficons' );
		}

		if ( array_intersect( $services, $socicon_array ) || array_intersect( array_keys( $services ), $socicon_array ) ) {
			wp_enqueue_style( 'socicon' );
		}
	}

	$single_animation_delay = ( $css_animation_delay ) ? $css_animation_delay : 0;

	if ( $is_list ) {

		foreach ( $services as $service ) {

			$fa = 'fab';

			if ( in_array( $service, $wolf_core_socials, true ) ) {

				$icon_box_style = 'animation-delay:' . absint( $single_animation_delay ) . 'ms;';

				$single_animation_delay = $single_animation_delay + 200;

				$link = wolf_core_get_option( 'socials', $service );

				if ( in_array( $service, $wolf_icon_array, true ) ) {
					$prefix = 'wolficon';

				} elseif ( in_array( $service, $socicon_array, true ) ) {
					$prefix = 'socicon';

				} else {
					$prefix = 'fa';
				}

				if ( in_array( $service, $fab_array, true ) ) {
					$fa = 'fab';
				}

				$icon = "$prefix-$service";

				if ( 'email' === $service ) {
					$link = 'mailto:' . wolf_core_get_option( 'socials', $service );
					$icon = 'fa fa-envelope-o';
				}

				$output .= '<div class="' . wolf_core_sanitize_html_classes( $icon_box_class ) . '"  style="' . wolf_core_esc_style_attr( $icon_box_style ) . '"';

				if ( $css_animation_each ) {
					$force                       = ( 'elementor' === wolf_core_get_plugin_in_use() ) ? true : false;
					$atts['css_animation_delay'] = $single_animation_delay;
					$output                     .= wolf_core_element_aos_animation_data_attr( $atts, $force );
				}

				$output .= '>';

				$output .= '<div class="' . wolf_core_sanitize_html_classes( $icon_container_class ) . '" style="' . wolf_core_esc_style_attr( $icon_container_style ) . '"><div class="wolf-core-icon-background-fill ' . wolf_core_esc_style_attr( $icon_filler_style ) . '"></div>';

				if ( 'yes' === $acronym && isset( $social_services_acronym[ $service ] ) ) {

					$output .= '<a title="' . esc_attr( $service ) . '" class="wolf-core-social-acronym-link" target="' . esc_attr( $target ) . '"';

					if ( '_blank' === $target && $rel ) {
						$output .= ' rel="noreferrer, noopener"';
					}

					$output .= ' href="' . esc_url( (string) $link ) . '">';

					$output .= $social_services_acronym[ $service ];

					$output .= '</a>';

				} elseif ( 'none' === $background_style ) {

						$output .= '<i style="' . wolf_core_esc_style_attr( $icon_style ) . '" class="wolf-core-icon-color-' . $color . ' wolf-core-icon ' . $fa . ' ' . esc_attr( $icon ) . '"><a title="' . esc_attr( $service ) . '" class="wolf-core-social-icon-link" target="' . esc_attr( $target ) . '"';

					if ( '_blank' === $target && $rel ) {
						$output .= ' rel="noreferrer, noopener"';
					}

						$output .= ' href="' . esc_url( (string) $link ) . '"></a></i>';

				} else {

					$output .= '<i style="' . wolf_core_esc_style_attr( $icon_style ) . '" class="wolf-core-icon-color-' . $color . ' wolf-core-icon ' . $fa . ' ' . esc_attr( $icon ) . ' fa-stack-1x"><a title="' . esc_attr( $service ) . '" class="wolf-core-social-icon-link" target="' . esc_attr( $target ) . '"';

					if ( '_blank' === $target && $rel ) {
						$output .= ' rel="noreferrer, noopener"';
					}

					$output .= ' href="' . esc_url( (string) $link ) . '"></a></i>';
				}

				$output .= '</div>'; // end icon container.
				$output .= '</div>'; // end icon box.
			}
		}
	} else {
		foreach ( $services as $service => $link ) {

			if ( '' === $link ) {
				continue;
			}

			$fa = 'fa';

			$icon_box_style         = 'animation-delay:' . absint( $single_animation_delay ) . 'ms;';
			$single_animation_delay = $single_animation_delay + 100;

			if ( in_array( $service, $wolf_icon_array, true ) ) {
				$prefix = 'wolficon';
			} elseif ( in_array( $service, $socicon_array, true ) ) {
				$prefix = 'socicon';

			} else {
				$prefix = 'fa';
			}

			if ( in_array( $service, $fab_array, true ) ) {
				$fa = 'fab';
			}

			$icon = "$prefix-$service";

			if ( 'email' === $service ) {
				$link = 'mailto:' . $link;
				$icon = 'fa-envelope-o';
			}

			$output .= '<div class="' . wolf_core_sanitize_html_classes( $icon_box_class ) . '"  style="' . wolf_core_esc_style_attr( $icon_box_style ) . '">';
			$output .= '<div class="' . wolf_core_sanitize_html_classes( $icon_container_class ) . '" style="' . wolf_core_esc_style_attr( $icon_container_style ) . '"><div class="wolf-core-icon-background-fill" style="' . wolf_core_esc_style_attr( $icon_filler_style ) . '"></div>';

			if ( 'yes' === $acronym && isset( $social_services_acronym[ $service ] ) ) {

					$output .= '<a title="' . esc_attr( $service ) . '" class="wolf-core-social-acronym-link" target="' . esc_attr( $target ) . '"';

				if ( '_blank' === $target && $rel ) {
					$output .= ' rel="noreferrer, noopener"';
				}

					$output .= ' href="' . esc_url( (string) $link ) . '">';

					$output .= $social_services_acronym[ $service ];

					$output .= '</a>';

			} elseif ( 'none' === $background_style ) {

					$output .= '<i style="' . wolf_core_esc_style_attr( $icon_style ) . '" class="wolf-core-icon-color-' . $color . ' wolf-core-icon ' . $fa . ' ' . esc_attr( $icon ) . '"><a title="' . esc_attr( $service ) . '" class="wolf-core-social-icon-link" target="' . esc_attr( $target ) . '"';

				if ( '_blank' === $target && $rel ) {
					$output .= ' rel="noreferrer, noopener"';
				}

					$output .= ' href="' . esc_url( (string) $link ) . '"></a></i>';

			} else {

				$output .= '<i style="' . wolf_core_esc_style_attr( $icon_style ) . '" class="wolf-core-icon-color-' . $color . ' wolf-core-icon ' . $fa . ' ' . esc_attr( $icon ) . ' fa-stack-1x"><a title="' . esc_attr( $service ) . '" class="wolf-core-social-icon-link" target="' . esc_attr( $target ) . '"';

				if ( '_blank' === $target && $rel ) {
					$output .= ' rel="noreferrer, noopener"';
				}

				$output .= ' href="' . esc_url( (string) $link ) . '"></a></i>';
			}

			$output .= '</div>'; // end icon container.

			$output .= '</div>'; // end icon box.
		}
	}

	// $output .= ob_start();
	$output .= apply_filters( 'wolf_core_social_icons_end', '', $atts );
	// $output .= ob_get_clean();

	$output .= '</div><!-- .wolf-core-socials-container -->';

	return $output;
}

if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
	add_shortcode( 'wolf_core_social_icons', 'wolf_core_social_icons' );
}
