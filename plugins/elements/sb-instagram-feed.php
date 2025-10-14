<?php
/**
 * Smash Ballon Instagram Feed Container
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the SB Instagram Feed markup
 *
 * @param array $atts The SB Instagram Feed attributes.
 */
function wolf_core_sb_instagram_feed( $atts ) {

	$atts = apply_filters(
		'wolf_core_sb_instagram_feed_atts',
		wp_parse_args(
			$atts,
			array(
				// 'feed'                  => 1,
				'num'                   => 18,
				'cols'                  => 6,
				'username'              => '',
				'accesstoken'           => '',
				'imagepadding'          => '',
				'showheader'            => 'false',
				'showbio'               => 'false',
				'showbutton'            => 'false',
				'showfollow'            => 'false',

				'follow_button'         => '',
				'button_text'           => '',

				'disable_default_hover' => '',

				'el_class'              => '',
				'css'                   => '',
				'inline_style'          => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$inline_atts = '';

	$class = $el_class; // init container CSS class.

	$class .= " wolf-core-i-follow_button-$follow_button wolf-core-wolf-gram-shortcode-container wolf-core-sbif-disable-hover-$disable_default_hover wolf-core-element";

	$output = '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '">';

	if ( $follow_button ) {

		$button_text = ( ! $button_text ) ? sprintf( esc_html__( 'Instagram @%s', 'wolf-visual-composer' ), $username ) : $button_text;

		$button_link = 'https://instagram.com/' . $username;
		$button_text = apply_filters( 'wolf_gram_button_text', $button_text );
		$button_link = apply_filters( 'wolf_gram_button_link', $button_link );

		ob_start();
		?>
		<a class="wolf-gram-follow-button" href="<?php echo esc_url( $button_link ); ?>" target="_blank">
			<?php echo esc_attr( $button_text ); ?>
		</a>
		<?php
		$output .= ob_get_clean();
	}

	foreach ( $atts as $key => $value ) {

		if ( ! is_string( $key ) || ! is_string( $value ) ) {
			continue;
		}

		if ( 'showheader' === $key ) {
			if ( '' === $value ) {
				$value = 'false';
			}
		}

		if ( 'showbio' === $key ) {
			if ( '' === $value ) {
				$value = 'false';
			}
		}

		if ( 'showbutton' === $key ) {
			if ( '' === $value ) {
				$value = 'false';
			}
		}

		if ( 'showfollow' === $key ) {
			if ( '' === $value ) {
				$value = 'false';
			}
		}

		if ( $value ) {
			$inline_atts .= ' ' . $key . '="' . $value . '"';
		}
	}

	$output .= apply_filters( 'wolf_core_sb_instagram_feed_shortcode', do_shortcode( '[instagram-feed ' . $inline_atts . ']' ), $atts );

	$output .= '</div><!-- .wolf-core-sb-instagram-feed-shortcode-container -->';

	return $output;
}

if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
	add_shortcode( 'wolf_core_sb_instagram_feed', 'wolf_core_sb_instagram_feed' );
}
