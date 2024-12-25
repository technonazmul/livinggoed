<?php
namespace Elementor;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Property_Section_Description extends Widget_Base {
    use \HouzezThemeFunctionality\Elementor\Traits\Houzez_Preview_Query;
    use Houzez_Style_Traits;

	public function get_name() {
		return 'houzez-property-section-description';
	}

	public function get_title() {
		return __( 'Section Description', 'houzez-theme-functionality' );
	}

	public function get_icon() {
		return 'houzez-element-icon eicon-featured-image';
	}

	public function get_categories() {
		if(get_post_type() === 'fts_builder' && htb_get_template_type(get_the_id()) === 'single-listing')  {
            return ['houzez-single-property-builder']; 
        }

        return [ 'houzez-single-property' ];
	}

	public function get_keywords() {
		return ['property', 'description', 'houzez' ];
	}

	protected function register_controls() {
		parent::register_controls();


		$this->start_controls_section(
            'attachments_content',
            [
                'label' => __( 'Content', 'houzez-theme-functionality' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
            'section_header',
            [
                'label' => esc_html__( 'Section Header', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Section Title', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => '',
                'condition' => [
                	'section_header' => 'true'
                ],
            ]
        );


        $this->add_control(
            'section_attachments',
            [
                'label' => esc_html__( 'Show Attachments', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'attachment_title',
            [
                'label' => esc_html__( 'Attachment Title', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => '',
                'condition' => [
                    'section_attachments' => 'true'
                ],
            ]
        );

        $this->add_control(
            'download_text',
            [
                'label' => esc_html__( 'Download Text', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => '',
                'condition' => [
                    'section_attachments' => 'true'
                ],
            ]
        );

        $this->end_controls_section();

	
		$this->start_controls_section(
            'sec_style',
            [
                'label' => __( 'Section Style', 'houzez-theme-functionality' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->houzez_single_property_section_styling_traits();

		$this->end_controls_section();

		$this->start_controls_section(
            'content_style',
            [
                'label' => __( 'Content Style', 'houzez-theme-functionality' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'heading_section_title',
			[
				'label' => esc_html__( 'Section Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
            'sec_title_color',
            [
                'label'     => esc_html__( 'Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .block-title-wrap h2, .block-title-wrap h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => esc_html__( 'Typography', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .block-title-wrap h2, .block-title-wrap h3',
            ]
        );

        $this->add_control(
			'heading_text',
			[
				'label' => esc_html__( 'Text', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
            'des_color',
            [
                'label'     => esc_html__( 'Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .block-content-wrap p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'des_typo',
                'label'    => esc_html__( 'Typography', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .block-content-wrap p',
            ]
        );

        $this->add_responsive_control(
            'prop_content_align',
            [
                'label' => __( 'Alignment', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'houzez-theme-functionality' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'houzez-theme-functionality' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'houzez-theme-functionality' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'houzez-theme-functionality' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hzele-property-content-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_doc',
            [
                'label' => esc_html__( 'Documents Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'doc_color',
            [
                'label'     => esc_html__( 'Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .property-document-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'doc_typo',
                'label'    => esc_html__( 'Typography', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .property-document-title',
            ]
        );

        $this->add_control(
            'doc_link_color',
            [
                'label'     => esc_html__( 'Link Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .property-document-link a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'doc_link_typo',
                'label'    => esc_html__( 'Link Typography', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} .property-document-link a',
            ]
        );

      

		$this->end_controls_section();

	}

	protected function render() {
		
		global $post;

		$settings = $this->get_settings_for_display();

		$ele_settings = $settings;

        $this->single_property_preview_query(); // Only for preview

		$section_title = isset($settings['section_title']) && !empty($settings['section_title']) ? $settings['section_title'] : houzez_option('sps_description', 'Description');

        $attachment_title = isset($settings['attachment_title']) && !empty($settings['attachment_title']) ? $settings['attachment_title'] : houzez_option('sps_documents', 'Property Documents');

        $download_text = isset($settings['download_text']) && !empty($settings['download_text']) ? $settings['download_text'] : esc_html__( 'Download', 'houzez' );

        $section_attachments = $settings['section_attachments'];

        $attachments = get_post_meta( $post->ID, 'fave_attachments', false);
        $documents_download = houzez_option('documents_download');
        ?>
        <div class="property-description-wrap property-section-wrap" id="property-description-wrap">
            <div class="block-wrap">
                
                <?php if( $settings['section_header'] ) { ?>
                <div class="block-title-wrap">
                    <h2><?php echo $section_title; ?></h2> 
                </div>
                <?php } ?>

                <div class="block-content-wrap">
                    <div class="hzele-property-content-wrap">
                        <?php the_content(); ?>
                    </div>

                    <?php 
                    if(!empty($attachments) && $section_attachments) { ?>

                        <?php if( $settings['section_header'] ) { ?>
                        <div class="block-title-wrap block-title-property-doc">
                            <h3><?php echo $attachment_title; ?></h3>
                        </div>
                        <?php } ?>

                        <?php 
                        foreach( $attachments as $attachment_id ) {
                            $attachment_meta = houzez_get_attachment_metadata($attachment_id); 

                            if(!empty($attachment_meta )) {
                            ?>
                            <div class="property-documents">
                                <div class="d-flex justify-content-between">
                                    <div class="property-document-title">
                                        <i class="houzez-icon icon-task-list-plain-1 mr-1"></i> <?php echo esc_attr( $attachment_meta->post_title ); ?>
                                    </div>
                                    <div class="property-document-link login-link">
                                        
                                        <?php if( $documents_download == 1 ) {
                                            if( is_user_logged_in() ) { ?>
                                            <a href="<?php echo esc_url( $attachment_meta->guid ); ?>" target="_blank"><?php echo $download_text; ?></a>
                                            <?php } else { ?>
                                                <a href="#" data-toggle="modal" data-target="#login-register-form"><?php echo $download_text; ?></a>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <a href="<?php echo esc_url( $attachment_meta->guid ); ?>" target="_blank"><?php echo $download_text; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } }?>
                        
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        $this->reset_preview_query(); // Only for preview
	}

}
Plugin::instance()->widgets_manager->register( new Property_Section_Description );