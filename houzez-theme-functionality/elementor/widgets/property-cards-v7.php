<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Properties Widget.
 * @since 2.0
 */
class Houzez_Elementor_Property_Card_V7 extends Widget_Base {
    use Houzez_Filters_Traits;
    use Houzez_Property_Cards_Traits;     

    /**
     * Get widget name.
     *
     * Retrieve widget name.
     *
     * @since 2.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'houzez_elementor_property-card-v7';
    }

    /**
     * Get widget title.
     * @since 2.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Property Cards v7', 'houzez-theme-functionality' );
    }

    /**
     * Get widget icon.
     *
     * @since 2.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'houzez-element-icon eicon-gallery-grid';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to.
     *
     * @since 2.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'houzez-elements' ];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 2.0
     * @access protected
     */
    protected function register_controls() {

        
        $this->start_controls_section(
            'content_section',
            [
                'label'     => esc_html__( 'Properties', 'houzez-theme-functionality' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'module_type',
            [
                'label'     => esc_html__( 'Layout', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'grid_3_cols'  => esc_html__( 'Grid View 3 Columns', 'houzez-theme-functionality'),
                    'grid_4_cols'  => esc_html__( 'Grid View 4 Columns', 'houzez-theme-functionality'),
                    'grid_2_cols'    => esc_html__( 'Grid View 2 Columns', 'houzez-theme-functionality'),
                    'list'    => esc_html__( 'List View', 'houzez-theme-functionality')
                ],
                'description' => '',
                'default' => 'grid_3_cols',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'listing_thumb',
                'exclude' => [ 'custom', 'thumbnail', 'houzez-image_masonry', 'houzez-map-info', 'houzez-variable-gallery', 'houzez-gallery' ],
                'include' => [],
                'default' => 'houzez-item-image-1',
            ]
        );

        $this->listings_cards_general_filters();

        $this->add_control(
            'pagination_type',
            [
                'label'     => esc_html__( 'Pagination', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => houzez_pagination_type(),
                'description' => '',
                'default' => 'loadmore',
            ]
        );

        $this->add_control(
            'warning_panel_notice',
            [
                'type' => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'warning',
                'dismissible' => false,
                'heading' => esc_html__( 'Warning', 'textdomain' ),
                'content' => esc_html__( 'Infinite Scroll works with only one widget per page; enabling it for multiple widgets on the same page will cause issues.', 'houzez-theme-functionality' ),
                'condition' => [
                    'pagination_type' => 'infinite_scroll'
                ]
            ]
        );

        
        $this->end_controls_section();

        /*--------------------------------------------------------------------------------
        * Filters
        * -------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'filters_section',
            [
                'label'     => esc_html__( 'Filters', 'houzez-theme-functionality' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->listings_cards_filters();

        $this->end_controls_section();


        /*--------------------------------------------------------------------------------
        * Show/Hide 
        * -------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'hide_show_section',
            [
                'label'     => esc_html__( 'Show/Hide Data', 'houzez-theme-functionality' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->Property_Cards_Show_Hide_Traits();

        $this->add_control(
            'hide_date',
            [
                'label' => esc_html__( 'Hide Date', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'houzez-theme-functionality' ),
                'label_off' => esc_html__( 'No', 'houzez-theme-functionality' ),
                'return_value' => 'none',
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .property-cards-module .item-date' => 'display: {{VALUE}};',
                ],
                'condition' => [
                    'module_type' => 'list'
                ]
            ]
        );

        $this->add_control(
            'hide_author',
            [
                'label' => esc_html__( 'Hide Author', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'houzez-theme-functionality' ),
                'label_off' => esc_html__( 'No', 'houzez-theme-functionality' ),
                'return_value' => 'none',
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .property-cards-module .item-author' => 'display: {{VALUE}};',
                ],
                'condition' => [
                    'module_type' => 'list'
                ]
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------------------------
        * Typography
        * -------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'typography_section',
            [
                'label'     => esc_html__( 'Typography', 'houzez-theme-functionality' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_property_title',
                'label'    => esc_html__( 'Property Title', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .item-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_prop_address',
                'label'    => esc_html__( 'Address', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} address.item-address',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_meta_labels',
                'label'    => esc_html__( 'Meta Labels', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .item-amenities-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_meta_figure',
                'label'    => esc_html__( 'Meta Figure', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .hz-figure',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_item_price',
                'label'    => esc_html__( 'Price', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .item-price',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_item_subprice',
                'label'    => esc_html__( 'Sub Price', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .item-sub-price',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_item_types',
                'label'    => esc_html__( 'Property Type', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .h-type span',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_item_area-postfix',
                'label'    => esc_html__( 'Area Postfix', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .area_postfix',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_btn-item',
                'label'    => esc_html__( 'Buttons', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .btn-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_item_agent',
                'label'    => esc_html__( 'Agent', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .item-author a',
                'condition' => [
                    'module_type' => 'list'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hz_item_date',
                'label'    => esc_html__( 'Date', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .item-date',
                'condition' => [
                    'module_type' => 'list'
                ]
            ]
        );

    
        $this->end_controls_section();

        /*--------------------------------------------------------------------------------
        * Margin and Spacing
        * -------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'hz_spacing_margin_section',
            [
                'label'     => esc_html__( 'Spaces & Sizes', 'houzez-theme-functionality' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'hz_title_margin_bottom',
            [
                'label' => esc_html__( 'Title Margin Bottom(px)', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .item-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hz_address_margin_bottom',
            [
                'label' => esc_html__( 'Address Margin Bottom(px)', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .item-address' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hz_meta_icons',
            [
                'label' => esc_html__( 'Meta Icons Size(px)', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .item-amenities i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hz_content_padding',
            [
                'label'      => esc_html__( 'Content Area Padding', 'houzez-theme-functionality' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .item-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------------------------
        * Card Box
        * -------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'hz_grid_box_shadow',
            [
                'label' => esc_html__( 'Card Box', 'houzez-theme-functionality' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_background',
            [
                'label' => esc_html__( 'Background', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-wrap, {{WRAPPER}} .item-footer' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ft_border_type',
            [
                'label' => esc_html__( 'Border Type', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => array(
                    '' => esc_html__('Default', 'houzez-theme-functionality'),
                    'none' => esc_html__('None', 'houzez-theme-functionality'),
                    'solid' => esc_html__('Solid', 'houzez-theme-functionality'),
                    'dashed' => esc_html__('Dashed', 'houzez-theme-functionality'),
                    'dotted' => esc_html__('Dotted', 'houzez-theme-functionality'),
                    'groove' => esc_html__('Groove', 'houzez-theme-functionality'),
                    'double' => esc_html__('Double', 'houzez-theme-functionality'),
                    'ridge' => esc_html__('Ridge', 'houzez-theme-functionality'),
                ),
                'selectors' => [
                    '{{WRAPPER}} .item-footer' => 'border-top-style: {{VALUE}}; border-left-style: {{VALUE}}; border-right-style: {{VALUE}}; border-bottom-style: {{VALUE}};',
                    '{{WRAPPER}} .item-wrap-v9 .item-body' => 'border-left-style: {{VALUE}}; border-right-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'grid_bg_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-footer' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .item-wrap-v9 .item-body' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------------------------
        * Image 
        * -------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'hz_grid_images_styles',
            [
                'label' => esc_html__( 'Image Radius', 'houzez-theme-functionality' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->Property_Cards_Image_Traits();

        $this->end_controls_section();

        /*--------------------------------------------------------------------------------
        * Colors
        * -------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'hz_grid_colors',
            [
                'label' => esc_html__( 'Colors', 'houzez-theme-functionality' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->Property_Cards_Colors_Traits();
        
        $this->end_controls_section();

        /*--------------------------------------------------------------------------------
        * Button
        * -------------------------------------------------------------------------------*/
        
        $this->Property_Cards_btn_Traits();

        /*--------------------------------------------------------------------------------
        * Pagination
        * -------------------------------------------------------------------------------*/
        
        $this->Property_Cards_Pagination_Traits();

    }

    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 2.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $args = $this->listings_cards_args($settings);
        
       
        if( function_exists( 'houzez_property_card_v7' ) ) {
            echo houzez_property_card_v7( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register( new Houzez_Elementor_Property_Card_V7 );