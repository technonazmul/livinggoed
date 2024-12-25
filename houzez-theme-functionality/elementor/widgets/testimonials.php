<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Testimonials Widget.
 * @since 1.5.6
 */
class Houzez_Elementor_Testimonials extends Widget_Base {
    use Houzez_Testimonials_Traits;

    /**
     * Get widget name.
     *
     * Retrieve widget name.
     *
     * @since 1.5.6
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'houzez_elementor_testimonials';
    }

    /**
     * Get widget title.
     * @since 1.5.6
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Testimonials v1', 'houzez-theme-functionality' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.5.6
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'houzez-element-icon eicon-testimonial';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to.
     *
     * @since 1.5.6
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
     * @since 1.5.6
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label'     => esc_html__( 'Content', 'houzez-theme-functionality' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testimonials_type',
            [
                'label'     => esc_html__( 'Testimonials Type', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'grid'  => esc_html__( 'Grid 4 Columns', 'houzez-theme-functionality'),
                    'grid_3cols'  => esc_html__( 'Grid 3 Columns', 'houzez-theme-functionality'),
                    'slides'    => esc_html__( 'Slides', 'houzez-theme-functionality')
                ],
                'default' => 'grid',
            ]
        );

        $this->houzez_testimonials_content_controls();
        
        $this->end_controls_section();

        $this->houzez_testimonials_content_style_controls();

        $this->start_controls_section(
            'section_style_testimonial_image',
            [
                'label' => esc_html__( 'Image', 'houzez-theme-functionality' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label' => esc_html__( 'Image Resolution', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-thumb img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->houzez_testimonials_image_style_controls();

        $this->end_controls_section();

        $this->houzez_testimonials_name_style_controls();

        $this->houzez_testimonials_job_style_controls();

    }

    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.5.6
     * @access protected
     */
    protected function render() {

        global $houzez_local;
        $settings = $this->get_settings_for_display();
        $houzez_local = houzez_get_localization();
                
        $args['testimonials_type']        =  $settings['testimonials_type'];
        $args['posts_limit']     =  $settings['posts_limit'];
        $args['offset']  =  $settings['offset'];
        $args['orderby']  =  $settings['orderby'];
        $args['order']  =  $settings['order'];
       
        if( function_exists( 'houzez_testimonials' ) ) {
            echo houzez_testimonials( $args );
        }

        if ( Plugin::$instance->editor->is_edit_mode() ) : 
            $token = wp_generate_password(5, false, false);
            ?>

            <style>
                .slide-animated {
                    opacity: 1;
                }
            </style>
            <script>
                var houzez_rtl = houzez_vars.houzez_rtl;

                if( houzez_rtl == 'yes' ) {
                    houzez_rtl = true;
                } else {
                    houzez_rtl = false;
                }
                jQuery('.testimonials-slider-wrap-v1').slick({
                    rtl: houzez_rtl,
                    lazyLoad: 'ondemand',
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    arrows: true,
                    adaptiveHeight: true,
                    dots: true,
                    appendArrows: '.testimonials-module-slider-v1',
                    prevArrow: jQuery('.slick-prev'),
                    nextArrow: jQuery('.slick-next'),
                });
            
            </script>
        
        <?php endif;

    }

}

Plugin::instance()->widgets_manager->register( new Houzez_Elementor_Testimonials );