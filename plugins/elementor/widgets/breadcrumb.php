<?php // phpcs:ignore
/**
 * Breadcrumb
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Widgets
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Elementor_Breadcrumb_Widget extends \Elementor\Widget_Base { // phpcs:ignore

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

		$this->params = wolf_core_breadcrumb_params();
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
	 * Retrieve Breacrumb widget title.
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
	 * Retrieve Breacrumb widget icon.
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
	 * Retrieve the list of categories the Breacrumb widget belongs to.
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
	 * Register Breacrumb widget controls.
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
				'align'               => '',
				'text_align_mobile'   => '',
				'font_size'           => '',
				'font_weight'         => '',
				'text_transform'      => '',
			)
		);

		echo wolf_core_breadcrumb( $atts ); // WCS XSS ok.
	}
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Breadcrumb_Widget() );

