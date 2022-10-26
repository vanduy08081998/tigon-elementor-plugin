<?php

namespace ElementorTigonhome\Widgets\Categories;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TH_Categories extends Widget_Base
{

	public function get_name()
	{
		return 'th-categories';
	}

	public function get_title() {
		return __( 'Tigon List Categories', 'elementor-tigonhome' );
	}

	public function get_icon() {
		return 'eicon-wordpress';
	}

	public function get_categories()
	{
		return ['elementor-tigonhome'];
	}

	public function get_style_depends()
	{
		return ['th-categories'];
	}

	public function get_script_depends()
	{
		return [];
	}

	// protected function register_skins() {
	//
	// }

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
					'{{WRAPPER}} .th-category__featured' => 'padding-bottom: calc( {{SIZE}} * 100% );',
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
			'category_exclude',
			[
				'label' => __('Category', 'elementor-tigonhome'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'{{WRAPPER}} .th-category__links' => 'justify-content: {{VALUE}};',
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
					'{{WRAPPER}} .th-category' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .th-category' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .th-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .th-category__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .th-category',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-category' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __('Border Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-category' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .th-category:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __('Background Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-category:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __('Border Color', 'elementor-tigonhome'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-category:hover' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .th-category__featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .th-category__featured img',
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
				'selector' => '{{WRAPPER}} .th-category:hover .th-category__featured img',
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
					'{{WRAPPER}} .th-category__title a' => 'color: {{VALUE}};',
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
					' {{WRAPPER}} .th-category__title a:hover' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .th-category__title',
				'condition' => [
					'show_title!' => '',
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
					'{{WRAPPER}} .th-category__read-more' => 'color: {{VALUE}};',
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
					' {{WRAPPER}} .th-category__read-more:hover' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .th-category__read-more',
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_query_section_controls();

		$this->register_design_latyout_section_controls();
		$this->register_design_box_section_controls();
		$this->register_design_image_section_controls();
		$this->register_design_content_section_controls();
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

	public function query_categories()
	{
		$settings = $this->get_settings_for_display();

		$args = [
			'taxonomy' => 'category',
			'hide_empty' => false,
			'order' => $settings['order'],
		];

		if (!empty($settings['category'])) {
			$args['include'] = $settings['category'];
		}

		if (!empty($settings['category_exclude'])) {
			$args['exclude'] = $settings['category_exclude'];
		}

		$terms = get_terms($args);

		return $terms;
	}

	public function render_element_header()
	{
		$settings = $this->get_settings_for_display();

		$classes = 'th-categories';

		if (!empty($settings['_skin'])) {
			$classes .= ' th-categories--' . $settings['_skin'];
		} else {
			$classes .= ' th-categories--skin-default';
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

		$classes = 'elementor-grid th-list-category';

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

	public function render_category($category)
	{

		$settings = $this->get_settings_for_display();

		$placeholder = \Elementor\Utils::get_placeholder_image_src();

		$image_cat = get_field('image', $category);
		$permalink_cat = get_term_link($category, 'category');
		$name_cat = $category->name;

	?>
		<article id="category-<?php echo $category->term_id;  ?> category">
			<?php if ('' !== $this->get_instance_value_skin('show_thumbnail')) { ?>
				<div class="th-category__thumbnail">
					<a href="<?php echo $permalink_cat; ?>">
						<div class="th-category__featured">
							<?php if (!empty($image_cat['url'])) : ?>
								<img src="<?php echo $image_cat['url']; ?>" alt="">
							<?php else : ?>
								<img src="<?php echo $placeholder; ?>" alt="">
							<?php endif; ?>
						</div>
					</a>
				</div>
			<?php } ?>

			<div class="th-category__content">

				<?php if ('' !== $this->get_instance_value_skin('show_title') || '' !== $this->get_instance_value_skin('show_read_more')) : ?>
					<div class="th-category__links">
						<?php
						if ('' !== $this->get_instance_value_skin('show_title')) {
							echo '<h3 class="th-category__title"><a href="' . $permalink_cat . '">' . $name_cat . '</a></h3>';
						}
						?>
						<?php
						if ('' !== $this->get_instance_value_skin('show_read_more')) {
							echo '<a class="th-category__read-more" href="' . $permalink_cat . '">' . $this->get_instance_value_skin('read_more_text') . '</a>';
						}
						?>
					</div>
				<?php endif; ?>

			</div>
		</article>
<?php
	}


	protected function render()
	{

		$categories = $this->query_categories();

		$this->render_element_header();

		if ($categories) {

			$this->render_loop_header();

			foreach ($categories as $key => $category) {

				$this->render_category($category);
			}

			$this->render_loop_footer();
		} else {
			// no category found
		}

		$this->render_element_footer();
	}

	protected function content_template()
	{
	}
}
