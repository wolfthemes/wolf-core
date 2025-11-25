<?php // phpcs:ignore
/**
 * Mailchimp
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Widgets
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Elementor_Mailchimp_Widget extends \Elementor\Widget_Base { // phpcs:ignore

	/**
	 * Element parameters
	 *
	 * @var string
	 */
	public $params = array();

	/**
	 *  Element scripts
	 *
	 * @var string
	 */
	public $scripts = array();

	public function __construct( $data = array(), $args = null ) { // phpcs:ignore

		parent::__construct( $data, $args );

		$this->params = wolf_core_mailchimp_params();

		// if ( isset( $this->params['properties']['scripts'] ) ) {

		// $this->scripts = $this->params['properties']['scripts'];

		// foreach ( $this->scripts as $script ) {
		// wp_enqueue_script( $script );
		// }
		// }
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @version 1.0.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return $this->scripts;
	}

	/**
	 * Get widget name
	 *
	 * @version 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		if ( isset( $this->params['properties']['el_base'] ) ) {
			return $this->params['properties']['el_base'];
		}
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve element widget title.
	 *
	 * @version 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return $this->params['properties']['name'];
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve element widget icon.
	 *
	 * @version 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return $this->params['properties']['icon'];
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the element widget belongs to.
	 *
	 * @version 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return $this->params['properties']['el_categories'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @version 1.0.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		if ( isset( $this->params['properties']['keywords'] ) ) {
			return $this->params['properties']['keywords'];
		}
	}

	/**
	 * Register element widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @version 1.0.0
	 * @access protected
	 */
	protected function register_controls() { // phpcs:ignore

		wolf_core_register_elementor_controls( $this );
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @version 1.0.0
	 * @access protected
	 */
	protected function render() {

		$atts = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'list'                => wolf_core_get_option( 'mailchimp', 'default_mailchimp_list_id' ),
				'f_name'              => '',
				'l_name'              => '',
				'size'                => 'normal',
				'label'               => wolf_core_get_option( 'mailchimp', 'label' ),
				'submit_type'         => 'text',
				'submit_text'         => wolf_core_get_option( 'mailchimp', 'subscribe_text', esc_html__( 'Subscribe', 'wolf-visual-composer' ) ),
				'si_type'             => '',
				'icon'                => '',
				'bottom_line'         => wolf_core_get_option( 'mailchimp', 'bottom_line' ),
				'image_id'            => wolf_core_get_option( 'mailchimp', 'background' ),
				'show_bg'             => true,
				'show_label'          => true,
				'show_name'           => 'no',
				'placeholder'         => wolf_core_get_option( 'mailchimp', 'placeholder', esc_html__( 'enter your email address', 'wolf-visual-composer' ) ),
				'button_style'        => '',
				'alignment'           => 'center',
				'text_alignment'      => 'center',
				'enqueue_script'      => true,
				'css_animation'       => '',
				'css_animation_delay' => '',
				'submit_button_class' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		);

		echo wolf_core_mailchimp( $atts ); // phpcs:ignore
	}
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Mailchimp_Widget() );
