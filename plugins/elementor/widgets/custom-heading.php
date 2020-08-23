<?php
/**
 * Custom Heading
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Elements
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

class Elementor_Custom_Heading_Widget extends \Elementor\Widget_Base {

	/**
	 * @var string
	 */
	public $params = [];

	public function __construct( $data = [], $args = null ) {
		
		parent::__construct( $data, $args );

		$this->params = wolf_core_custom_heading_params();
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return $this->params['properties']['el_base'];
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Pie Chart widget title.
	 *
	 * @since 1.0.0
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
	 * Retrieve Pie Chart widget icon.
	 *
	 * @since 1.0.0
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
	 * Retrieve the list of categories the Pie Chart widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'extension' ];
	}

	/**
	 * Register Pie Chart widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', '%TEXTDOMAIN%' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		wolf_core_convert_params_to_elementor( $this );

		$this->end_controls_section();

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$atts = wp_parse_args( $this->get_settings_for_display(), array(
		
		) );

		extract( $atts );
	}
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Custom_Heading_Widget() );