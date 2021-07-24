<?php
/**
 * Contact Form 7
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
function wolf_core_contact_form_7_params() {

	$contact_form_posts = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

	$contact_forms = array( 0 => esc_html__( 'Choose a form', 'wolf-core' ) );
	if ( $contact_form_posts ) {
		foreach ( $contact_form_posts as $contact_form_options ) {
			$contact_forms[ $contact_form_options->ID ] = $contact_form_options->post_title;
		}
	} else {
		$contact_forms[0] = esc_html__( 'No Contact Form yet', 'wolf-core' );
	}

	return apply_filters(
		'wolf_core_contact_form_7_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Contact Form', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_contact_form_7',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'contact-form-7',
				'icon'          => 'linea-basic linea-basic-mail-open-text',
			),
			'params'     => array(
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Select Contact Form', 'wolf-core' ),
					'param_name' => 'form_id',
					'options'    => $contact_forms,
					'default'    => 0,
				),
			),
		)
	);
}
