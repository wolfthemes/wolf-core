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
				'size'                      => '',
				'hover_effect'              => 'opacity',
				'css_animation'             => '',
				'css_animation_delay'       => '',
				'css_animation_each'        => '',
				'el_class'                  => '',
				'hide_class'                => '',
				'css'                       => '',
				'inline_style'              => '',
				'add_spotify_follow_button' => '',
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

	$target = ( $target ) ? $target : '_blank';

	/*Animate */
	if ( $css_animation_each ) {
		if ( ! wolf_core_is_new_animation( $css_animation ) ) {
			$icon_box_class .= wolf_core_get_css_animation( $css_animation );
		}
	} else {
		if ( ! wolf_core_is_new_animation( $css_animation ) ) {
			$class .= wolf_core_get_css_animation( $css_animation );
		}
	}

	$class                .= " wolf-core-socials-container wolf-core-si-size-$size wolf-core-align-$alignment wolf-core-si-direction-$direction wolf-core-element";
	$icon_box_class       .= " wolf-core-social-icon wolf-core-icon-box wolf-core-icon-background-style-$background_style wolf-core-icon-hover-$hover_effect";
	$icon_container_class .= " wolf-core-icon-background-color-$background_color";
	$icon_container_class .= ' wolf-core-icon-container ' . $size;

	if ( 'normal' !== $background_style ) {
		$icon_container_class .= ' fa-stack';
	}

	$output = '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

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
		$color       = $custom_color;
		$icon_style .= 'color:' . wolf_core_sanitize_color( $color ) . ';';
	}

	/* Background color */
	if ( 'custom' === $background_color ) {
		$background_color      = $custom_background_color;
		$bg_color              = wolf_core_sanitize_color( $background_color );
		$icon_container_style .= "background-color:$bg_color;border-color:$bg_color;box-shadow-color:$bg_color;";
		$icon_filler_style    .= "background-color:$bg_color;box-shadow-color:$bg_color;";
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

	$wolf_icon_array  = array( 'bandsintown', 'evernote', 'grooveshark', 'mailchimp' );
	$wolf_icon2_array = array( 'tiktok' );
	$socicon_array    = array(
		'8tracks',
		'airbnb',
		'alliance',
		'amplement',
		'appnet',
		// 'bandcamp',
		'baidu',
		'battlenet',
		'beam',
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
		'facebook',
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
		'itunes',
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
		'youtube',
		'zapier',
		'zerply',
		'zomato',
		'zynga',
	);

	$fab_array = array( 'tiktok' );

	if ( function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
		vc_icon_element_fonts_enqueue( 'fontawesome' );

		if ( array_intersect( $services, $wolf_icon_array ) || array_intersect( array_keys( $services ), $wolf_icon_array ) ) {
			vc_icon_element_fonts_enqueue( 'wolficons' );
		}

		if ( array_intersect( $services, $wolf_icon2_array ) || array_intersect( array_keys( $services ), $wolf_icon2_array ) ) {
			vc_icon_element_fonts_enqueue( 'wolficons' );
		}

		if ( array_intersect( $services, $socicon_array ) || array_intersect( array_keys( $services ), $socicon_array ) ) {
			vc_icon_element_fonts_enqueue( 'socicon' );
		}
	}

	$single_animation_delay = ( $css_animation_delay ) ? $css_animation_delay : 0;

	if ( $is_list ) {

		foreach ( $services as $service ) {

			if ( in_array( $service, $wolf_core_socials, true ) ) {

				$icon_box_style = 'animation-delay:' . absint( $single_animation_delay ) . 'ms;';

				$single_animation_delay = $single_animation_delay + 200;

				$link = wolf_core_get_option( 'socials', $service );

				if ( in_array( $service, $wolf_icon_array, true ) ) {
					$prefix = 'wolficon';

				} elseif ( in_array( $service, $wolf_icon2_array, true ) ) {
					$prefix = 'wolficon2';

				} elseif ( in_array( $service, $socicon_array, true ) ) {
					$prefix = 'socicon';

				} else {
					$prefix = 'fa';
				}

				$icon = "$prefix-$service";

				if ( 'email' === $service ) {
					$link = 'mailto:' . wolf_core_get_option( 'socials', $service );
					$icon = 'fa-envelope-o';
				}

				$output .= '<div class="' . wolf_core_sanitize_html_classes( $icon_box_class ) . '"  style="' . wolf_core_esc_style_attr( $icon_box_style ) . '"';

				if ( $css_animation_each ) {
					$atts['css_animation_delay'] = $single_animation_delay;
					$output                     .= wolf_core_element_aos_animation_data_attr( $atts );
				}

				$output .= '>';

				$output .= '<div class="' . wolf_core_sanitize_html_classes( $icon_container_class ) . '" style="' . wolf_core_esc_style_attr( $icon_container_style ) . '"><div class="wolf-core-icon-background-fill ' . wolf_core_esc_style_attr( $icon_filler_style ) . '"></div>';

				if ( 'none' === $background_style ) {

					$output .= '<i style="' . wolf_core_esc_style_attr( $icon_style ) . '" class="wolf-core-icon-color-' . $color . ' wolf-core-icon fa ' . esc_attr( $icon ) . '"><a title="' . esc_attr( $service ) . '" class="wolf-core-social-icon-link" target="' . esc_attr( $target ) . '"';

					if ( '_blank' === $target && $rel ) {
						$output .= ' rel="noreferrer, noopener"';
					}

					$output .= ' href="' . esc_url( $link ) . '"></a></i>';

				} else {

					$output .= '<i style="' . wolf_core_esc_style_attr( $icon_style ) . '" class="wolf-core-icon-color-' . $color . ' wolf-core-icon fa ' . esc_attr( $icon ) . ' fa-stack-1x"><a title="' . esc_attr( $service ) . '" class="wolf-core-social-icon-link" target="' . esc_attr( $target ) . '"';

					if ( '_blank' === $target && $rel ) {
						$output .= ' rel="noreferrer, noopener"';
					}

					$output .= ' href="' . esc_url( $link ) . '"></a></i>';
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

			$icon_box_style         = 'animation-delay:' . absint( $single_animation_delay ) . 'ms;';
			$single_animation_delay = $single_animation_delay + 100;

			if ( in_array( $service, $wolf_icon_array ) ) {
				$prefix = 'wolficon';
			} elseif ( in_array( $service, $wolf_icon2_array ) ) {
				$prefix = 'wolficon2';
			} elseif ( in_array( $service, $socicon_array ) ) {
				$prefix = 'socicon';
			} else {
				$prefix = 'fa';
			}

			$icon = "$prefix-$service";

			if ( 'email' === $service ) {
				$link = 'mailto:' . $link;
				$icon = 'fa-envelope-o';
			}

			$output .= '<div class="' . wolf_core_sanitize_html_classes( $icon_box_class ) . '"  style="' . wolf_core_esc_style_attr( $icon_box_style ) . '">';
			$output .= '<div class="' . wolf_core_sanitize_html_classes( $icon_container_class ) . '" style="' . wolf_core_esc_style_attr( $icon_container_style ) . '"><div class="wolf-core-icon-background-fill ' . wolf_core_esc_style_attr( $icon_filler_style ) . '"></div>';

			if ( 'none' === $background_style ) {

				$output .= '<i style="' . wolf_core_esc_style_attr( $icon_style ) . '" class="wolf-core-icon-color-' . $color . ' wolf-core-icon fa ' . esc_attr( $icon ) . '"><a title="' . esc_attr( $service ) . '" target="' . esc_attr( $target ) . '"';

				if ( '_blank' === $target && $rel ) {
					$output .= ' rel="noreferrer, noopener"';
				}

				$output .= ' href="' . esc_url( $link ) . '"></a></i>';

			} else {

				$output .= '<i style="' . wolf_core_esc_style_attr( $icon_style ) . '" class="wolf-core-icon-color-' . $color . ' wolf-core-icon fa ' . esc_attr( $icon ) . ' fa-stack-1x"><a title="' . esc_attr( $service ) . '" target="' . esc_attr( $target ) . '"';

				if ( '_blank' === $target && $rel ) {
					$output .= ' rel="noreferrer, noopener"';
				}

				$output .= ' href="' . $link . '"></a></i>';
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
