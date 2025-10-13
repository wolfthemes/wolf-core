<?php
/**
 * Wolf Core VC custom fields functions
 *
 * Set default setttings values for in-built elements
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Numeric Slider
 *
 * @param array  $settings
 * @param string $value
 */
function wolf_core_numeric_slider_settings_field( $settings, $value ) {
	ob_start();
	$name = $settings['param_name'];
	$type = $settings['type'];
	// wp_enqueue_script( 'wvc-numeric-slider' );
	?>
	<div class="wolf_core_numeric_slider">
		<input name="<?php echo esc_attr( $settings['param_name'] ); ?>" class="wpb_vc_param_value wpb-textinput <?php echo esc_attr( $settings['param_name'] ); ?> <?php echo esc_attr( $settings['type'] ); ?>" type="hidden" value="<?php echo $value; ?>"/>
				<span class="numeric-slider-helper-input"><?php echo esc_attr( $value ); ?></span>
				<div class="wolf-core-numeric-slider <?php echo esc_attr( $settings['param_name'] ); ?>"
				data-value="<?php echo esc_attr( $value ); ?>"
				data-min="<?php echo esc_attr( $settings['min'] ); ?>"
				data-max="<?php echo esc_attr( $settings['max'] ); ?>"
				data-step="<?php echo esc_attr( $settings['step'] ); ?>"></div>
	</div><!-- .wolf_core_numeric_slider -->
	<?php
	return ob_get_clean();
}
vc_add_shortcode_param(
	'wolf_core_numeric_slider',
	'wolf_core_numeric_slider_settings_field',
	WOLF_CORE_JS . '/admin/numeric-slider.js'
);

/**
 * Font family field
 *
 * Allow to choose a font from the font loader option
 *
 * @param array  $settings
 * @param string $value
 */
