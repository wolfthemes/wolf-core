<?php // phpcs:ignore
/**
 * Pricing Table
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Widgets
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Elementor_Pricing_Table_Widget extends \Elementor\Widget_Base { // phpcs:ignore

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

		$this->params = wolf_core_pricing_table_params();

		if ( isset( $this->params['properties']['register_scripts'] ) ) {

			wolf_core_register_scripts( $this->params['properties']['register_scripts'] );
		}

		if ( isset( $this->params['properties']['scripts'] ) ) {
			$this->scripts = $this->params['properties']['scripts'];
		}
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
	 * Retrieve widget title.
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
	 * Retrieve widget icon.
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
	 * Retrieve the list of categories the widget belongs to.
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
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @version 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

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
				'title'            => '',
				'title_tag'        => 'h3',
				'tagline'          => '',
				'price'            => '',
				'currency'         => '',
				'display_currency' => 'before',
				'offer'            => '',
				'offer_price'      => '',
				'price_period'     => '',
				'button_text'      => '',
				'link'             => '',
				'featured'         => '',
				'services'         => '',
			)
		);

		echo wolf_core_pricing_table( $atts ); // WCS XSS ok.
	}
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Pricing_Table_Widget() );
