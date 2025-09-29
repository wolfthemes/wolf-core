<?php
/**
 * Mailchimp signup widget
 *
 * Displays mailchimp newsletter subscription form
 *
 * @author WolfThemes
 * @category Widgets
 * @package WolfCore/CorWidgetse
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/* Register the widget */
function wolf_core_widget_mailchimp_init() {

	register_widget( 'Wolf_Core_Widget_Mailchimp' );
}
add_action( 'widgets_init', 'wolf_core_widget_mailchimp_init' );

class Wolf_Core_Widget_Mailchimp extends WP_Widget {

	var $wolf_core_widget_cssclass;
	var $wolf_core_widget_description;
	var $wolf_core_widget_idbase;
	var $wolf_core_widget_name;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->wolf_core_widget_name        = 'Mailchimp';
		$this->wolf_core_widget_description = esc_html__( 'Newsletter signup form', 'wolf-core' );
		$this->wolf_core_widget_cssclass    = 'widget_mailchimp';
		$this->wolf_core_widget_idbase      = 'widget_mailchimp';

		/* Widget settings. */
		$widget_ops = array(
			'classname'   => $this->wolf_core_widget_cssclass,
			'description' => $this->wolf_core_widget_description,
		);

		/* Create the widget. */
		parent::__construct( $this->wolf_core_widget_idbase, $this->wolf_core_widget_name, $widget_ops );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		wp_enqueue_script( 'wpb-mailchimp', wolf_core_JS . '/min/mailchimp.min.js', array( 'jquery' ), WOLF_CORE_VERSION, true );
		// add JS global variables
		wp_localize_script(
			'wpb-mailchimp',
			'WPBMailchimpParams',
			array(
				'ajaxUrl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			)
		);
		extract( $args );

		$title           = ( isset( $instance['title'] ) ) ? sanitize_text_field( $instance['title'] ) : '';
		$title           = apply_filters( 'widget_title', $title );
		$description     = ( isset( $instance['description'] ) ) ? sanitize_text_field( $instance['description'] ) : '';
		$list            = ( isset( $instance['list'] ) ) ? esc_attr( $instance['list'] ) : null;
		$show_bg         = ( isset( $instance['show_bg'] ) ) ? esc_attr( $instance['show_bg'] ) : 'yes';
		$show_label      = ( isset( $instance['show_label'] ) ) ? esc_attr( $instance['show_label'] ) : 'yes';
		$size            = ( isset( $instance['size'] ) ) ? esc_attr( $instance['size'] ) : 'large';
		$text_alignement = ( isset( $instance['text_alignement'] ) ) ? esc_attr( $instance['text_alignement'] ) : 'center';
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		if ( ! empty( $description ) ) {
			echo '<p>';
			echo $description;
			echo '</p>';
		}

		echo wolf_core_mailchimp(
			array(
				'list'            => $list,
				'show_bg'         => $show_bg,
				'show_label'      => $show_label,
				'size'            => $size,
				'text_alignement' => $text_alignement,
			)
		);
		echo $after_widget;
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {

		$instance                    = $old_instance;
		$instance['title']           = esc_attr( $new_instance['title'] );
		$instance['description']     = esc_attr( $new_instance['description'] );
		$instance['list']            = esc_attr( $new_instance['list'] );
		$instance['size']            = esc_attr( $new_instance['size'] );
		$instance['show_bg']         = esc_attr( $new_instance['show_bg'] );
		$instance['show_label']      = esc_attr( $new_instance['show_label'] );
		$instance['text_alignement'] = esc_attr( $new_instance['text_alignement'] );
		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @param array $instance
	 */
	function form( $instance ) {

		// Set up some default widget settings
		$defaults = array(
			'title'           => '',
			'description'     => '',
			'list'            => apply_filters( 'wolf_core_default_mailchimp_list_id', wolf_core_get_option( 'mailchimp', 'default_mailchimp_list_id' ) ),
			'size'            => 'large',
			'show_bg'         => 'yes',
			'show_label'      => 'yes',
			'text_alignement' => 'center',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wolf-core' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description', 'wolf-core' ); ?>:</label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $instance['description'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'list' ) ); ?>"><?php esc_html_e( 'List ID', 'wolf-core' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'list' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'list' ) ); ?>" value="<?php echo esc_attr( $instance['list'] ); ?>">
			<br>
			<small><?php esc_html_e( 'Can be found in your mailchimp account -> Lists -> Your List Name -> Settings -> List Name & default', 'wolf-core' ); ?></small>
		</p>
		<p>
			<!-- show_bg -->
			<select name="<?php echo esc_attr( $this->get_field_name( 'show_bg' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'show_bg' ) ); ?>">
				<option value="yes" <?php selected( esc_attr( $instance['show_bg'] ), 'yes' ); ?>><?php esc_html_e( 'Yes', 'wolf-core' ); ?></option>
				<option value="no" <?php selected( esc_attr( $instance['show_bg'] ), 'no' ); ?>><?php esc_html_e( 'No', 'wolf-core' ); ?></option>
			</select>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_bg' ) ); ?>"><?php esc_html_e( 'Show Background', 'wolf-core' ); ?></label>
		</p>
		<p>
			<!-- show_label -->
			<select name="<?php echo esc_attr( $this->get_field_name( 'show_label' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'show_label' ) ); ?>">
				<option value="yes" <?php selected( esc_attr( $instance['show_label'] ), 'yes' ); ?>><?php esc_html_e( 'Yes', 'wolf-core' ); ?></option>
				<option value="no" <?php selected( esc_attr( $instance['show_label'] ), 'no' ); ?>><?php esc_html_e( 'No', 'wolf-core' ); ?></option>
			</select>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_label' ) ); ?>"><?php esc_html_e( 'Show Default Label', 'wolf-core' ); ?></label>
		</p>
		<p>
			<!-- size -->
			<select name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>">
				<option value="normal" <?php selected( esc_attr( $instance['size'] ), 'normal' ); ?>><?php esc_html_e( 'Normal', 'wolf-core' ); ?></option>
				<option value="large" <?php selected( esc_attr( $instance['size'] ), 'large' ); ?>><?php esc_html_e( 'Large', 'wolf-core' ); ?></option>
			</select>
			<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Size', 'wolf-core' ); ?></label>
		</p>
		<p>
			<!-- text_alignement -->
			<select name="<?php echo esc_attr( $this->get_field_name( 'text_alignement' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'text_alignement' ) ); ?>">
				<option value="center" <?php selected( esc_attr( $instance['text_alignement'] ), 'center' ); ?>><?php esc_html_e( 'Center', 'wolf-core' ); ?></option>
				<option value="left" <?php selected( esc_attr( $instance['text_alignement'] ), 'left' ); ?>><?php esc_html_e( 'Left', 'wolf-core' ); ?></option>
				<option value="right" <?php selected( esc_attr( $instance['text_alignement'] ), 'right' ); ?>><?php esc_html_e( 'Right', 'wolf-core' ); ?></option>
			</select>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text_alignement' ) ); ?>"><?php esc_html_e( 'Text alignement', 'wolf-core' ); ?></label>
		</p>
		<?php
	}
}
