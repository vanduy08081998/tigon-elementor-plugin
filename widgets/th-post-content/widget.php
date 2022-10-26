<?php
namespace ElementorTigonhome\Widgets\Post_Content;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class TH_Post_Content extends Widget_Base {

	public function get_name() {
		return 'th-post-content';
	}

	public function get_title() {
		return __( 'TH Post Content', 'elementor-tigonhome' );
	}

	public function get_icon() {
		return 'eicon-post-content';
	}

	public function get_categories() {
		return [ 'elementor-tigonhome' ];
	}

  public function get_style_depends() {
		return [ 'th-magnific-popup', 'th-post-content' ];
	}

	public function get_script_depends() {
		return ['th-magnific-popup', 'th-gallery-popup'];
	}

  // protected function register_skins() {
  //
  // }

  public function register_design_content_section_controls()
  {
    $this->start_controls_section(
      'section_style',
      [
        'label' => esc_html__( 'Style', 'elementor-tigonhome' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_responsive_control(
      'align',
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
          '{{WRAPPER}} th-post-content-wrapper' => 'text-align: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'text_color',
      [
        'label' => esc_html__( 'Text Color', 'elementor-tigonhome' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} th-post-content-wrapper' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'post_content_typography',
        'default' => '',
        'selector' => '{{WRAPPER}} th-post-content-wrapper',
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

    $classes = 'th-post-content-wrapper';

    if( !empty( $settings['_skin'] ) ) {
      $classes .= ' th-post-content--' . $settings['_skin'];
    } else {
      $classes .= ' th-post-content--skin-default';
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

	protected function render() {

    $this->render_element_header();

    the_content();

    $this->render_element_footer();

	}

	public function content_template() {}
}
