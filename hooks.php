<?php
/**
 * Hooks
 */
// Heading
add_action( 'elementor/element/heading/section_title/after_section_end', function( $element, $args ) {
  $element->start_controls_section(
  	'heading_custom_section',
  	[
  		'label' => __( 'Custom', 'elementor-tigonhome' ),
  	]
  );

  $element->add_responsive_control(
  	'heading_max_width',
  	[
  		'type' => \Elementor\Controls_Manager::SLIDER,
  		'label' => __( 'Max Width', 'elementor-tigonhome' ),
     'size_units' => [ 'px', '%' ],
  		'range' => [
  			'px' => [
  				'min' => 0,
  				'max' => 1000,
  				'step' => 5,
  			],
  			'%' => [
  				'min' => 0,
  				'max' => 100,
  			],
  		],
     'default' => [
  			'unit' => '%',
  			'size' => 100,
  		],
     'selectors' => [
       '{{WRAPPER}} .elementor-heading-title' => 'max-width: {{SIZE}}{{UNIT}};',
     ],
  	]
  );

  $element->add_responsive_control(
  	'heading_auto_left',
  	[
  		'label' => __( 'Auto Left', 'elementor-tigonhome' ),
  		'type' => \Elementor\Controls_Manager::SWITCHER,
  		'label_on' => __( 'On', 'elementor-tigonhome' ),
  		'label_off' => __( 'Off', 'elementor-tigonhome' ),
  		'return_value' => 'auto',
  		'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-heading-title' => 'margin-left: {{VALUE}};',
      ],
  	]
  );

  $element->add_responsive_control(
  	'heading_auto_right',
  	[
  		'label' => __( 'Auto Right', 'elementor-tigonhome' ),
  		'type' => \Elementor\Controls_Manager::SWITCHER,
  		'label_on' => __( 'On', 'elementor-tigonhome' ),
  		'label_off' => __( 'Off', 'elementor-tigonhome' ),
  		'return_value' => 'auto',
  		'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-heading-title' => 'margin-right: {{VALUE}};',
      ],
  	]
  );

  $element->end_controls_section();

}, 10, 2 );

add_action( 'elementor/element/heading/section_title_style/after_section_end', function( $element, $args ) {
  $element->start_controls_section(
  	'heading_custom_style_section',
  	[
  		'label' => __( 'Custom', 'elementor-tigonhome' ),
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
  	]
  );

  $element->add_control(
  	'heading_text_stroke_width',
  	[
  		'type' => \Elementor\Controls_Manager::SLIDER,
  		'label' => __( 'Text Stroke Width', 'elementor-tigonhome' ),
      'size_units' => [ 'px' ],
  		'range' => [
  			'px' => [
  				'min' => 0,
  				'max' => 10,
  				'step' =>1,
  			]
  		],
     'selectors' => [
       '{{WRAPPER}} .elementor-heading-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
     ],
  	]
  );

  $element->add_control(
    'heading_text_stroke_color',
    [
      'label' => __( 'Text Stroke Color', 'elementor-tigonhome' ),
      'type' => \Elementor\Controls_Manager::COLOR,
      'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-heading-title' => '-webkit-text-stroke-color: {{VALUE}};',
      ],
    ]
  );

  $element->end_controls_section();

}, 10, 2 );

//Text Editor
add_action( 'elementor/element/text-editor/section_editor/after_section_end', function( $element, $args ) {

  $element->start_controls_section(
  	'text_editor_custom_section',
  	[
  		'label' => __( 'Custom', 'elementor-tigonhome' ),
  	]
  );

  $element->add_responsive_control(
  	'text_editor_max_width',
  	[
  		'type' => \Elementor\Controls_Manager::SLIDER,
  		'label' => __( 'Max Width', 'elementor-tigonhome' ),
     'size_units' => [ 'px', '%' ],
  		'range' => [
  			'px' => [
  				'min' => 0,
  				'max' => 1000,
  				'step' => 5,
  			],
  			'%' => [
  				'min' => 0,
  				'max' => 100,
  			],
  		],
     'default' => [
  			'unit' => '%',
  			'size' => 100,
  		],
     'selectors' => [
       '{{WRAPPER}} .elementor-widget-container' => 'max-width: {{SIZE}}{{UNIT}};',
     ],
  	]
  );

  $element->add_responsive_control(
  	'text_editor_auto_left',
  	[
  		'label' => __( 'Auto Left', 'elementor-tigonhome' ),
  		'type' => \Elementor\Controls_Manager::SWITCHER,
  		'label_on' => __( 'On', 'elementor-tigonhome' ),
  		'label_off' => __( 'Off', 'elementor-tigonhome' ),
  		'return_value' => 'auto',
  		'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-widget-container' => 'margin-left: {{VALUE}};',
      ],
  	]
  );

  $element->add_responsive_control(
  	'text_editor_auto_right',
  	[
  		'label' => __( 'Auto Right', 'elementor-tigonhome' ),
  		'type' => \Elementor\Controls_Manager::SWITCHER,
  		'label_on' => __( 'On', 'elementor-tigonhome' ),
  		'label_off' => __( 'Off', 'elementor-tigonhome' ),
  		'return_value' => 'auto',
  		'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-widget-container' => 'margin-right: {{VALUE}};',
      ],
  	]
  );

  $element->end_controls_section();

}, 10, 2 );

// Button
add_action( 'elementor/element/button/section_button/after_section_end', function( $element, $args ) {

  $element->start_controls_section(
  	'button_custom_section',
  	[
  		'label' => __( 'Custom', 'elementor-tigonhome' ),
  	]
  );

  $element->add_responsive_control(
  	'button_min_width',
  	[
  		'type' => \Elementor\Controls_Manager::SLIDER,
  		'label' => __( 'Min Width', 'elementor-tigonhome' ),
      'size_units' => [ 'px', '%' ],
      'range' => [
      	'px' => [
      		'min' => 0,
      		'max' => 1000,
      		'step' => 5,
      	],
      	'%' => [
      		'min' => 0,
      		'max' => 100,
      	],
      ],
      'selectors' => [
        '{{WRAPPER}} .elementor-button' => 'min-width: {{SIZE}}{{UNIT}};',
      ],
  	]
  );

  $element->end_controls_section();

}, 10, 2 );

// files archive title
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});
