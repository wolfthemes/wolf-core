<?php
/**
 * Social Icon Widget
 *
 * @author WolfThemes
 * @category Widgets
 * @package WolfCore/CorWidgetse
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/* Register the widget */
function wolf_core_widget_socials_init() {

	register_widget( 'Wolf_Core_Widget_Socials' );
}
add_action( 'widgets_init', 'wolf_core_widget_socials_init' );

class Wolf_Core_Widget_Socials extends WP_Widget {

	var $wolf_core_widget_cssclass;
	var $wolf_core_widget_description;
	var $wolf_core_widget_idbase;
	var $wolf_core_widget_name;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->wolf_core_widget_name        = esc_html__( 'Socials', 'wolf-core' );
		$this->wolf_core_widget_description = esc_html__( 'You social profiles with icons', 'wolf-core' );
		$this->wolf_core_widget_cssclass    = 'wolf_core_widget_socials';
		$this->wolf_core_widget_idbase      = 'wolf_core_widget_socials';

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

		extract( $args );
		$title   = ( isset( $instance['title'] ) ) ? sanitize_text_field( $instance['title'] ) : '';
		$title   = apply_filters( 'widget_title', $title );
		$socials = ( isset( $instance['socials'] ) ) ? esc_attr( $instance['socials'] ) : null;
		// $size = ( isset( $instance['size'] ) ) ? esc_attr( $instance['size'] ) : '';
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		echo wolf_core_social_icons(
			apply_filters(
				'wolf_core_widget_socials_args',
				array(
					'services'  => $socials,
					'alignment' => 'left',
				)
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

		$instance            = $old_instance;
		$instance['title']   = esc_attr( $new_instance['title'] );
		$instance['socials'] = esc_attr( $new_instance['socials'] );
		// $instance['size'] = esc_attr( $new_instance['size'] );
		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @param array $instance
	 */
	function form( $instance ) {

		// Set up some default widget settings.
		$defaults = array(
			'title'   => '',
			'socials' => 'facebook,x,instagram',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wolf-core' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>"><?php esc_html_e( 'Social Services', 'wolf-core' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'socials' ) ); ?>" value="<?php echo esc_attr( $instance['socials'] ); ?>">
			<br>
			<small><?php esc_html_e( 'You can set your social profiles in the plugin settings.', 'wolf-core' ); ?></small>
		</p>
		<?php
	}
}
