<?php
namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Property_Price extends Widget_Base {
	use \HouzezThemeFunctionality\Elementor\Traits\Houzez_Preview_Query;

	public function get_name() {
		return 'houzez-property-price';
	}

	public function get_title() {
		return __( 'Property Price', 'houzez-theme-functionality' );
	}

	public function get_icon() {
		return 'houzez-element-icon eicon-price-table';
	}

	public function get_categories() {
		if(get_post_type() === 'fts_builder' && htb_get_template_type(get_the_id()) === 'single-listing')  {
            return ['houzez-single-property-builder']; 
        }

		return [ 'houzez-single-property' ];
	}

	public function get_keywords() {
		return [ 'houzez', 'price', 'property' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_price_content',
			[
				'label' => __( 'Content', 'houzez-theme-functionality' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'hide_second_price',
            [
                'label' => esc_html__( 'Hide Second Price', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'houzez-theme-functionality' ),
                'label_off' => esc_html__( 'No', 'houzez-theme-functionality' ),
                'return_value' => 'none',
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hz-ele-price .item-sub-price' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'item_price_align',
			[
				'label' => __( 'Alignment', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'right',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'houzez-theme-functionality' ),
						'icon' => 'eicon-text-align-' . ( is_rtl() ? 'right' : 'left' ),
					],
					'center' => [
						'title' => __( 'Center', 'houzez-theme-functionality' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'houzez-theme-functionality' ),
						'icon' => 'eicon-text-align-' . ( is_rtl() ? 'left' : 'right' ),
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hz-ele-price' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .hz-ele-price li' => 'list-style:none',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item_price_style',
			[
				'label' => __( 'Price', 'houzez-theme-functionality' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'item_price_color',
			[
				'label' => __( 'Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .item-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'item_price_top',
			[
				'label' => __( 'Margin Top', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-price' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'item_price_bottom',
			[
				'label' => __( 'Margin Bottom', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-price' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .item-price',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'item_price_text_shadow',
				'label' => __( 'Text Shadow', 'houzez-theme-functionality' ),
				'selector' => '{{WRAPPER}} .item-price',
			]
		);

		$this->add_control(
			'item_sub_price_heading',
			[
				'label' => __( 'Second Price', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_sub_price_color',
			[
				'label' => __( 'Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .item-sub-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'item_sub_price_top',
			[
				'label' => __( 'Margin Top', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-sub-price' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'item_sub_price_bottom',
			[
				'label' => __( 'Margin Bottom', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-sub-price' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_sub_price_typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .item-sub-price',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'item_sub_price_text_shadow',
				'label' => __( 'Text Shadow', 'houzez-theme-functionality' ),
				'selector' => '{{WRAPPER}} .item-sub-price',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

        $this->single_property_preview_query(); // Only for preview
		
		echo '<ul class="hz-ele-price">';
			echo houzez_listing_price_v1();
		echo '</ul>';

		$this->reset_preview_query(); // Only for preview
	}

	public function render_plain_content() {}
}
Plugin::instance()->widgets_manager->register( new Property_Price );
