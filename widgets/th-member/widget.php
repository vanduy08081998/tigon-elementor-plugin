<?php

namespace ElementorTigonhome\Widgets\Posts;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TH_Member extends Widget_Base
{
    public function get_name()
    {
        return 'th-member';
    }

    public function get_title()
    {
        return __('TH Member', 'elementor-tigonhome');
    }

    public function get_icon()
    {
        return 'eicon-user-circle-o';
    }

    public function get_categories()
    {
        return ['elementor-tigonhome'];
    }

    public function get_style_depends()
    {
        //wp_register_style('jbox-css', 'https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.3/dist/jBox.all.min.js', array(), '1.3.3');
        return ['th-jbox','th-member'];
    }

    public function get_script_depends()
    {
        //wp_register_script('jbox-js', 'https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.3/dist/jBox.all.min.css', array('jquery'), false, true);
        return ['th-jbox','th-member'];
    }

    public function members_query()
    {

        $supported_ids = [];

        $args = array(
            'post_type' => 'members',
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
            'taxonomy' => 'member_role',
            'hide_empty' => false,
        ));
        if (!empty($categories)  && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $supported_taxonomies[$category->term_id] = $category->name;
            }
        }

        return $supported_taxonomies;
    }

    protected function register_content_section()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => 'Layout',
                'tab' => Controls_Manager::TAB_CONTENT
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
                'selectors' => [
                    '{{WRAPPER}} .th-members .wrapper' => 'grid-template-columns: repeat({{VALUE}}, 1fr);'
                ]
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
            'member',
            [
                'label' => __('Members', 'elementor-tigonhome'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->members_query(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        $this->add_control(
            'role',
            [
                'label' => __('Role', 'elementor-tigonhome'),
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
                'label' => __('Member', 'elementor-tigonhome'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->members_query(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        $this->add_control(
            'role_exclude',
            [
                'label' => __('Role', 'elementor-tigonhome'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_supported_taxonomies(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function register_design_layout_section_controls()
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
                    '{{WRAPPER}} .th-members .wrapper' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .th-members .wrapper' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment_content',
            [
                'label' => __('Alignment content', 'elementor-tigonhome'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'elementor-tigonhome'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor-tigonhome'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'elementor-tigonhome'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-members ._member .__content' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_title',
            [
                'label' => __('Member name', 'elementor-tigonhome'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-members ._member .__content .name h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .th-members ._member .__content .name h3',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .th-members ._member .__content .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .th-members ._member .__content .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_role',
            [
                'label' => __('Role', 'elementor-tigonhome'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'role_color',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-members ._member .__content .info ._role span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'role_typography',
                'selector' => '{{WRAPPER}} .th-members ._member .__content .info ._role span',
            ]
        );
        $this->add_responsive_control(
            'role_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .th-members ._member .__content .info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'role_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .th-members ._member .__content .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_content_section();
        $this->register_query_section_controls();
        $this->register_design_layout_section_controls();
    }

    public function query_posts()
    {
        $settings = $this->get_settings_for_display();

        // if (is_front_page()) {
        //     $paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;
        // } else {
        //     $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
        // }
        $get_all_terms = array();
        $taxonomies = get_terms(array(
            'taxonomy' => 'member_role',
            'hide_empty' => false
        ));
        foreach ($taxonomies as $term) {
            array_push($get_all_terms, $term->term_id);
        }
        $args = [
            'post_type' => 'members',
            'post_status' => 'publish',
            'numberposts' => -1,
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'member_role',
                    'field' => 'term_id',
                    'terms' => ($settings['role'] != NULL) ? $settings['role'] : $get_all_terms,
                    'order' => 'ASC',
                ),
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'member_role',
                    'field'    => 'term_id',
                    'terms'    => $settings['role_exclude'],
                    'operator' => 'NOT IN',
                )
            ),
        ];

        if (!empty($settings['member'])) {
            $args['post__in'] = $settings['member'];
        }

        if (!empty($settings['ids_exclude'])) {
            $args['post__not_in'] = $settings['ids_exclude'];
        }

        return $query = new \WP_Query($args);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $query = $this->query_posts();
?>
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.3/dist/jBox.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.3/dist/jBox.min.js"></script>
        <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.3/dist/jBox.min.css" rel="stylesheet">
        <section class="th-members">
            <div class="wrapper">
                <?php
                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                ?>
                        <div class="_member">
                            <div class="__avatar"><?php echo get_the_post_thumbnail(); ?></div>
                            <div class="__content">
                                <div class="name">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                <div class="info">
                                    <div class="_role">
                                        <span><?php echo get_the_terms(get_the_ID(), 'member_role')[0]->name; ?></span>
                                    </div>
                                    <?php
                                    if ($settings['show_read_more'] == true) :
                                        if (get_the_content()) :
                                    ?>
                                            <span class="info_space">-</span>
                                            <a class="_readmore" id="intro-more" href="javascript:void(0);" data-jbox-title="<?php the_title(); ?>'s Information" data-jbox-content="<?php the_content(); ?>">
                                                <?php echo $settings['read_more_text']; ?>
                                            </a>
                                    <?php
                                        endif;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                else :
                    echo '<div class="not-found">Nothing Member found!</div>';
                endif;
                ?>
            </div>
        </section>
<?php
    }
}
