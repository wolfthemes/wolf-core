<?php // phpcs:ignore
/**
 * Gallery
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Widgets
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Elementor_Gallery_Banner_Widget extends \Elementor\Widget_Base { // phpcs:ignore

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

		$this->params = wolf_core_gallery_banner_params();

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

		// $this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			array(
				'label' => esc_html__( 'Image', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => esc_html__( 'Alignment', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'          => esc_html__( 'Width', 'elementor' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( 'px', '%', 'em', 'rem', 'vw', 'custom' ),
				'range'          => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'space',
			array(
				'label'          => esc_html__( 'Max Width', 'elementor' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( 'px', '%', 'em', 'rem', 'vw', 'custom' ),
				'range'          => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'      => esc_html__( 'Height', 'elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'vh', 'custom' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 500,
					),
					'vh' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'object-fit',
			array(
				'label'     => esc_html__( 'Object Fit', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'condition' => array(
					'height[size]!' => '',
				),
				'options'   => array(
					''        => esc_html__( 'Default', 'elementor' ),
					'fill'    => esc_html__( 'Fill', 'elementor' ),
					'cover'   => esc_html__( 'Cover', 'elementor' ),
					'contain' => esc_html__( 'Contain', 'elementor' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'object-position',
			array(
				'label'     => esc_html__( 'Object Position', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					'center center' => esc_html__( 'Center Center', 'elementor' ),
					'center left'   => esc_html__( 'Center Left', 'elementor' ),
					'center right'  => esc_html__( 'Center Right', 'elementor' ),
					'top center'    => esc_html__( 'Top Center', 'elementor' ),
					'top left'      => esc_html__( 'Top Left', 'elementor' ),
					'top right'     => esc_html__( 'Top Right', 'elementor' ),
					'bottom center' => esc_html__( 'Bottom Center', 'elementor' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'elementor' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'elementor' ),
				),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} img' => 'object-position: {{VALUE}};',
				),
				'condition' => array(
					'object-fit' => 'cover',
				),
			)
		);
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
			array()
		);

		echo wolf_core_gallery_banner( $atts ); // phpcs:ignore
	}
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Gallery_Banner_Widget() );
