<?php
namespace Elementor;
use Houzez\Classes;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Files\Assets\Svg\Svg_Handler;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Site Menu Widget.
 * @since 1.0.0
 */
class Houzez_Menu extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'houzez_site_menu';
    }

    /**
     * Get widget title.
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Navigation', 'houzez' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'houzez-element-icon eicon-nav-menu';
    }

    public function get_keywords() {
        return [ 'Menu', 'Nav', 'navigation', 'houzez' ];
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        // Check if the current post type is 'fts_builder'
	    if (get_post_type() === 'fts_builder') {
	        // Get the template type of the current post
	        $template_type = htb_get_template_type(get_the_ID());

	        // Check if the template type is 'tmp_header' or 'tmp_footer'
	        if ($template_type === 'tmp_header' || $template_type === 'tmp_footer') {
	            // Return the specific category for header and footer builders
	            return ['houzez-header-footer-builder'];
	        }
	    }
	    
	    // Return the default categories
	    return ['houzez-elements', 'houzez-header-footer'];
    }

    /**
     * Get the all available menus
     *
     * Retrieve the list of all menus.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array menu slug.
     */
	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = array();

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function register_controls() {
		$this->register_general_controls();
	}

	

	/**
	 * Register Site Logo Controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_general_controls() {
		
		 $this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'houzez' ),
			]
		);

		$menu_options = $this->get_available_menus();

		if( $menu_options  ) {
			$this->add_control(
				'menu_slug',
				[
					'label' => __( 'Menu', 'houzez' ),
					'type' => 'select',
					'default' => isset( array_keys( $menu_options )[0] ) ? array_keys( $menu_options )[0] : '',
					'options' => $menu_options,
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'houzez' ), admin_url( 'nav-menus.php' ) ),

				]
			);
		} else {
			$this->add_control(
				'menu_slug',
				array(
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'houzez' ), self_admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                )
			);
		}

		$this->add_control(
            'layout',
            [
                'label'     => esc_html__( 'layout', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => array(
                	'horizontal' => esc_html__('Horizontal', 'houzez-theme-functionality'),
                	'vertical' => esc_html__('Vertical', 'houzez-theme-functionality'),
                	'dropdown' => esc_html__('Dropdown', 'houzez-theme-functionality'),
                ),
                'description' => '',
                'default' => 'horizontal',
                'label_block' => false,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'align_items',
			[
				'label' => esc_html__( 'Align', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'houzez-theme-functionality' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'houzez-theme-functionality' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'houzez-theme-functionality' ),
						'icon' => 'eicon-h-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Stretch', 'houzez-theme-functionality' ),
						'icon' => 'eicon-h-align-stretch',
					],
				],
				'prefix_class' => 'houzez-nav-menu-align-',
				'condition' => [
					'layout!' => 'dropdown',
				],
				'separator' => 'before',

			]
		);

		$this->add_control(
			'pointer',
			[
				'label' => esc_html__( 'Pointer', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'underline',
				'options' => [
					'none' => esc_html__( 'None', 'houzez-theme-functionality' ),
					'underline' => esc_html__( 'Underline', 'houzez-theme-functionality' ),
					'overline' => esc_html__( 'Overline', 'houzez-theme-functionality' ),
					'doubleline' => esc_html__( 'Double Line', 'houzez-theme-functionality' ),
					'framed' => esc_html__( 'Framed', 'houzez-theme-functionality' ),
					'background' => esc_html__( 'Background', 'houzez-theme-functionality' ),
					'text' => esc_html__( 'Text', 'houzez-theme-functionality' ),
				],
				'style_transfer' => true,
				'condition' => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'animation_line',
			[
				'label' => esc_html__( 'Animation', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => 'Fade',
					'slide' => 'Slide',
					'grow' => 'Grow',
					'drop-in' => 'Drop In',
					'drop-out' => 'Drop Out',
					'none' => 'None',
				],
				'condition' => [
					'layout!' => 'dropdown',
					'pointer' => [ 'underline', 'overline', 'doubleline' ],
				],
			]
		);

		$this->add_control(
			'animation_framed',
			[
				'label' => esc_html__( 'Animation', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => 'Fade',
					'grow' => 'Grow',
					'shrink' => 'Shrink',
					'none' => 'None',
				],
				'condition' => [
					'layout!' => 'dropdown',
					'pointer' => 'framed',
				],
			]
		);

		$this->add_control(
			'animation_background',
			[
				'label' => esc_html__( 'Animation', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => 'Fade',
					'grow' => 'Grow',
					'shrink' => 'Shrink',
					'sweep-left' => 'Sweep Left',
					'sweep-right' => 'Sweep Right',
					'sweep-up' => 'Sweep Up',
					'sweep-down' => 'Sweep Down',
					'none' => 'None',
				],
				'condition' => [
					'layout!' => 'dropdown',
					'pointer' => 'background',
				],
			]
		);

		$this->add_control(
			'animation_text',
			[
				'label' => esc_html__( 'Animation', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grow',
				'options' => [
					'grow' => 'Grow',
					'shrink' => 'Shrink',
					'sink' => 'Sink',
					'float' => 'Float',
					'skew' => 'Skew',
					'rotate' => 'Rotate',
					'none' => 'None',
				],
				'condition' => [
					'layout!' => 'dropdown',
					'pointer' => 'text',
				],
			]
		);

		$this->add_control(
            'submenu_icon',
            [
                'label'     => esc_html__( 'Submenu Indicator', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => array(
                	'no' => esc_html__('None', 'houzez-theme-functionality'),
                	'angle' => esc_html__('Angle', 'houzez-theme-functionality'),
                	'carret' => esc_html__('Caret', 'houzez-theme-functionality'),
                	'plus' => esc_html__('Plus', 'houzez-theme-functionality'),
                ),
                'description' => '',
                'separator' => 'before',
                'label_block' => false,
                'default' => 'angle',
                'skin' => 'inline',
            ]
        );

        $this->add_control(
            'mobile_heading',
            [
                'label' => esc_html__( 'Mobile Dropdown', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
					'layout!' => 'dropdown',
				],
            ]
        );

        $this->add_control(
			'mobile-menu-breakpoint',
			[
				'label'   => esc_html__( 'Breakpoint', 'houzez-theme-functionality' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tablet',
				'options' => [
					'tablet' => esc_html__( 'Tablet Portrait & Less', 'houzez-theme-functionality' ),
					'mobile' => esc_html__( 'Mobile Portrait & Less', 'houzez-theme-functionality' ),
					'none'   => esc_html__( 'None', 'houzez-theme-functionality' ),
				],
				'condition' => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'mobile_toggle_align',
			[
				'label' => esc_html__( 'Toggle Align', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'houzez-theme-functionality' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'houzez-theme-functionality' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'houzez-theme-functionality' ),
						'icon' => 'eicon-h-align-right',
					],
				],

			]
		);

		$this->add_responsive_control(
			'mdropdown-margin-top',
			[
				'label' => esc_html__( 'Top', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-mobile-nav' => 'top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'full_width',
			[
				'label' => esc_html__( 'Full Width', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Stretch the dropdown of the menu to full width.', 'houzez-theme-functionality' ),
				'prefix_class' => 'houzez-nav-mobile-menu-',
				'return_value' => 'fullwidth',
				'default' => 'fullwidth',
				'frontend_available' => true,
				'condition' => [
					'mobile-menu-breakpoint!' => 'none',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Text  Align', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'aside',
				'options' => [
					'aside' => esc_html__( 'Aside', 'houzez-theme-functionality' ),
					'center' => esc_html__( 'Center', 'houzez-theme-functionality' ),
				],
				'prefix_class' => 'elementor-nav-menu__text-align-',
				'condition' => [
					'mobile-menu-breakpoint!' => 'none',
				],
			]
		);

		$this->start_controls_tabs( 'nav_icon_options' );

		$this->start_controls_tab( 'nav_icon_normal_options', [
			'label' => esc_html__( 'Normal', 'houzez-theme-functionality' ),
		] );

		$this->add_control(
			'toggle_icon_normal',
			[
				'label' => esc_html__( 'Icon', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'skin_settings' => [
					'inline' => [
						'none' => [
							'label' => esc_html__( 'Default', 'houzez-theme-functionality' ),
							'icon' => 'eicon-menu-bar',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended' => [
					'fa-solid' => [
						'plus-square',
						'plus',
						'plus-circle',
						'bars',
					],
					'fa-regular' => [
						'plus-square',
					],
				],
			]
		);

		$this->end_controls_tab();

		/*$this->start_controls_tab( 'nav_icon_hover_options', [
			'label' => esc_html__( 'Hover', 'houzez-theme-functionality' ),
			'condition' => [
				'toggle' => 'burger',
			],
		] );

		$this->add_control(
			'toggle_icon_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'frontend_available' => true,
				'render_type' => 'template',
				'condition' => [
					'toggle' => 'burger',
				],
			]
		);

		$this->end_controls_tab();*/

		$this->start_controls_tab( 'nav_icon_active_options', [
			'label' => esc_html__( 'Active', 'houzez-theme-functionality' ),
		] );

		$this->add_control(
			'toggle_icon_active',
			[
				'label' => esc_html__( 'Icon', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'skin_settings' => [
					'inline' => [
						'none' => [
							'label' => esc_html__( 'Default', 'houzez-theme-functionality' ),
							'icon' => 'eicon-close',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended' => [
					'fa-solid' => [
						'window-close',
						'times-circle',
						'times',
						'minus-square',
						'minus-circle',
						'minus',
					],
					'fa-regular' => [
						'window-close',
						'times-circle',
						'minus-square',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/*------------------------------------------------------------------
		* Styling 
		* -----------------------------------------------------------------*/
		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label' => esc_html__( 'Main Menu', 'houzez-theme-functionality' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'dropdown',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .nav-link',
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

		$this->start_controls_tab(
			'tab_menu_item_normal',
			[
				'label' => esc_html__( 'Normal', 'houzez-theme-functionality' ),
			]
		);

		$this->add_control(
			'color_menu_item',
			[
				'label' => esc_html__( 'Text Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .nav-link' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_hover',
			[
				'label' => esc_html__( 'Hover', 'houzez-theme-functionality' ),
			]
		);

		$this->add_control(
			'color_menu_item_hover',
			[
				'label' => esc_html__( 'Text Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .nav-link:hover,
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .nav-link:focus' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => [
					'pointer!' => 'background',
				],
			]
		);

		$this->add_control(
			'color_menu_item_hover_pointer_bg',
			[
				'label' => esc_html__( 'Text Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .nav-link:hover,
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .nav-link:focus' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pointer' => 'background',
				],
			]
		);

		$this->add_control(
			'pointer_color_menu_item_hover',
			[
				'label' => esc_html__( 'Pointer Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pointer-background .navbar-nav > .nav-item:hover > a:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pointer-framed .navbar-nav > .nav-item:hover > a:before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .pointer-doubleline .navbar-nav > .nav-item:hover > a:before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .pointer-overline .navbar-nav > .nav-item:hover > a:before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .pointer-underline .navbar-nav > .nav-item:hover > a:before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'pointer!' => [ 'none', 'text' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_active',
			[
				'label' => esc_html__( 'Active', 'houzez-theme-functionality' ),
			]
		);

		$this->add_control(
			'color_menu_item_active',
			[
				'label' => esc_html__( 'Text Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .navbar-nav > li.current-menu-item .nav-link, 
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .navbar-nav > li.current-menu-ancestor .nav-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pointer_color_menu_item_active',
			[
				'label' => esc_html__( 'Pointer Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pointer-background .navbar-nav > .nav-item.current-menu-item > a:before, 
					{{WRAPPER}} .pointer-background .navbar-nav > .nav-item.current-menu-ancestor > a:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pointer-underline .navbar-nav > .nav-item.current-menu-item > a:before,
					{{WRAPPER}} .pointer-underline .navbar-nav > .nav-item.current-menu-ancestor > a:before,
					{{WRAPPER}} .pointer-overline .navbar-nav > .nav-item.current-menu-item > a:before, 
					{{WRAPPER}} .pointer-overline .navbar-nav > .nav-item.current-menu-ancestor > a:before,
					{{WRAPPER}} .pointer-doubleline .navbar-nav > .nav-item.current-menu-item > a:before, 
					{{WRAPPER}} .pointer-doubleline .navbar-nav > .nav-item.current-menu-ancestor > a:before,
					{{WRAPPER}} .pointer-framed .navbar-nav > .nav-item.current-menu-item > a:before,
					{{WRAPPER}} .pointer-framed .navbar-nav > .nav-item.current-menu-ancestor > a:before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'pointer!' => [ 'none', 'text' ],
				],
			]
		);
		

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$divider_condition = [
			'nav_menu_divider' => 'yes',
			'layout' => 'horizontal',
		];

		$this->add_control(
			'nav_menu_divider',
			[
				'label' => esc_html__( 'Divider', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'houzez-theme-functionality' ),
				'label_on' => esc_html__( 'On', 'houzez-theme-functionality' ),
				'condition' => [
					'layout' => 'horizontal',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--houzez-nav-menu-divider-content: "";',
				],
				'prefix_class' => 'houzez-menu-divider-',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'nav_menu_divider_style',
			[
				'label' => esc_html__( 'Style', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => esc_html__( 'Solid', 'houzez-theme-functionality' ),
					'double' => esc_html__( 'Double', 'houzez-theme-functionality' ),
					'dotted' => esc_html__( 'Dotted', 'houzez-theme-functionality' ),
					'dashed' => esc_html__( 'Dashed', 'houzez-theme-functionality' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}}' => '--houzez-nav-menu-divider-style: {{VALUE}}',
				],
				'condition' => $divider_condition,
			]
		);

		$this->add_control(
			'nav_menu_divider_weight',
			[
				'label' => esc_html__( 'Width', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => $divider_condition,
				'selectors' => [
					'{{WRAPPER}}' => '--houzez-nav-menu-divider-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'nav_menu_divider_height',
			[
				'label' => esc_html__( 'Height', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => $divider_condition,
				'selectors' => [
					'{{WRAPPER}}' => '--houzez-nav-menu-divider-height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'nav_menu_divider_color',
			[
				'label' => esc_html__( 'Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'condition' => $divider_condition,
				'selectors' => [
					'{{WRAPPER}}' => '--houzez-nav-menu-divider-color: {{VALUE}}',
				],
			]
		);

		/* This control is required to handle with complicated conditions */
		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'pointer_width',
			[
				'label' => esc_html__( 'Pointer Width', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pointer-framed .navbar-nav > .nav-item > a:before' => 'border-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .pointer-underline .navbar-nav > .nav-item > a:before' => 'border-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .pointer-doubleline .navbar-nav > .nav-item > a:before' => 'border-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .pointer-overline .navbar-nav > .nav-item > a:before' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'pointer' => [ 'underline', 'overline', 'doubleline', 'framed' ],
				],
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_menu_item',
			[
				'label' => esc_html__( 'Horizontal Padding', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .nav-link' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'padding_vertical_menu_item',
			[
				'label' => esc_html__( 'Vertical Padding', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .nav-link' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		/*$this->add_responsive_control(
			'menu_space_between',
			[
				'label' => esc_html__( 'Space Between', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--e-nav-menu-horizontal-menu-item-margin: calc( {{SIZE}}{{UNIT}} / 2 );',
					'{{WRAPPER}} .elementor-nav-menu--main:not(.elementor-nav-menu--layout-horizontal) .elementor-nav-menu > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);*/

		/*$this->add_responsive_control(
			'border_radius_menu_item',
			[
				'label' => esc_html__( 'Border Radius', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-item:before' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--animation-shutter-in-horizontal .elementor-item:before' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
					'{{WRAPPER}} .e--animation-shutter-in-horizontal .elementor-item:after' => 'border-radius: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--animation-shutter-in-vertical .elementor-item:before' => 'border-radius: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
					'{{WRAPPER}} .e--animation-shutter-in-vertical .elementor-item:after' => 'border-radius: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'pointer' => 'background',
				],
			]
		);*/

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => esc_html__( 'Dropdown', 'houzez-theme-functionality' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dropdown_description',
			[
				'raw' => esc_html__( 'On desktop, this will affect the submenu. On mobile, this will affect the entire menu.', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->start_controls_tabs( 'tabs_dropdown_item_style' );

		$this->start_controls_tab(
			'tab_dropdown_item_normal',
			[
				'label' => esc_html__( 'Normal', 'houzez-theme-functionality' ),
			]
		);

		$this->add_control(
			'color_dropdown_item',
			[
				'label' => esc_html__( 'Text Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu a, {{WRAPPER}} .houzez-menu-toggle, {{WRAPPER}} .houzez-nav-menu-layout-dropdown .mobile-navbar-nav a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_dropdown_item',
			[
				'label' => esc_html__( 'Background Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu, {{WRAPPER}} .houzez-nav-menu-layout-dropdown .mobile-navbar-nav' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_item_hover',
			[
				'label' => esc_html__( 'Hover', 'houzez-theme-functionality' ),
			]
		);

		$this->add_control(
			'color_dropdown_item_hover',
			[
				'label' => esc_html__( 'Text Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu a:hover,
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu a.item-active,
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu a.highlighted,

					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a:hover,
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a.item-active,
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a.highlighted,

					{{WRAPPER}} .houzez-menu-toggle:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_dropdown_item_hover',
			[
				'label' => esc_html__( 'Background Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a:hover,
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a.item-active,
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a.highlighted,

					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu a:hover,
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu a.item-active,
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu a.highlighted' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_item_active',
			[
				'label' => esc_html__( 'Active', 'houzez-theme-functionality' ),
			]
		);

		$this->add_control(
			'color_dropdown_item_active',
			[
				'label' => esc_html__( 'Text Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu li.current-menu-item a,
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu li.current-menu-ancestor a,
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav li.current-menu-item a,
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav li.current-menu-ancestor a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_dropdown_item_active',
			[
				'label' => esc_html__( 'Background Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu li.current-menu-item a,
					{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu li.current-menu-ancestor a,
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav li.current-menu-item a,
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav li.current-menu-ancestor a' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'dropdown_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'exclude' => [ 'line_height' ],
				'selector' => '{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu .dropdown-item, {{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dropdown_border',
				'selector' => '{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu, {{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .dropdown-menu',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'dropdown_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu, {{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .dropdown-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu li:first-child a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',

					'{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .dropdown-menu li:first-child a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',

					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu li:last-child a' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .dropdown-menu li:last-child a' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dropdown_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main .dropdown-menu, {{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .houzez-nav-menu-main .dropdown-menu',
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_dropdown_item',
			[
				'label' => esc_html__( 'Horizontal Padding', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu > li > a, {{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',

			]
		);

		$this->add_responsive_control(
			'padding_vertical_dropdown_item',
			[
				'label' => esc_html__( 'Vertical Padding', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu > li > a, {{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .mobile-navbar-nav a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_dropdown_divider',
			[
				'label' => esc_html__( 'Divider', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dropdown_divider',
				'selector' => '{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu > li:not(:last-child), 
				{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .houzez-nav-menu-layout-dropdown .nav-item:not(:last-child)',
				'exclude' => [ 'width' ],
			]
		);

		$this->add_control(
			'dropdown_divider_width',
			[
				'label' => esc_html__( 'Border Width', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .dropdown-menu > li:not(:last-child), 
					{{WRAPPER}} .houzez-nav-menu-main-mobile-wrap .houzez-nav-menu-layout-dropdown .nav-item:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'dropdown_divider_border!' => '',
				],
			]
		);

		/*$this->add_responsive_control(
			'dropdown_top_distance',
			[
				'label' => esc_html__( 'Distance', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-nav-menu-main-desktop-wrap .houzez-nav-menu-main > .houzez-elementor-menu > li > .dropdown-menu' => 'margin-top: {{SIZE}}{{UNIT}} !important',
				],
				'separator' => 'before',
			]
		);*/

		$this->end_controls_section();

		$this->start_controls_section( 'style_toggle',
			[
				'label' => esc_html__( 'Toggle Button', 'houzez-theme-functionality' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'mobile-menu-breakpoint!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_toggle_btn',
			[
				'label' => esc_html__( 'Horizontal Padding', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',

			]
		);

		$this->add_responsive_control(
			'padding_vertical_toggle_btn',
			[
				'label' => esc_html__( 'Vertical Padding', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'tab_toggle_style_normal',
			[
				'label' => esc_html__( 'Normal', 'houzez-theme-functionality' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label' => esc_html__( 'Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label' => esc_html__( 'Background Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_style_hover',
			[
				'label' => esc_html__( 'Hover', 'houzez-theme-functionality' ),
			]
		);

		$this->add_control(
			'toggle_color_hover',
			[
				'label' => esc_html__( 'Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button:hover' => 'color: {{VALUE}}', // Harder selector to override text color control
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			[
				'label' => esc_html__( 'Size', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'toggle_border_width',
			[
				'label' => esc_html__( 'Border Width', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button' => 'border-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .houzez-menu-toggle .houzez-menu-toggle-button' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $menus = $this->get_available_menus();

		if ( empty( $menus ) ) {
			return;
		}

		$token = wp_generate_password(5, false, false);

		$settings = $this->get_active_settings();

		$show_desktop = $show_menu_desktop = $show_menu_tablet = $mb_fullwidth = '';
		$mobile_menu_breakpoint = $settings['mobile-menu-breakpoint'];
		$layout = $settings['layout'];

		if( $layout == 'dropdown' ) {
			$mb_fullwidth = 'houzez-nav-mobile-menu-fullwidth';
		}
		$args = [
			'menu' => $settings['menu_slug'],
			'menu_class' => 'navbar-nav houzez-elementor-menu',
			'menu_id' => 'main-nav-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container' => '',
			'echo' => false,
			'depth' => 4,
			'walker' => new Classes\houzez_plugin_nav_walker()
		];

		$menu_html = wp_nav_menu( $args );

		$mobile_args = [
			'menu' => $settings['menu_slug'],
			'menu_class' => 'navbar-nav mobile-navbar-nav houzez-elementor-mobile-menu',
			'menu_id' => 'main-mobile-nav-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container' => '',
			'echo' => false,
			'depth' => 4,
			'walker' => new Classes\houzez_plugin_mobile_nav_walker()
		];

		$mobile_menu_html = wp_nav_menu( $mobile_args );

		if ( empty( $menu_html ) ) {
			return;
		}

		if( $mobile_menu_breakpoint == 'mobile' ) {
			$show_menu_desktop = 'hz-show-menu-desktop';
			$show_menu_tablet = 'hz-show-menu-tablet';
		} else if( $mobile_menu_breakpoint == 'tablet' ) {
			$show_menu_desktop = 'hz-show-menu-desktop';
		}

		$this->add_render_attribute( 'main-menu', 'class', [
			'main-ele-nav', 
			'houzez-nav-menu-main',
			'on-hover-menu',
			'with-'.$settings['submenu_icon'].'-icon',
		] );

		if( $layout && $layout != 'dropdown' ) {
			$this->add_render_attribute( 'main-menu', 'class', 'houzez-nav-menu-layout-'.$layout );
		}

		if( $settings['animation_line'] ) {
			$this->add_render_attribute( 'main-menu', 'class', 'animation-'.$settings['animation_line'] );
		}

		if( $settings['animation_framed'] ) {
			$this->add_render_attribute( 'main-menu', 'class', 'animation-'.$settings['animation_framed'] );
		}

		if( $settings['animation_background'] ) {
			$this->add_render_attribute( 'main-menu', 'class', 'animation-'.$settings['animation_background'] );
		}

		if( $settings['animation_text'] ) {
			$this->add_render_attribute( 'main-menu', 'class', 'animation-'.$settings['animation_text'] );
		}

		if( $settings['pointer'] ) {
			$this->add_render_attribute( 'main-menu', 'class', 'pointer-'.$settings['pointer'] );
		}

		if( $layout == 'dropdown' ) {
			$show_desktop = 'houzez-show-menu-desktop';
		}

		$this->add_render_attribute( 'main-mobile-menu', 'class', [
			'main-nav',
			'main-mobile-nav',
			'navbar',
			'houzez-nav-menu-main',
			'houzez-nav-menu-container',
			'houzez-nav-menu-layout-dropdown',
		] );
		?>

     	<?php if( $layout && $layout != 'dropdown' ) { ?>
        <div class="houzez-ele-menu-<?php echo esc_attr( $this->get_id() ); ?> houzez-nav-menu-main-desktop-wrap houzez-hide-menu-<?php echo esc_attr($mobile_menu_breakpoint); ?> <?php echo esc_attr($show_menu_desktop);?> <?php echo esc_attr($show_menu_tablet);?>">
	    	<nav <?php $this->print_render_attribute_string( 'main-menu' ); ?> role="navigation" aria-hidden="false">
				<?php
					// PHPCS - escaped by WordPress with "wp_nav_menu"
					echo $menu_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		</div><!-- houzez-nav-menu-main-desktop-wrap -->
		<?php } ?>

		<?php if( 'none' !== $mobile_menu_breakpoint || $layout == 'dropdown' ) { ?>
		<div class="houzez-ele-mobile-menu-<?php echo esc_attr( $this->get_id() ); ?> hz-ele-js-<?php echo esc_attr($token);?> houzez-nav-menu-main-mobile-wrap nav-mobile houzez-nav-menu-align-<?php echo esc_attr($settings['mobile_toggle_align']); ?> houzez-show-menu-<?php echo esc_attr($mobile_menu_breakpoint); ?> <?php echo esc_attr($show_desktop); ?> <?php echo esc_attr($mb_fullwidth);?>">
			<div id="houzez_toggle" class="houzez-menu-toggle">
				<div class="houzez-menu-toggle-button">
				<?php
				if ( ! empty( $settings['toggle_icon_normal']['value'] ) || ! empty( $settings['toggle_icon_active']['value'] ) ) {
					
					if( ! empty( $settings['toggle_icon_normal']['value'] )  ) {
						echo self::houzez_render_menu_icon($settings['toggle_icon_normal'], ['class' => 'hz-navigation-open'] );
					}
					if( ! empty( $settings['toggle_icon_active']['value'] )  ) {
						echo self::houzez_render_menu_icon($settings['toggle_icon_active'], ['class' => 'hz-navigation-close'] );
					}
					
				} else {
					?>
                    <i class="houzez-icon icon-navigation-menu hz-navigation-open"></i>
					<i class="houzez-icon icon-close hz-navigation-close"></i>
					<?php
				}
				?>
				</div>
			</div>
		    <nav <?php $this->print_render_attribute_string( 'main-mobile-menu' ); ?> role="navigation" aria-hidden="false">
				<?php
					// PHPCS - escaped by WordPress with "wp_nav_menu"
					echo $mobile_menu_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		</div><!-- houzez-nav-menu-main-mobile-wrap -->
		<?php
		}

		if ( Plugin::$instance->editor->is_edit_mode() ) : 
            ?>
            <script>
			    jQuery(document).ready(function() {
			    	jQuery('.hz-ele-js-<?php echo esc_attr($token);?> .houzez-menu-toggle').click(function (e) {
				        jQuery('.hz-ele-js-<?php echo esc_attr($token);?> .navbar-nav, .hz-ele-js-<?php echo esc_attr($token);?> .houzez-menu-toggle').toggleClass('houzez-nav-menu-active');
				    });
			    });
			</script>
        
        <?php endif; 

    }

    public static function houzez_render_menu_icon( $icon, $attributes = [], $tag = 'i' ) {

		if ( empty( $icon['library'] ) ) {
			return false;
		}

		$output = '';
		// handler SVG Icon
		if ( 'svg' === $icon['library'] ) {
			$output = self::houzez_render_svg_icon( $icon['value'] );
		} else {
			$output = self::houzez_render_icon_html( $icon, $attributes, $tag );
		}

		return $output;
	}

	private static function houzez_render_icon_html( $icon, $attributes = [], $tag = 'i' ) {
		$icon_types = \Elementor\Icons_Manager::get_icon_manager_tabs();
		if ( isset( $icon_types[ $icon['library'] ]['render_callback'] ) && is_callable( $icon_types[ $icon['library'] ]['render_callback'] ) ) {
			return call_user_func_array( $icon_types[ $icon['library'] ]['render_callback'], [ $icon, $attributes, $tag ] );
		}

		if ( empty( $attributes['class'] ) ) {
			$attributes['class'] = $icon['value'];
		} else {
			if ( is_array( $attributes['class'] ) ) {
				$attributes['class'][] = $icon['value'];
			} else {
				$attributes['class'] .= ' ' . $icon['value'];
			}
		}
		return '<' . $tag . ' ' . self::houzez_render_html_attributes( $attributes ) . '></' . $tag . '>';
	}

	private static function houzez_render_svg_icon( $value ) {
		if ( ! isset( $value['id'] ) ) {
			return '';
		}

		return Svg_Handler::get_inline_svg( $value['id'] );
	}

	private static function houzez_render_html_attributes( array $attributes ) {
		$rendered_attributes = [];

		foreach ( $attributes as $attribute_key => $attribute_values ) {
			if ( is_array( $attribute_values ) ) {
				$attribute_values = implode( ' ', $attribute_values );
			}

			$rendered_attributes[] = sprintf( '%1$s="%2$s"', $attribute_key, esc_attr( $attribute_values ) );
		}

		return implode( ' ', $rendered_attributes );
	}

	/**
	 * Retrieve the meta icon based on configuration from the options.
	 *
	 * @since 2.8.5
	 *
	 * @param string $key     The key to identify the specific icon setting.
	 * @param string $default The default icon value.
	 *
	 * @return string
	 */
	private function fetch_configured_meta_icon($key, $default) {
	    $configurations = $this->get_settings_for_display();
	    $configuredIcon = $configurations[$key];
	    $iconRepresentation = $default;

	    if (!empty($configuredIcon['value'])) {
	        ob_start();
	        \Elementor\Icons_Manager::render_icon($configuredIcon, ['aria-hidden' => 'true']);
	        $iconRepresentation = ob_get_clean();
	    } else {
	        $iconRepresentation = sprintf('<i class="%s"></i>', esc_attr($default));
	    }

	    return $iconRepresentation;
	}

}

Plugin::instance()->widgets_manager->register( new Houzez_Menu );
