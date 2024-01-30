<?php
/**
 * WPBakery Page Builder Extension Plugin Settings
 *
 * @author WolfThemes
 * @category Admin
 * @package WolfCore/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$social_fields = array();

$wolf_core_socials = wolf_core_get_socials();

// debug( $wolf_core_socials );

foreach ( $wolf_core_socials as $social ) {

	$no_http = array( 'skype', 'email' );

	if ( in_array( $social, $no_http ) ) {
		$type        = 'text';
		$placeholder = '';
	} else {
		$type        = 'url';
		$placeholder = 'http://';
	}

	$social_fields[] = array(
		'type'        => $type,
		'field_id'    => $social,
		'label'       => ucfirst( $social ) . ' URL',
		'placeholder' => $placeholder,
	);
}

$social_fields[] = array(
	'type'        => 'message',
	'field_id'    => 'social_message',
	'description' => sprintf( esc_html__( 'Need more social services? Send us an email! %s', 'wolf-core' ), 'contact@wolfthemes.com' ),
);

/**
 * Wolf Core Settings Panel
 */
$wolf_core_options = array(

	/*
	array(
		'title'         => esc_html__( 'Google Maps', 'wolf-core' ),
		'settings_id'   => 'wolf-core-google-map',
		'settings_slug' => 'google-map',
		'fields'        => array(
			array(
				'type'        => 'text',
				'field_id'    => 'google_maps_api_key',
				'label'       => esc_html__( 'Google Maps API key', 'wolf-core' ),
				'description' => sprintf(
					wp_kses_post( __( 'You can get a Google Maps API key <a href="%s" target="_blank">here</a>.', 'wolf-core' ) ),
					esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' )
				),
				'placeholder' => 'CIzaqsdMik5OYxo5hIZGvi6XhIQsvsOdUJQmm_beS8-us8',
			),
		),
	),*/

	array(
		'title'         => esc_html__( 'MailChimp', 'wolf-core' ),
		'settings_id'   => 'wolf-core-mailchimp',
		'settings_slug' => 'mailchimp',
		'fields'        => array(
			array(
				'type'        => 'text',
				'field_id'    => 'mailchimp_api_key',
				'label'       => esc_html__( 'MailChimp API key', 'wolf-core' ),
				'description' => sprintf(
					wp_kses_post( __( 'You can get a MailChimp API key <a href="%s" target="_blank">here</a>.', 'wolf-core' ) ),
					esc_url( 'http://kb.mailchimp.com/integrations/api-integrations/about-api-keys' )
				),
				'placeholder' => '565b514d72e6fd8875u04884069721c1-us6',
			),

			array(
				'type'        => 'text',
				'field_id'    => 'default_mailchimp_list_id',
				'label'       => esc_html__( 'Default MailChimp list ID', 'wolf-core' ),
				'description' => sprintf(
					wp_kses_post( __( '<a href="%s" target="_blank">Find Your List ID</a>.', 'wolf-core' ) ),
					esc_url( 'http://kb.mailchimp.com/lists/manage-contacts/find-your-list-id' )
				),
				'placeholder' => 'eg7ab65dc8',
			),

			array(
				'type'        => 'text',
				'field_id'    => 'label',
				'label'       => esc_html__( 'Newsletter form title', 'wolf-core' ),
				'placeholder' => esc_html__( 'Subscribe to our newsletter', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'subscribe_text',
				'label'       => esc_html__( '"Subscribe" button text', 'wolf-core' ),
				'placeholder' => esc_html__( 'Subscribe', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'placeholder_f_name',
				'label'       => esc_html__( 'Form first name input placeholder', 'wolf-core' ),
				'placeholder' => esc_html__( 'Your first name', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'placeholder_l_name',
				'label'       => esc_html__( 'Form last name input placeholder', 'wolf-core' ),
				'placeholder' => esc_html__( 'Your last name', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'placeholder',
				'label'       => esc_html__( 'Form email input placeholder', 'wolf-core' ),
				'placeholder' => esc_html__( 'Your email', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'thank_you_message',
				'label'       => esc_html__( 'Thank you message', 'wolf-core' ),
				'placeholder' => esc_html__( 'Thanks for subscribing', 'wolf-core' ),
			),

			/*
			array(
				'type'     => 'image',
				'field_id' => 'background',
				'label'    => esc_html__( 'Background image', 'wolf-core' ),
			),
			*/
		),
	),

	// Goggle fonts
	array(
		'title'         => esc_html__( 'Fonts Loader', 'wolf-core' ),
		'settings_id'   => 'wolf-core-fonts',
		'settings_slug' => 'fonts',
		'fields'        => array(
			array(
				'type'        => 'text',
				'field_id'    => 'google_fonts',
				'label'       => esc_html__( 'Google fonts', 'wolf-core' ),
				'placeholder' => 'Roboto:400,700|Lora:400,700',
				'description' => sprintf(
					__( 'You can get your fonts on the <a href="%s" target="_blank">Google Fonts</a> website.', 'wolf-core' ),
					'https://www.google.com/fonts'
				),
			),
		),
	),

	// Social profiles.
	array(
		'title'         => esc_html__( 'Social Profiles', 'wolf-core' ),
		'settings_id'   => 'wolf-core-socials',
		'settings_slug' => 'socials',
		'fields'        => $social_fields,
	),
);

if ( class_exists( 'Wolf_Vc_Content_Block' ) ) {

	$content_block_posts = get_posts( 'post_type="wolf_core_content_block"&numberposts=-1' );

	$content_blocks = array(
		'' => '&mdash; ' . esc_html__( 'Disabled', 'wolf-core' ) . ' &mdash;',
	);
	if ( $content_block_posts ) {
		foreach ( $content_block_posts as $content_block_options ) {
			$content_blocks[ $content_block_options->ID ] = $content_block_options->post_title;
		}
	} else {
		$content_blocks[0] = esc_html__( 'No Content Block Yet', 'wolf-core' );
	}

	$wolf_core_options[] = array(
		'title'         => esc_html__( 'Modal Window', 'wolf-core' ),
		'settings_id'   => 'wolf-core-modal-window',
		'parent_slug'   => 'themes.php',
		'settings_slug' => 'modal_window',
		'fields'        => array(
			array(
				'type'        => 'select',
				'field_id'    => 'content_block_id',
				'label'       => esc_html__( 'Modal Window Content', 'wolf-core' ),
				'choices'     => $content_blocks,
				'description' => sprintf(
					wp_kses_post( __( 'Choose a <a href="%s" target="_blank">content block</a> to display in your modal window.', 'wolf-core' ) ),
					esc_url( 'http://wlfthm.es/content-blocks' )
				),
			),

			array(
				'type'     => 'select',
				'field_id' => 'type',
				'label'    => esc_html__( 'Modal Window Type', 'wolf-core' ),
				'choices'  => array(
					'full'          => esc_html__( 'Standard', 'wolf-core' ),
					'non_intrusive' => esc_html__( 'Non-Intrusive (bottom right corner)', 'wolf-core' ),
				),
			),

			array(
				'type'     => 'checkbox',
				'field_id' => 'exclude_mc_subs',
				'label'    => esc_html__( 'Exclude MailChimp subscribers', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'delay',
				'label'       => esc_html__( 'Pop-up Delay', 'wolf-core' ),
				'placeholder' => 3,
				'description' => wp_kses_post( __( 'The time before the modal window pops up in seconds.<br>You can set a very high number to prevent the window to pop-up automatically if you want it to be open via a link (see the "info" section at the bottom of this page).', 'wolf-core' ) ),
			),

			array(
				'type'        => 'checkbox',
				'field_id'    => 'show_once',
				'label'       => esc_html__( 'Show Only Once', 'wolf-core' ),
				'description' => esc_html__( 'Don\'t show the pop-up again once it is closed. If this option is not checked, an opt-out link will be displayed below the window.', 'wolf-core' ),
			),

			array(
				'type'        => 'checkbox',
				'field_id'    => 'show_navigate_away',
				'label'       => esc_html__( 'Show When Navigates Away', 'wolf-core' ),
				'description' => esc_html__( 'The window will pop up only when the mouse leave the main window. The pop-up delay will still be applied.', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'cookie_time',
				'label'       => esc_html__( 'Cookie Persistency', 'wolf-core' ),
				'placeholder' => 1,
				'description' => esc_html__( 'How long the browser will remember the user opt-out action (in days).', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'content_width',
				'label'       => esc_html__( 'Modal Window Width', 'wolf-core' ),
				'placeholder' => '960px',
			),

			array(
				'type'        => 'text',
				'field_id'    => 'exclude_post_types',
				'label'       => esc_html__( 'Exclude Post Types', 'wolf-core' ),
				'placeholder' => 'post,page',
				'description' => esc_html__( 'The modal window will NOT popup in these specific post types. Separate each post type by a comma.', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'include_post_types',
				'label'       => esc_html__( 'Include Post Types', 'wolf-core' ),
				'placeholder' => 'post,page',
				'description' => esc_html__( 'The modal window will popup ONLY in these specific post types. Separate each post type by a comma.', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'exclude_ids',
				'label'       => esc_html__( 'Exclude Post IDs', 'wolf-core' ),
				'placeholder' => '654,897,123',
				'description' => esc_html__( 'The modal window will NOT popup in these specific posts. Separate each ID by a comma.', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'include_ids',
				'label'       => esc_html__( 'Include Post IDs', 'wolf-core' ),
				'placeholder' => '654,897,123',
				'description' => esc_html__( 'The modal window will popup ONLY in these specific posts. Separate each ID by a comma.', 'wolf-core' ),
			),

			array(
				'type'     => 'colorpicker',
				'field_id' => 'close_button_color',
				'label'    => esc_html__( 'Close Button Color', 'wolf-core' ),
			),

			array(
				'type'        => 'message',
				'field_id'    => 'info',
				'label'       => esc_html__( 'Info', 'wolf-core' ),
				'description' => sprintf(
					wp_kses_post( __( 'You can add the <strong>"%1$s"</strong> class to any link to use it as pop-up window "close" button.<br>Also add the <strong>"%2$s"</strong> class to use it as opt-out button. ("Don\'t show this message again" link)<br>Additionally, if you need a link that open the modal window, you can use the <strong>"%3$s"</strong> class.', 'wolf-core' ) ),
					'wolf-core-modal-window-close',
					'wolf-core-modal-window-opt-out',
					'wolf-core-modal-window-open'
				),
			),
		),
	);

	$page_option = array( '' => '&mdash; ' . esc_html__( 'Disabled', 'wolf-core' ) . ' &mdash;' );
	$pages       = get_pages();

	foreach ( $pages as $page ) {

		if ( get_post_field( 'post_parent', $page->ID ) ) {
			$page_option[ absint( $page->ID ) ] = '&nbsp;&nbsp;&nbsp; ' . sanitize_text_field( $page->post_title );
		} else {
			$page_option[ absint( $page->ID ) ] = sanitize_text_field( $page->post_title );
		}
	}

	$wolf_core_options[] = array(
		'title'         => esc_html__( 'Privacy Policy Message', 'wolf-core' ),
		'settings_id'   => 'wolf-core-privacy-policy-message',
		'settings_slug' => 'privacy_policy_message',
		'parent_slug'   => 'themes.php',
		'fields'        => array(

			array(
				'type'        => 'select',
				'field_id'    => 'status',
				'label'       => esc_html__( 'Status', 'wolf-core' ),
				'choices'     => array(
					''           => '&mdash; ' . esc_html__( 'Disabled', 'wolf-core' ) . ' &mdash;',
					'enabled'    => esc_html__( 'Enabled', 'wolf-core' ),
					'enabled_eu' => esc_html__( 'Enabled for EU users only', 'wolf-core' ),
				),
				'description' => sprintf( esc_html__( 'If the "Enabled for EU users only" is selected, %1$s must be activated and a %2$s License key must be set to enable localisation.', 'wolf-core' ), 'WooCommerce', 'MaxMind Geolocation' ),
			),

			array(
				'type'     => 'textarea',
				'field_id' => 'privacy_policy_message',
				'label'    => esc_html__( 'Privacy Policy Message', 'wolf-core' ),
			),

			array(
				'type'        => 'select',
				'field_id'    => 'privacy_policy_page',
				'label'       => esc_html__( 'Privacy Policy Page', 'wolf-core' ),
				'choices'     => $page_option,
				'description' => esc_html__( 'If a page is set, a link to the Privacy Policy Page will be displayed.', 'wolf-core' ),
			),

			array(
				'type'        => 'text',
				'field_id'    => 'link_text',
				'label'       => esc_html__( 'Link Text', 'wolf-core' ),
				'placeholder' => esc_html__( 'Read more', 'wolf-core' ),
			),

			array(
				'type'     => 'colorpicker',
				'field_id' => 'bg_color',
				'label'    => esc_html__( 'Background Color', 'wolf-core' ),
			),

			array(
				'type'     => 'colorpicker',
				'field_id' => 'font_color',
				'label'    => esc_html__( 'Font Color', 'wolf-core' ),
			),
		),
	);
}

return new Wolf_Core_Options( $wolf_core_options );
