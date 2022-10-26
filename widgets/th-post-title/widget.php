<?php
namespace ElementorTigonhome\Widgets\Post_Title;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TH_Post_Title extends Widget_Base {

	public function get_name() {
		return 'th-post-title';
	}

	public function get_title() {
		return __( 'Tigon Post Title', 'elementor-tigonhome' );
	}

	public function get_icon() {
		return 'eicon-post-title';
	}

	public function get_categories() {
		return [ 'elementor-tigonhome' ];
	}

	public function get_style_depends() {
		return [ 'th-title' ];
	}

	public function get_script_depends() {
		return [];
	}

	// protected function register_skins() {
  //
	// }

	protected function register_design_content_section_controls() {
		$this->start_controls_section(
			'section_design_style',
			[
				'label' => __( 'Style', 'elementor-tigonhome' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_responsive_control(
      'alignment',
      [
        'label' => __( 'Alignment', 'elementor-tigonhome' ),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
          'left' => [
            'title' => __( 'Left', 'elementor-tigonhome' ),
            'icon' => 'eicon-text-align-left',
          ],
          'center' => [
            'title' => __( 'Center', 'elementor-tigonhome' ),
            'icon' => 'eicon-text-align-center',
          ],
          'right' => [
            'title' => __( 'Right', 'elementor-tigonhome' ),
            'icon' => 'eicon-text-align-right',
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .th-title' => 'text-align: {{VALUE}};',
        ],
      ]
    );

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'elementor-tigonhome' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'archive_title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-title',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {

		$this->register_design_content_section_controls();

	}

	public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}

		if( isset( $settings[$key] ) ) {
			return $settings[$key];
		}

		return;
	}

	public function render_element_header() {
		$settings = $this->get_settings_for_display();

		$classes = 'th-title-wrapper';

		if( !empty( $settings['_skin'] ) ) {
			$classes .= ' th-post--' . $settings['_skin'];
		} else {
			$classes .= ' th-post-title--skin-default';
		}

		$this->add_render_attribute( 'wrapper', 'class', $classes );

		?>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
		<?php
	}

	public function render_element_footer() {

		?>
			</div>
		<?php
	}

	public function render_loop_footer() {

		?>
			</div>
		<?php
	}

	protected function render() {


		$this->render_element_header();

    the_title('<h1 class="th-title th-post-title">', '</h1>');

		$this->render_element_footer();

	}

	protected function content_template() {

	}
}
