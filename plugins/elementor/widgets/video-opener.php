<?php
/**
 * Video Opener
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Widgets
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Elementor_Video_Opener_Widget extends \Elementor\Widget_Base {

	/**
	 * @var string
	 */
	public $params = array();

	public function __construct( $data = array(), $args = null ) {

		parent::__construct( $data, $args );

		$this->params = wolf_core_video_opener_params();
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
	 * Retrieve Video Opener widget title.
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
	 * Retrieve Video Opener widget icon.
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
	 * Retrieve the list of categories the Video Opener widget belongs to.
	 *
	 * @version 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'music' );
	}

	/**
	 * Register Video Opener widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @version 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', '%TEXTDOMAIN%' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		wolf_core_convert_params_to_elementor( $this );

		$this->end_controls_section();
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

			)
		);

		echo wolf_core_video_opener( $atts ); // WCS XSS ok.
	}
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Video_Opener_Widget() );

