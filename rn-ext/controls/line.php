<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Group_Control_Line extends Group_Control_Base
{

	protected static $fields;

	public static function get_type()
	{
		return 'line';
	}

	protected function init_fields()
	{
		$fields = [];

		$fields['show'] = [
			'label' => __('Show Line', 'ntn-ext'),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => 'Show',
			'label_off' => 'Hide',
			'return_value' => 'block'
		];

		$fields['width'] = [
			'label' => __('Width', 'ntn-ext'),
			'type' => Controls_Manager::SLIDER,
			'size_units' => ['px', '%'],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 500,
					'step' => 1
				],
				'%' => [
					'min' => 5,
					'max' => 100,
					'step' => 5
				]
			],
			'desktop_default' => [
				'size' => 50,
				'unit' => 'px'
			],
			'table_default' => [
				'size' => 37,
				'unit' => 'px'
			],
			'mobile_default' => [
				'size' => 27,
				'unit' => 'px'
			],
			'responsive' => true,
			'selectors' => [
				'{{SELECTOR}}' => 'width: {{SIZE}}{{UNIT}};'
			],
			'condition' => [
				'show' => 'block'
			]
		];

		$fields['height'] = [
			'label' => __('Height', 'ntn-ext'),
			'type' => Controls_Manager::SLIDER,
			'size_units' => ['px', '%'],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 200,
					'step' => 1
				],
				'%' => [
					'min' => 1,
					'max' => 100,
					'step' => 5
				]
			],
			'default' => [
				'size' => 1,
				'unit' => 'px'
			],
			'responsive' => true,
			'selectors' => [
				'{{SELECTOR}}' => 'height: {{SIZE}}{{UNIT}};'
			],
			'condition' => [
				'show' => 'block'
			]
		];

		$fields['line_color'] = [
			'label' => __('Line Color', 'ntn-ext'),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{SELECTOR}}' => 'background-color: {{COLOR}}'
			],
			'condition' => [
				'show' => 'block'
			]
		];

		return $fields;
	}

	protected function get_default_options()
	{
		return [
			'popover' => false,
		];
	}
}

\Elementor\Plugin::$instance->controls_manager->add_group_control('line', new Group_Control_Line());