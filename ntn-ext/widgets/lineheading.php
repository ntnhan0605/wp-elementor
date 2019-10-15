<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class LineHeading extends \Elementor\Widget_Base
{
	public function get_name() {
		return 'lineheading';
	}

	public function get_title() {
		return __('Line Heading', 'ntn-ext');
	}

	public function get_icon() {
		return 'eicon-t-letter';
	}

	public function get_categories() {
		return ['ntn-ext'];
	}

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_style( 'lineheading', get_theme_file_uri( 'ntn-ext/assets/css/lineheading.css' ) );
	}

	// public function get_script_depends() {}

	public function get_style_depends() {
		return [ 'lineheading' ];
	}

	protected function _register_controls() {

		// Content
		$this->start_controls_section(
			'title_section',
			[
				'label' => __('Title', 'ntn-ext'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			'html_tag',
			[
				'label' => __( 'HTML Tag', 'ntn-ext' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6'
				],
				'default' => 'h2'
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ntn-ext' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Your title is here', 'ntn-ext'),
				'dynamic' => [
					'active' => true
				]
			]
		);
		$this->add_control(
			'link',
			[
				'label' =>__( 'Link', 'ntn-ext' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'Paste URL or type', 'ntn-ext' ),
				'dynamic' => [
					'active' => true
				]
			]
		);
		$this->end_controls_section();


		// Line Left
		$this->start_controls_section(
			'line_left_section',
			[
				'label' => __('Line Left', 'ntn-ext'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Line::get_type(),
			[
				'label' => __('Line Left', 'ntn-ext'),
				'name' => 'line_left',
				'selector' => '{{WRAPPER}} .line-left'
			]
		);
		$this->end_controls_section();

		// Line Right
		$this->start_controls_section(
			'line_right_section',
			[
				'label' => __('Line Right', 'ntn-ext'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Line::get_type(),
			[
				'label' => __('Line Right', 'ntn-ext'),
				'name' => 'line_right',
				'selector' => '{{WRAPPER}} .line-right'
			]
		);
		$this->end_controls_section();



		// TAB STYLE
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Title', 'ntn-ext' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'color_title',
			[
				'label' => __( 'Text Color', 'ntn-ext' ),
				'type' => \Elementor\Controls_Manager::COLOR
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'label' => __( 'Text Shadow', 'ntn-ext' ),
				'selector' => '{{WRAPPER}} .title-shadow',
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'ntn-ext' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'seperator' => ['left', 'center', 'right'],
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ntn-ext' ),
						'icon' => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __( 'Center', 'ntn-ext' ),
						'icon' => 'eicon-text-align-center'
					],
					'right' => [
						'title' => __( 'Right', 'ntn-ext' ),
						'icon' => 'eicon-text-align-right'
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => 'left',
				'tablet_default' => 'left',
				'mobile_default' => 'left',
				'prefix_class' => 'title-group-%s'
			]
		);


		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'none' );

		$link = '';
		$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		if ( $settings['link']['url'] != '' )
			$link = '<a href="' . $settings['link']['url'] . '"' . $target . $nofollow . '>' . $settings['title'] . '</a>';
		else
			$link = $settings['title'];

		$color_title = ($settings['color_title'] !== '') ? 'color: '.$settings['color_title'].';' : '';
		$title_style = ($color_title !== '') ? 'style="'. $color_title .'"' : '';

		$html_tag = 'h2';
		if ( isset($settings['html_tag']) ) $html_tag = $settings['html_tag'];

		$alignment = isset($settings['alignment']) ? $settings['alignment'] : '';

		$line_left = '';
		$line_right = '';
		
		$show = '<div class="title-group text-' . $alignment . ' ' . $alignment . '">';
		$show .= '<div class="line line-left"></div>';
		$show .= '<' . $html_tag . ' class="title title-shadow" ' . $title_style . ' ' . $this->get_render_attribute_string( 'title' ) . '>' . $link . '</' . $html_tag . '>';
		$show .= '<div class="line line-right"></div>';
		$show .= '</div>';

		echo $show;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \LineHeading() );