function wolf_core_font_family_settings_field( $settings, $value ) {
	ob_start();
	$name          = $settings['param_name'];
	$type          = $settings['type'];
	$fonts         = apply_filters( 'wolf_core_fonts', wolf_core_get_google_fonts_options() );
	$default_style = ( $value ) ? 'font-family:' . $value . ';' : '';
	?>
	<div class="wolf_core_font_family">
		<select class="wvc-font-family-select wpb_vc_param_value wpb-input wpb-select <?php echo esc_attr( $type ); ?>_field" name="<?php echo esc_attr( $name ); ?>">
			<option value=""><?php esc_html_e( 'Default', 'wolf-core' ); ?></option>
			<?php foreach ( $fonts as $name => $font ) : ?>
				<option value="<?php echo esc_attr( $name ); ?>" <?php echo selected( $name, $value ); ?>><?php echo sanitize_text_field( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<div class="wvc-font-family-preview" style="<?php echo wolf_core_esc_style_attr( $default_style ); ?>"><?php echo esc_html_x( 'And there was silence over the oceans. When a voice came thundering from above.', 'placeholder text', 'wolf-core' ); ?></div>
	</div>
	<?php
	return ob_get_clean();
}
vc_add_shortcode_param( 'wolf_core_font_family', 'wolf_core_font_family_settings_field' );

/**
 * Help text
 *
 * A to display helper text or additional description
 *
 * @param array  $settings
 * @param string $value
 */
function wolf_core_help_settings_field( $settings, $value ) {
	return '<div class="wolf_core_help_block"><span class="vc_description vc_clearfix">'
	. $settings['value'] .
	'</span></div>'; // This is html markup that will be outputted in content elements edit form
}
vc_add_shortcode_param( 'wolf_core_help', 'wolf_core_help_settings_field' );

/**
 * Custom text field
 *
 * A simple text field with placeholder
 *
 * @param array  $settings
 * @param string $value
 */
function wolf_core_textfield_settings_field( $settings, $value ) {
	return '<div class="wolf_core_textfield_block">'
	. '<input placeholder="' . esc_attr( $settings['placeholder'] ) . '" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
	esc_attr( $settings['param_name'] ) . ' ' .
	esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
	'</div>'; // This is html markup that will be outputted in content elements edit form
}
vc_add_shortcode_param( 'wolf_core_textfield', 'wolf_core_textfield_settings_field' );

/**
 * Custom text field HTML editor
 *
 * A simple text field with placeholder
 *
 * @param array  $settings
 * @param string $value
 */
function wolf_core_textarea_html_settings_field( $settings, $value ) {
	// return '<div class="wolf_core_textarea_html_block">'
	// .'<input placeholder="' . esc_attr( $settings['placeholder'] ) . '" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
	// esc_attr( $settings['param_name'] ) . ' ' .
	// esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
	// '</div>'; // This is html markup that will be outputted in content elements edit form

	$settings = array(
		'editor_height'    => 180,
		'drag_drop_upload' => false,
		'wpautop'          => false,
		'textarea_name'    => esc_attr( $settings['param_name'] ),
		'media_buttons'    => false,
	);

	$value     = 'test';
	$editor_id = 'editorcontent'; // must the same ID as the param name.

	ob_start();

	// add_filter( 'wp_default_editor', function() {
	// return 'tinymce';
	// } );

	wp_editor( $value, $editor_id, $settings );
	?>
	<script>tinymce.execCommand( 'mceAddEditor', true, <?php echo esc_attr( $editor_id ); ?> );</script>
	<?php

	return ob_get_clean();
}
// vc_add_shortcode_param( 'wolf_core_textarea_html', 'wolf_core_textarea_html_settings_field' );

/**
 * Custom text field
 *
 * A simple text field with placeholder
 *
 * @param array  $settings
 * @param string $value
 */
function wolf_core_int_textfield_settings_field( $settings, $value ) {

	$value = ( $value ) ? absint( $value ) : '';
	return '<div class="wolf_core_textfield_block">'
	. '<input placeholder="' . esc_attr( $settings['placeholder'] ) . '" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
	esc_attr( $settings['param_name'] ) . ' ' .
	esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
	'</div>'; // This is html markup that will be outputted in content elements edit form.
}
vc_add_shortcode_param( 'wolf_core_int_textfield', 'wolf_core_int_textfield_settings_field' );

/**
 * Video URL field
 *
 * A simple text field with a link to add an URL from the media library
 *
 * @param array  $settings
 * @param string $value
 */
function wolf_core_video_url_textfield_settings_field( $settings, $value ) {
	return '<div class="wolf_core_video_url">'
		. '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
		'<a href="#" style="display:inline-block;margin-top:4px;" class="wvc-set-video-file">' . esc_html__( 'Media Library', 'wolf-core' ) . '</a></div>'; // This is html markup that will be outputted in content elements edit form
}
vc_add_shortcode_param( 'wolf_core_video_url', 'wolf_core_video_url_textfield_settings_field' );

/**
 * Audio URL field
 *
 * A simple text field with a link to add an URL from the media library
 *
 * @param array  $settings
 * @param string $value
 */
function wolf_core_audio_url_textfield_settings_field( $settings, $value ) {
	return '<div class="wolf_core_audio_url">'
		. '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
		'<a href="#" style="display:inline-block;margin-top:4px;" class="wvc-set-audio-file">' . esc_html__( 'Media Library', 'wolf-core' ) . '</a></div>';
}
vc_add_shortcode_param( 'wolf_core_audio_url', 'wolf_core_audio_url_textfield_settings_field' );

/**
 * Create multi dropdown param type
 *
 * @param [type] $param
 * @param [type] $value
 * @return void
 */
function wolf_core_dropdown_multi_settings_field( $param, $value ) {

	$param_line = '';

	$param_line .= '<select multiple name="' . esc_attr( $param['param_name'] ) . '" class="wpb_vc_param_value wpb-input wpb-select-multi ' . esc_attr( $param['param_name'] ) . ' ' . esc_attr( $param['type'] ) . '">';

	foreach ( $param['value'] as $text_val => $val ) {
		if ( is_numeric( $text_val ) && ( is_string( $val ) || is_numeric( $val ) ) ) {
			$text_val = $val;
		}
			$text_val = esc_html__( $text_val, 'wolf-core' );
			$selected = '';

		if ( ! is_array( $value ) ) {
			$param_value_arr = explode( ',', $value );
		} else {
			$param_value_arr = $value;
		}

		if ( $value !== '' && in_array( $val, $param_value_arr ) ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option class="' . esc_attr( $text_val ) . '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
	}
	$param_line .= '</select>';

	return $param_line;
}
vc_add_shortcode_param( 'wolf_core_dropdown_multi', 'wolf_core_dropdown_multi_settings_field' );
