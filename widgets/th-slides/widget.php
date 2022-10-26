<?php

namespace ElementorTigonhome\Widgets\Slides;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TH_Slides extends Widget_Base
{

	public function get_name()
	{
		return 'th-slides';
	}

	public function get_title()
	{
		return __('TIGON Slides', 'elementor-tigonhome');
	}

	public function get_icon()
	{
		return 'eicon-slides';
	}

	public function get_categories()
	{
		return ['elementor-tigonhome'];
	}

	public function get_style_depends()
	{
		return ['th-swiper', 'th-slides'];
	}

	public function get_script_depends()
	{
		return ['th-swiper', 'th-widget-carousel'];
	}

	// protected function register_skins() {
	// 	$this->add_skin( new Skins\Skin_Horizontal( $this ) );
	//
	// }

	protected function register_slides_section_controls()
	{
		$this->start_controls_section(
			'section_data_layout',
			[
				'label' => __('Slides', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('button_tabs');

		$repeater->start_controls_tab(
			'slide_image_tab',
			[
				'label' => __('Background', 'elementor-tigonhome'),
			]
		);

		$repeater->add_control(
			'list_image',
			[
				'label' => __('Image', 'elementor-tigonhome'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_overlay',
			[
				'label' => __('Background Overlay', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'elementor-tigonhome'),
				'label_off' => esc_html__('No', 'elementor-tigonhome'),
				'default' => '',
			]
		);

		$repeater->add_control(
			'list_bg_overlay',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .th-slide__background-overlay' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'list_overlay!' => '',
				]
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'slide_content_tab',
			[
				'label' => __('Content', 'elementor-tigonhome'),
			]
		);

		$repeater->add_control(
			'list_sub_heading',
			[
				'label' => __('Sub Heading', 'elementor-tigonhome'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Sub Heading', 'elementor-tigonhome'),
			]
		);

		$repeater->add_control(
			'list_heading',
			[
				'label' => __('Heading', 'elementor-tigonhome'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Heading', 'elementor-tigonhome'),
			]
		);

		$repeater->add_control(
			'list_desc',
			[
				'label' => __('Description', 'elementor-tigonhome'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-tigonhome'),
			]
		);

		$repeater->add_control(
			'list_button',
			[
				'label' => __('Button Text', 'elementor-tigonhome'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Click Here', 'elementor-tigonhome'),
			]
		);

		$repeater->add_control(
			'list_link',
			[
				'label' => __('Link', 'elementor-tigonhome'),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [],
				'placeholder' => esc_html__('https://your-link.com', 'elementor-tigonhome'),
			]
		);

		$repeater->add_control(
			'list_apply_link_on',
			[
				'label' => __('Apply Link On', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'whole_slide' => __('Whole Slide', 'elementor-tigonhome'),
					'button_only' => __('Button Only', 'elementor-tigonhome')
				],
				'default' => 'whole_slide',
				'placeholder' => esc_html__('https://your-link.com', 'elementor-tigonhome'),
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'slide_style_tab',
			[
				'label' => __('Style', 'elementor-tigonhome'),
			]
		);

		$repeater->add_control(
			'list_custom',
			[
				'label' => __('Custom', 'elementor-tigonhome'),
				'description' => __('Set custom style that will only affect this specific slide.',  'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'elementor-tigonhome'),
				'label_off' => esc_html__('No', 'elementor-tigonhome'),
				'default' => '',
			]
		);

		$repeater->add_control(
			'list_sub_heading_color',
			[
				'label' => __('Sub Heading Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .th-slide .th-slide__sub-heading' => 'color: {{VALUE}};',
				],
				'condition' => [
					'list_custom!' => '',
				]
			]
		);

		$repeater->add_control(
			'list_heading_color',
			[
				'label' => __('Heading Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .th-slide .th-slide__heading' => 'color: {{VALUE}};',
				],
				'condition' => [
					'list_custom!' => '',
				]
			]
		);

		$repeater->add_control(
			'list_desc_color',
			[
				'label' => __('Description Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .th-slide .th-slide__desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'list_custom!' => '',
				]
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();


		$this->add_control(
			'list',
			[
				'label' => __('Slides', 'elementor-tigonhome'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_sub_heading' => __('Sub Heading #01', 'elementor-tigonhome'),
						'list_heading' => __('Heading #01', 'elementor-tigonhome'),
						'list_desc' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-tigonhome'),
						'list_button' => __('Click Here', 'elementor-tigonhome'),
						'list_button_link' => '',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_sub_heading' => __('Sub Heading #02', 'elementor-tigonhome'),
						'list_heading' => __('Heading #02', 'elementor-tigonhome'),
						'list_desc' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-tigonhome'),
						'list_button' => __('Click Here', 'elementor-tigonhome'),
						'list_button_link' => '',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_sub_heading' => __('Sub Heading #03', 'elementor-tigonhome'),
						'list_heading' => __('Heading #03', 'elementor-tigonhome'),
						'list_desc' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-tigonhome'),
						'list_button' => __('Click Here', 'elementor-tigonhome'),
						'list_button_link' => '',
					],

				],
				'title_field' => '',
			]
		);


		$this->add_responsive_control(
			'slides_height',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __('Height', 'elementor-tigonhome'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 600,
				],
				'selectors' => [
					'{{WRAPPER}} .th-slides' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_additional_section_controls()
	{
		$this->start_controls_section(
			'additional_options_section',
			[
				'label' => __('Additional Options', 'elementor-addons'),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __('Prev & Next Button', 'elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			],
		);

		$this->add_control(
			'nav_btn_view',
			[
				'label' => __('View', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __('Default', 'elementor-tigonhome'),
					'stacked' => __('Stacked', 'elementor-tigonhome'),
					'framed' => __('Framed', 'elementor-tigonhome'),
				],
				'condition' => [
					'navigation!' => '',
				],
				'prefix_class' => 'th-swiper-button--view-',
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __('Dots', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __('Transition Duration', 'elementor-tigonhome'),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __('Autoplay', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __('Autoplay Speed', 'elementor-tigonhome'),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __('Infinite Loop', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_slides_section_controls()
	{
		$this->start_controls_section(
			'section_design_slides',
			[
				'label' => __('Slides', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slides_content_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __('Content Width', 'elementor-tigonhome'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_padding',
			[
				'label' => __('Padding', 'elementor-tigonhome'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'horizontal_position',
			[
				'label' => __('Horizontal Position', 'elementor-tigonhome'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor-tigonhome'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor-tigonhome'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor-tigonhome'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__inner' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_position',
			[
				'label' => __('Vertical Position', 'elementor-tigonhome'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __('Top', 'elementor-tigonhome'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __('Middle', 'elementor-tigonhome'),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __('Bottom', 'elementor-tigonhome'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__inner' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => __('Text Align', 'elementor-tigonhome'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor-tigonhome'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor-tigonhome'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor-tigonhome'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__inner' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function register_design_content_section_controls()
	{
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => __('Content', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_heading_style',
			[
				'label' => __('Sub Heading', 'elementor-tigonhome'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'sub_heading_space',
			[
				'label' => __('Spacing', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__sub-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__sub-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_heading_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-slide .th-slide__sub-heading',
			]
		);

		$this->add_control(
			'heading_style',
			[
				'label' => __('Heading', 'elementor-tigonhome'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'heading_space',
			[
				'label' => __('Spacing', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-slide .th-slide__heading',
			]
		);

		$this->add_control(
			'desc_style',
			[
				'label' => __('Description', 'elementor-tigonhome'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'desc_space',
			[
				'label' => __('Spacing', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-slide .th-slide__desc',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_button_section_controls()
	{
		$this->start_controls_section(
			'section_design_button',
			[
				'label' => __('Button', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-slide .th-slide__button',
			]
		);

		$this->add_control(
			'button_border',
			[
				'label' => __('Border Width', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'elementor-tigonhome'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Padding', 'elementor-tigonhome'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);


		$this->start_controls_tabs('button_tabs');

		$this->start_controls_tab(
			'button_tab',
			[
				'label' => __('Normal', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __('Border Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_tab_hover',
			[
				'label' => __('Hover', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[
				'label' => __('Border Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_video_section_controls()
	{
		$this->start_controls_section(
			'section_design_video',
			[
				'label' => __('Video', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-slide .th-slide__video',
			]
		);

		$this->start_controls_tabs('video_tabs');

		$this->start_controls_tab(
			'video_tab',
			[
				'label' => __('Normal', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'video_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__video' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'video_tab_hover',
			[
				'label' => __('Hover', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'video_color_hover',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-slide .th-slide__video:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_navigation_section_controls()
	{
		$this->start_controls_section(
			'section_design_navigation',
			[
				'label' => __('Prev & Next Button', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_size',
			[
				'label' => __('Size', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_padding',
			[
				'label' => esc_html__('Padding', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .th-swiper-button' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'condition' => [
					'nav_btn_view!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_border',
			[
				'label' => __('Border Size', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'condition' => [
					'nav_btn_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.th-swiper-button--view-framed .th-swiper-button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'navigation_border_radius',
			[
				'label' => __('Border Radius', 'elementor-tigonhome'),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'nav_btn_view!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.th-swiper-button--view-stacked .th-swiper-button,
					 {{WRAPPER}}.th-swiper-button--view-framed .th-swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs('navigation_style');

		$this->start_controls_tab(
			'navigation_normal',
			[
				'label' => __('Normal', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'navigation_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-swiper-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_background',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'nav_btn_view!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.th-swiper-button--view-stacked .th-swiper-button' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.th-swiper-button--view-framed .th-swiper-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_border_color',
			[
				'label' => __('Border Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'nav_btn_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.th-swiper-button--view-framed .th-swiper-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'navigation_hover',
			[
				'label' => __('Hover', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'navigation_color_hover',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-swiper-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_background_hover',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'nav_btn_view!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.th-swiper-button--view-stacked .th-swiper-button:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.th-swiper-button--view-framed .th-swiper-button:hover' => 'background-color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'navigation_border_color_hover',
			[
				'label' => __('Border Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'nav_btn_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.th-swiper-button--view-framed .th-swiper-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function register_design_pagination_section_controls()
	{
		$this->start_controls_section(
			'section_design_pagination',
			[
				'label' => __('Dots', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_control(
			'pagination_size',
			[
				'label' => __('Size', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pagination_space_between',
			[
				'label' => esc_html__('Space Between', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .th-swiper-pagination .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
			]
		);

		$this->start_controls_tabs('pagination_style');

		$this->start_controls_tab(
			'pagination_normal',
			[
				'label' => __('Normal', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_active',
			[
				'label' => __('Active', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'pagination_color_active',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_controls()
	{

		$this->register_slides_section_controls();
		$this->register_additional_section_controls();

		$this->register_design_slides_section_controls();
		$this->register_design_content_section_controls();
		$this->register_design_button_section_controls();
		$this->register_design_video_section_controls();

		$this->register_design_navigation_section_controls();
		$this->register_design_pagination_section_controls();
	}

	public function get_instance_value_skin($key)
	{
		$settings = $this->get_settings_for_display();

		if (!empty($settings['_skin']) && isset($settings[str_replace('-', '_', $settings['_skin']) . '_' . $key])) {
			return $settings[str_replace('-', '_', $settings['_skin']) . '_' . $key];
		}

		if (isset($settings[$key])) {
			return $settings[$key];
		}

		return;
	}

	protected function swiper_data()
	{
		$settings = $this->get_settings_for_display();

		$swiper_data = array(
			'slidesPerView' => 1,
			'spaceBetween' => 0,
			'speed' => $settings['speed'],
			'loop' => $settings['loop'] == 'yes' ? true : false,

		);

		if ($settings['navigation'] === 'yes') {
			$swiper_data['navigation'] = array(
				'nextEl' => '.th-swiper-button-next__' . $this->get_id(),
				'prevEl' => '.th-swiper-button-prev__' . $this->get_id(),
			);
		}

		if ($settings['pagination'] === 'yes') {
			$swiper_data['pagination'] = array(
				'el' => '.th-swiper-pagination__' . $this->get_id(),
				'type' => 'bullets',
				'clickable' => true,
			);
		}

		if ($settings['autoplay'] === 'yes') {
			$swiper_data['autoplay'] = array(
				'delay' => $settings['autoplay_speed'],
			);
		}

		return $swiper_json = json_encode($swiper_data);
	}

	public function render_element_header()
	{
		$settings = $this->get_settings_for_display();

		$classes = 'swiper-container th-slides';

		if (!empty($settings['_skin'])) {
			$classes .= ' th-slides--' . $settings['_skin'];
		}

		if ($settings['navigation'] === 'yes') {
			$classes .= ' has-navigation';
		}

		if ($settings['pagination'] === 'yes') {
			$classes .= ' has-pagination';
		}

		$this->add_render_attribute('wrapper', 'class', $classes);

		$this->add_render_attribute('wrapper', 'data-swiper', $this->swiper_data());

		echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';
	}

	public function render_element_footer()
	{
		$settings = $this->get_settings_for_display();

		echo '</div>';

		if ($settings['navigation'] === 'yes') {
			echo '<div class="th-swiper-button th-swiper-button-prev th-swiper-button-prev__' . $this->get_id() . '"><i class="fa fa-chevron-left"></i></div>
            <div class="th-swiper-button th-swiper-button-next th-swiper-button-next__' . $this->get_id() . '"><i class="fa fa-chevron-right"></i></div>';
		}

		if ($settings['pagination'] === 'yes') {
			echo '<div class="th-swiper-pagination th-swiper-pagination__' . $this->get_id() . '"></div>';
		}
	}


	public function render_element_item($value)
	{

		$attachment = wp_get_attachment_image_src($value['list_image']['id'], 'full');
		$thumbnail = !empty($attachment) ? $attachment[0] : $value['list_image']['url'];

		$this->add_link_attributes('slide-link', $value['list_link']);

		echo '<div class="th-slide">';

		echo '<div class="th-slide__image">
	                <img src=" ' . esc_url($thumbnail) . ' " alt="">
	            </div>';
		if ($value['list_overlay'] == 'yes') {
			echo '<div class="th-slide__background-overlay"></div>';
		}
		if (!empty($value['list_link']['url']) && $value['list_apply_link_on'] == 'whole_slide') {
			echo '<a class="th-slide__inner" ' . $this->get_render_attribute_string('slide-link') . '>';
		} else {
			echo '<div class="th-slide__inner">';
		}
		echo '<div class="th-slide__content ">';

		if (!empty($value['list_sub_heading'])) {
			echo '<h5 class="th-slide__sub-heading">' . $value['list_sub_heading'] . '</h5>';
		}

		if (!empty($value['list_heading'])) {
			echo '<h3 class="th-slide__heading">' . $value['list_heading'] . '</h3>';
		}

		if (!empty($value['list_desc'])) {
			echo '<p class="th-slide__desc">' . $value['list_desc'] . '</p>';
		}

		if (!empty($value['list_button']) || !empty($value['list_video'])) {
			echo '<div class="th-slide__links">';

			if (!empty($value['list_link']['url']) && !empty($value['list_button']) && $value['list_apply_link_on'] == 'button_only') {
				echo '<a class="th-slide__link th-slide__button" ' . $this->get_render_attribute_string('slide-link') . '>'
					. esc_html__($value['list_button'], 'elementor-tigonhome') .
					'</a>';
			} elseif (!empty($value['list_button'])) {
				echo '<div class="th-slide__link th-slide__button">' . esc_html__($value['list_button'], 'elementor-tigonhome') . '</div>';
			}

			echo '</div>';
		}

		echo '</div>';
		if (!empty($value['list_link']['url']) && $value['list_apply_link_on'] == 'whole_slide') {
			echo '</a>';
		} else {
			echo '</div>';
		}

		echo '</div>';
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->render_element_header();

?>

		<!-- <div class="swiper-wrapper th-list-slides">
			<?php
			// if (!empty($settings['list'])) {

			foreach ($settings['list'] as $key => $value) {

				// 		echo '<div class="swiper-slide elementor-repeater-item-' . esc_attr($value['_id']) . '" >';

				$this->render_element_item($value);

				// 		echo '</div>';
			}
			// }
			?>
		</div> -->

		<section class="slider-section">
			<div class="sliders">
				<div class="bg-slider slider">
					<div class="slide">
						<div class="bg-wrapper">
							<div class="bg loaded" style="background-image: url(&quot;http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ-1.jpg&quot;); opacity: 1;" data-src="http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ-1.jpg">
								<img src="http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ-1.jpg">
							</div>
						</div>
					</div>
					<div class="slide">
						<div class="bg-wrapper">
							<div class="bg loaded" style="background-image: url(&quot;http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ.jpg&quot;); opacity: 1;" data-src="http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ.jpg">
								<img src="http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ.jpg">
							</div>
						</div>
					</div>
					<div class="slide">
						<div class="bg-wrapper">
							<div class="bg loaded" style="background-image: url(&quot;http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ-2.jpg&quot;); opacity: 1;" data-src="http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ-2.jpg">
								<img src="http://tigonhome.com/wp-content/uploads/2020/06/TRANG-CHỦ-2.jpg">
							</div>
						</div>
					</div>
				</div>
				<div class="svg-slider slider">
					<div class="slide">
						<div class="svg-wrapper"></div>
					</div>
				</div>
				<div class="title-slider slider">
					<div class="slide">
						<div class="text-overflow">
							<div class="title-wrapper">
								<h2 class="text font-style-h1">RESIDENCE</h2>
							</div>
						</div>
						<div class="by-developer">
							<p class="text font-style-element-bold"></p>
						</div>
						<div class="button-wrapper">
							<div class="button know-more">
								<div class="curtain"></div>
								<p class="text font-style-element-bold">Know More</p>
							</div>
						</div>
						<a class="to-single" href="http://tigonhome.com/gallery/?album=1"></a>
					</div>
					<div class="slide">
						<div class="text-overflow">
							<div class="title-wrapper">
								<h2 class="text font-style-h1">PENTHOUSE</h2>
							</div>
						</div>
						<div class="by-developer">
							<p class="text font-style-element-bold"></p>
						</div>
						<div class="button-wrapper">
							<div class="button know-more">
								<div class="curtain"></div>
								<p class="text font-style-element-bold">Know More</p>
							</div>
						</div>
						<a class="to-single" href="http://tigonhome.com/gallery/?album=2"></a>
					</div>
					<div class="slide">
						<div class="text-overflow">
							<div class="title-wrapper">
								<h2 class="text font-style-h1">HOSPITALITY</h2>
							</div>
						</div>
						<div class="by-developer">
							<p class="text font-style-element-bold"></p>
						</div>
						<div class="button-wrapper">
							<div class="button know-more">
								<div class="curtain"></div>
								<p class="text font-style-element-bold">Know More</p>
							</div>
						</div>
						<a class="to-single" href="http://tigonhome.com/gallery/?album=3"></a>
					</div>
				</div>
			</div>
			<div class="count" style="display: none">
				<div class="index">
					<p class="text font-style-h2">03</p>
				</div>
				<div class="separator">
					<p class="text font-style-h2"> /</p>
				</div>
				<div class="amount">
					<p class="text font-style-h2">7</p>
				</div>
			</div>
			<div class="navigation">
				<div class="nav-option prev">
					<p class="text font-style-element-bold delete-in-mobile">
						Previous project</p>
					<svg enable-background="new 0 0 24 24" id="Layer_1" version="1.0" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<polyline fill="none" points="15.5,21 6.5,12 15.5,3 " stroke="#ffffff" stroke-miterlimit="10" stroke-width="2"></polyline>
					</svg>
				</div>
				<div class="nav-option next">
					<p class="text font-style-element-bold delete-in-mobile">
						Next
						<br>project
					</p>
					<svg enable-background="new 0 0 24 24" id="Layer_1" version="1.0" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<polyline fill="none" points="8.5,3 17.5,12 8.5,21 " stroke="#ffffff" stroke-miterlimit="10" stroke-width="2"></polyline>
					</svg>
				</div>
				<div class="button-wrapper filter-mq">
					<div class="button ">
						<div class="curtain"></div>
						<p class="text font-style-element-bold">MENU</p>
					</div>
				</div>
			</div>
			<!-- <div class="connect-for-mq">
				<div class="pseudo-menu-element">
					<a class="text font-style-element" target="_blank" href="mailto:info@tigonhome.com<">info@tigonhome.com</a>
				</div>
				<div class="pseudo-menu-element">
					<a class="text font-style-element" target="_blank" href="tel:+97143218777">+0903867276</a>
				</div>
			</div> -->
			<div class="open-menu-button">
				<div class="svg-container"></div>
				<div class="close-menu-button">
					<div class="svg-container">
						<svg id="icon-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1017.38 1024">
							<rect x="-177.28" y="473.9" width="1371.95" height="76.21" transform="translate(-213.05 509.66) rotate(-45)"></rect>
							<rect x="470.59" y="-173.97" width="76.21" height="1371.95" transform="translate(-213.05 509.66) rotate(-45)"></rect>
						</svg>
					</div>
				</div>
				<div class="automatic-animation">
					<div class="bar" style="height: 100%; width: 98.6316%;"></div>
				</div>
				<div class="capture-event"></div>
				<div class="initial-message">
					<div class="image-wrapper">
						<img src="http://tigonhome.com/">
					</div>
					<div class="text-wrapper">
						<p class="text font-style-p"> Click in the title to explore each project.</p>
					</div>
					<div class="button-wrapper">
						<div class="button">
							<div class="curtain"></div>
							<p class="text font-style-element">Ok</p>
						</div>
					</div>
				</div>
			</div>
		</section>

<?php

		$this->render_element_footer();
	}

	protected function content_template()
	{
	}
}
