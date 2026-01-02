<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Lia_Title_Widget extends Widget_Base {

    public function get_name() {
        return 'lia-title';
    }

    public function get_title() {
        return __( 'Lia Title', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return [ 'lia-elements' ];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'lia-core' ),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label'       => __( 'Sub Heading', 'lia-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Sub Heading', 'lia-core' ),
                'placeholder' => __( 'Enter your sub heading', 'lia-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'       => __( 'Heading', 'lia-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Heading', 'lia-core' ),
                'placeholder' => __( 'Enter your main heading', 'lia-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading_tag',
            [
                'label'   => __( 'Heading HTML Tag', 'lia-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => __( 'H1', 'lia-core' ),
                    'h2' => __( 'H2', 'lia-core' ),
                    'h3' => __( 'H3', 'lia-core' ),
                    'h4' => __( 'H4', 'lia-core' ),
                    'h5' => __( 'H5', 'lia-core' ),
                    'h6' => __( 'H6', 'lia-core' ),
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __( 'Description', 'lia-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Ipsum suspendisse ultrices gravida dictum fusce ut. Convallis a cras semper auctor. Sapien eget mi proin sed libero enim sed faucibus turpis. Tellus orci ac auctor augue mauris augue neque gravida.', 'lia-core' ),
                'placeholder' => __( 'Enter your description', 'lia-core' ),
                'rows'        => 5,
            ]
        );

        $this->end_controls_section();

        // Alignment Section
        $this->start_controls_section(
            'section_alignment',
            [
                'label' => __( 'Alignment', 'lia-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => __( 'Alignment', 'lia-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __( 'Left', 'lia-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => __( 'Center', 'lia-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __( 'Right', 'lia-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .content-heading-container' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        
        // Validasi heading tag untuk security
        $allowed_tags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];
        $heading_tag = in_array( $settings['heading_tag'], $allowed_tags ) ? $settings['heading_tag'] : 'h3';

        ?>
        <div class="content-heading-container">
            <?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
                <h6 class="sub-heading"><?php echo esc_html( $settings['sub_heading'] ); ?></h6>
            <?php endif; ?>
            
            <?php if ( ! empty( $settings['heading'] ) ) : ?>
                <<?php echo esc_attr( $heading_tag ); ?>>
                    <?php echo esc_html( $settings['heading'] ); ?>
                </<?php echo esc_attr( $heading_tag ); ?>>
            <?php endif; ?>
            
            <?php if ( ! empty( $settings['description'] ) ) : ?>
                <p><?php echo wp_kses_post( $settings['description'] ); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var align_class = '';
        switch(settings.align) {
            case 'flex-start':
                align_class = 'text-left';
                break;
            case 'center':
                align_class = 'text-center';
                break;
            case 'flex-end':
                align_class = 'text-right';
                break;
        }
        
        // Validasi heading tag
        var allowed_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
        var heading_tag = allowed_tags.indexOf(settings.heading_tag) !== -1 ? settings.heading_tag : 'h3';
        #>
        <div class="content-heading-container">
            <# if ( settings.sub_heading ) { #>
                <h6 class="sub-heading">{{{ settings.sub_heading }}}</h6>
            <# } #>
            
            <# if ( settings.heading ) { #>
                <{{{ heading_tag }}}>{{{ settings.heading }}}</{{{ heading_tag }}}>
            <# } #>
            
            <# if ( settings.description ) { #>
                <p>{{{ settings.description }}}</p>
            <# } #>
        </div>
        <?php
    }
}