<?php
namespace ElementorTigonhome;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public $widgets = array();

	public function widgets_list() {

		$this->widgets = array(
			'th-slides',
			'th-posts',
			'th-categories',
		);

		return $this->widgets;
	}

	/**
	 * Register styles
	 */
	public function register_styles() {
		wp_register_style( 'th-swiper', plugins_url( '/assets/css/th-swiper.css', __FILE__ ) );
		wp_register_style( 'th-slides', plugins_url( '/assets/css/th-slides.css', __FILE__ ) );
		wp_register_style( 'th-posts', plugins_url( '/assets/css/th-posts.css', __FILE__ ) );
		wp_register_style( 'th-categories', plugins_url( '/assets/css/th-categories.css', __FILE__ ) );

	}

	/**
	 * Enqueue styles
	 */
	public function enqueue_styles() {

		// wp_enqueue_style( 'th-elements', plugins_url( '/assets/css/elements.css', __FILE__ ) );
	}

	/**
	 * Register scripts
	 */
	public function register_scripts() {
		wp_register_script( 'th-swiper', plugins_url( '/assets/lib/swiper/swiper.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'th-widget-carousel', plugins_url( '/assets/js/th-widget-carousel.js', __FILE__ ), [ 'jquery' ], false, true );

	}

	/**
	 * Enqueue scripts
	 */
	public function enqueue_scripts() {

		// wp_enqueue_script( 'th-elements', plugins_url( '/assets/js/elements.js', __FILE__ ), [ 'jquery' ], false, true );

	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 */
	private function include_widgets_files() {

		foreach( $this->widgets_list() as $widget ) {
			require_once( __DIR__ . '/widgets/'. $widget .'/widget.php' );

			foreach( glob( __DIR__ . '/widgets/'. $widget .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}

	}

	/**
	 * Register Category
	 *
	 * Register new Elementor category.
	 */
	public function add_category( $elements_manager ) {
		$elements_manager->add_category(
			'elementor-tigonhome',
			[
				'title' => esc_html__( 'Elementor Tigonhome', 'elementor-tigonhome' )
			]
		);
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Slides\TH_Slides() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Posts\TH_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Categories\TH_Categories() );


	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 */
	public function __construct() {

		// Widget styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_styles' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_styles' ] );

		// Widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		// Register category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

	}
}

// Instantiate Plugin Class
Plugin::instance();
