<?php

namespace ElementorTigonhome\Widgets\Posts;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TH_Posts extends Widget_Base
{

	public function get_name()
	{
		return 'th-posts';
	}

	public function get_title()
	{
		return __('Tigon Posts', 'elementor-tigonhome');
	}

	public function get_icon()
	{
		return 'eicon-post-list';
	}

	public function get_categories()
	{
		return ['elementor-tigonhome'];
	}

	public function get_style_depends()
	{
		return ['th-posts'];
	}

	public function get_script_depends()
	{
		return [];
	}

	// protected function register_skins() {
	//
	// }

	public function get_supported_ids()
	{

		$supported_ids = [];

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish'
		);

		$wp_query = new \WP_Query($args);

		if ($wp_query->have_posts()) {
			while ($wp_query->have_posts()) {
				$wp_query->the_post();
				$supported_ids[get_the_ID()] = get_the_title();
			}
		}

		return $supported_ids;
	}

	public function get_supported_taxonomies()
	{

		$supported_taxonomies = [];

		$categories = get_terms(array(
			'taxonomy' => 'category',
			'hide_empty' => false,
		));
		if (!empty($categories)  && !is_wp_error($categories)) {
			foreach ($categories as $category) {
				$supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __('Layout', 'elementor-tigonhome'),
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => __('Columns', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'prefix_class' => 'elementor-grid%s-',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __('Posts Per Page', 'elementor-tigonhome'),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'show_thumbnail',
			[
				'label' => __('Thumbnail', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'elementor-tigonhome'),
				'label_off' => __('Hide', 'elementor-tigonhome'),
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium',
				'exclude' => ['custom'],
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'image_ratio',
			[
				'label' => __('Image Ratio', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.66,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-post__featured' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __('Title', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'elementor-tigonhome'),
				'label_off' => __('Hide', 'elementor-tigonhome'),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => __('Category', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'elementor-tigonhome'),
				'label_off' => __('Hide', 'elementor-tigonhome'),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label' => __('Read More', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'elementor-tigonhome'),
				'label_off' => __('Hide', 'elementor-tigonhome'),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __('Read More Text', 'elementor-tigonhome'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Read More', 'elementor-tigonhome'),
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_query_section_controls()
	{
		$this->start_controls_section(
			'section_query',
			[
				'label' => __('Query', 'elementor-tigonhome'),
			]
		);

		$this->start_controls_tabs('tabs_query');

		$this->start_controls_tab(
			'tab_query_include',
			[
				'label' => __('Include', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'ids',
			[
				'label' => __('Ids', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __('Category', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_query_exnlude',
			[
				'label' => __('Exclude', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'ids_exclude',
			[
				'label' => __('Ids', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category_exclude',
			[
				'label' => __('Category', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __('Offset', 'elementor-tigonhome'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'description' => __('Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'elementor-tigonhome'),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'orderby',
			[
				'label' => __('Order By', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __('Date', 'elementor-tigonhome'),
					'post_title' => __('Title', 'elementor-tigonhome'),
					'menu_order' => __('Menu Order', 'elementor-tigonhome'),
					'rand' => __('Random', 'elementor-tigonhome'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __('Order', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __('ASC', 'elementor-tigonhome'),
					'desc' => __('DESC', 'elementor-tigonhome'),
				],
			]
		);

		$this->add_control(
			'ignore_sticky_posts',
			[
				'label' => __('Ignore Sticky Posts', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => __('Sticky-posts ordering is visible on frontend only', 'elementor-tigonhome'),
			]
		);

		$this->end_controls_section();
	}

	protected function register_pagination_section_controls()
	{
		$this->start_controls_section(
			'section_pagination',
			[
				'label' => __('Pagination', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label' => __('Show Pagination', 'elementor-tigonhome'),
				'description' => __('', 'elementor-tigonhome'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_latyout_section_controls()
	{
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __('Layout', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'column_gap',
			[
				'label' => __('Columns Gap', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label' => __('Rows Gap', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' => __('Alignment', 'elementor-tigonhome'),
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
					'{{WRAPPER}} .th-post' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .th-post__links' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_box_section_controls()
	{
		$this->start_controls_section(
			'section_design_box',
			[
				'label' => __('Box', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_border_width',
			[
				'label' => __('Border Width', 'elementor-tigonhome'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-post' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __('Border Radius', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-post' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Padding', 'elementor-tigonhome'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __('Content Padding', 'elementor-tigonhome'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs('bg_effects_tabs');

		$this->start_controls_tab(
			'classic_style_normal',
			[
				'label' => __('Normal', 'elementor-tigonhome'),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .th-post',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-post' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __('Border Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-post' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'classic_style_hover',
			[
				'label' => __('Hover', 'elementor-tigonhome'),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .th-post:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-post:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __('Border Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-post:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_image_section_controls()
	{
		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __('Image', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __('Border Radius', 'elementor-tigonhome'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .th-post__featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('thumbnail_effects_tabs');

		$this->start_controls_tab(
			'normal',
			[
				'label' => __('Normal', 'elementor-tigonhome'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .th-post__featured img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			[
				'label' => __('Hover', 'elementor-tigonhome'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .th-post:hover .th-post__featured img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
			'heading_title_style',
			[
				'label' => __('Title', 'elementor-tigonhome'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-post__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __('Color Hover', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .th-post__title:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-post__title',
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_category_style',
			[
				'label' => __('Category', 'elementor-tigonhome'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-post__category-link' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_category!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-post__category-link',
				'condition' => [
					'show_category!' => '',
				],
			]
		);

		$this->add_control(
			'heading_readmore_style',
			[
				'label' => __('Read More', 'elementor-tigonhome'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-post__read-more' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'read_more_color_hover',
			[
				'label' => __('Color Hover', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .th-post__read-more:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .th-post__read-more',
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_pagination_section_controls()
	{
		$this->start_controls_section(
			'section_design_pagination',
			[
				'label' => __('Pagination', 'elementor-tigonhome'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination!' => '',
				]
			]
		);

		$this->add_control(
			'page_numbers_spacing',
			[
				'label' => __('Spacing', 'elementor-tigonhome'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .page-numbers' => 'margin: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'page_numbers_border_radius',
			[
				'label' => __('Border Radius', 'elementor-tigonhome'),
				'size_units' => ['px', '%'],
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'page_numbers_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .page-numbers',
			]
		);

		$this->start_controls_tabs('tabs_page_numbers');

		$this->start_controls_tab(
			'tab_page_numbers_normal',
			[
				'label' => __('Normal', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'page_numbers_color',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-numbers' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'page_numbers_bg_color',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-numbers' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_page_numbers_hover',
			[
				'label' => __('Hover', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'page_numbers_color_hover',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-numbers:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'page_numbers_bg_color_hover',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-numbers:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_page_numbers_active',
			[
				'label' => __('Active', 'elementor-tigonhome'),
			]
		);

		$this->add_control(
			'page_numbers_color_active',
			[
				'label' => __('Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-numbers.current' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'page_numbers_bg_color_active',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-numbers.current' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_query_section_controls();
		$this->register_pagination_section_controls();

		$this->register_design_latyout_section_controls();
		$this->register_design_box_section_controls();
		$this->register_design_image_section_controls();
		$this->register_design_content_section_controls();
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

	public function query_posts()
	{
		$settings = $this->get_settings_for_display();

		if (is_front_page()) {
			$paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;
		} else {
			$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
		}

		$args = [
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $this->get_instance_value_skin('posts_per_page'),
			'paged' => $paged,
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'ignore_sticky_posts' => ('yes' !== $settings['ignore_sticky_posts']) ? true : false,
		];

		if (!empty($settings['ids'])) {
			$args['post__in'] = $settings['ids'];
		}

		if (!empty($settings['ids_exclude'])) {
			$args['post__not_in'] = $settings['ids_exclude'];
		}

		if (!empty($settings['category'])) {
			$args['category__in'] = $settings['category'];
		}

		if (!empty($settings['category_exclude'])) {
			$args['category__not_in'] = $settings['category_exclude'];
		}

		if (0 !== absint($settings['offset'])) {
			$args['offset'] = $settings['offset'];
		}

		return $query = new \WP_Query($args);
	}

	public function render_element_header()
	{
		$settings = $this->get_settings_for_display();

		$classes = 'th-posts';

		if (!empty($settings['_skin'])) {
			$classes .= ' th-posts--' . $settings['_skin'];
		} else {
			$classes .= ' th-posts--skin-default';
		}

		$this->add_render_attribute('wrapper', 'class', $classes);

?>
		<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<?php
	}

	public function render_element_footer()
	{

		?>
		</div>
	<?php
	}

	public function render_loop_header()
	{
		$settings = $this->get_settings_for_display();

		$classes = 'elementor-grid th-list-posts';

		$this->add_render_attribute('loop', 'class', $classes);

	?>
		<div <?php echo $this->get_render_attribute_string('loop'); ?>>
		<?php
	}

	public function render_loop_footer()
	{

		?>
		</div>
	<?php
	}

	public function render_post()
	{
		$settings = $this->get_settings_for_display();

		$categories = get_the_category(get_the_ID());

		$placeholder = \Elementor\Utils::get_placeholder_image_src();
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
		?>
		<article id="post-<?php the_ID();  ?>" <?php post_class( 'elementor-item th-post' ); ?>>
			<?php if( '' !== $this->get_instance_value_skin('show_thumbnail' ) ) { ?>
				<div class="th-post__thumbnail">
					<a href="<?php the_permalink() ?>">
						<div class="th-post__featured">
							<?php if ($featured_img_url): ?>
								<img class="lazy" src="<?php echo $featured_img_url; ?>" alt="">
							<?php else: ?>
								<img class="lazy" src="<?php echo $placeholder; ?>" alt="">
							<?php endif; ?>
						</div>
					</a>
				</div>
			<?php } ?>

			<div class="th-post__content">

				<?php if ('' !== $this->get_instance_value_skin('show_category')) : ?>
					<div class="th-post__categories">
						<?php foreach ($categories as $key => $category) : ?>
							<a class="th-post__category-link" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
								<?php echo esc_html($category->name); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if ('' !== $this->get_instance_value_skin('show_title') || '' !== $this->get_instance_value_skin('show_read_more')) : ?>
					<div class="th-post__links">
						<?php
						if ('' !== $this->get_instance_value_skin('show_title')) {
							echo '<a href="'.get_the_permalink().'"><h3 class="th-post__title">'.get_the_title().'</h3></a>';
						}
						?>
						<?php
						if ('' !== $this->get_instance_value_skin('show_read_more')) {
							echo '<a class="th-post__read-more" href="' . get_the_permalink() . '">' . $this->get_instance_value_skin('read_more_text') . '</a>';
						}
						?>
					</div>
				<?php endif; ?>

			</div>
		</article>
	<?php
	}

	public function render_element_show_pagination()
	{
		$settings = $this->get_settings_for_display();

		$query = $this->query_posts();
		$max_num_pages = $query->max_num_pages;

		if ($settings['show_pagination'] !== 'yes') {
			return;
		}

		if ($max_num_pages < 2) {
			return;
		}

	?>
		<div class="th-pagination">
			<?php
			$big = 999999999; // need an unlikely integer
			$prev_text = 'Prev';

			$next_text = 'Next';

			echo paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $max_num_pages,
				'prev_text' => $prev_text,
				'next_text' => $next_text,
			));
			?>
		</div>
<?php

	}

	protected function render()
	{

		$query = $this->query_posts();

		$this->render_element_header();

		if ($query->have_posts()) {

			$this->render_loop_header();

			while ($query->have_posts()) {
				$query->the_post();

				$this->render_post();
			}

			$this->render_loop_footer();

			$this->render_element_show_pagination();
		} else {
			// no posts found
		}

		wp_reset_postdata();

		$this->render_element_footer();
	}

	protected function content_template()
	{
	}
}
