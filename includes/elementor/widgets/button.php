<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

class Lia_Button_Widget extends Widget_Base {

    public function get_name() {
        return 'lia-button';
    }

    public function get_title() {
        return __( 'Lia Button', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-button';
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
            'button_text',
            [
                'label'       => __( 'Button Text', 'lia-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Click Here', 'lia-core' ),
                'placeholder' => __( 'Enter button text', 'lia-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'       => __( 'Button Link', 'lia-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'lia-core' ),
                'default'     => [
                    'url'         => '#',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label'   => __( 'Button Style', 'lia-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'btn-accent',
                'options' => [
                    'btn-accent'          => __( 'Accent Gradient', 'lia-core' ),
                    'btn-accent-outline'  => __( 'Accent Outline', 'lia-core' ),
                    'btn-accent-2'        => __( 'Accent 2 (Light)', 'lia-core' ),
                    'btn-accent-3'        => __( 'Accent 3 (Dark)', 'lia-core' ),
                    'btn-rounded'         => __( 'Rounded Icon', 'lia-core' ),
                    'btn-block'           => __( 'Block', 'lia-core' ),
                ],
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'        => __( 'Show Icon', 'lia-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'lia-core' ),
                'label_off'    => __( 'No', 'lia-core' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition'    => [
                    'button_style!' => 'btn-rounded',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'       => __( 'Icon', 'lia-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'     => __( 'Icon Position', 'lia-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'after',
                'options'   => [
                    'before' => __( 'Before Text', 'lia-core' ),
                    'after'  => __( 'After Text', 'lia-core' ),
                ],
                'condition' => [
                    'show_icon' => 'yes',
                    'button_style!' => 'btn-rounded',
                ],
            ]
        );

        $this->add_control(
            'rounded_icon',
            [
                'label'       => __( 'Icon', 'lia-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'button_style' => 'btn-rounded',
                ],
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
                    'left'   => [
                        'title' => __( 'Left', 'lia-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'lia-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'lia-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .lia-button-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Size Section
        $this->start_controls_section(
            'section_size',
            [
                'label' => __( 'Size', 'lia-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label'      => __( 'Width', 'lia-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .lia-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'button_style!' => [ 'btn-rounded', 'btn-block' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'rounded_size',
            [
                'label'      => __( 'Size', 'lia-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => 30,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .lia-button.btn-rounded' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'button_style' => 'btn-rounded',
                ],
            ]
        );

        $this->end_controls_section();

        // Typography Section
        $this->start_controls_section(
            'section_typography',
            [
                'label' => __( 'Typography', 'lia-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'      => 'button_typography',
                'label'     => __( 'Typography', 'lia-core' ),
                'selector'  => '{{WRAPPER}} .lia-button',
                'condition' => [
                    'button_style!' => 'btn-rounded',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __( 'Icon Size', 'lia-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .lia-button i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .lia-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => __( 'Icon Spacing', 'lia-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .lia-button .lia-btn-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .lia-button .lia-btn-icon-after'  => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        
        // Button link attributes
        $button_target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $button_nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        
        // Button classes
        $button_classes = [ 'lia-button', 'btn', $settings['button_style'] ];
        
        // Icon rendering
        $icon_html = '';
        $icon_class = '';
        
        if ( $settings['button_style'] === 'btn-rounded' && ! empty( $settings['rounded_icon']['value'] ) ) {
            $icon_html = Icons_Manager::try_get_icon_html( $settings['rounded_icon'], [ 'aria-hidden' => 'true' ] );
        } elseif ( $settings['show_icon'] === 'yes' && ! empty( $settings['icon']['value'] ) ) {
            $icon_html = Icons_Manager::try_get_icon_html( $settings['icon'], [ 'aria-hidden' => 'true' ] );
            $icon_class = 'lia-btn-icon-' . $settings['icon_position'];
        }
        
        // Button content
        $button_content = '';
        
        if ( $settings['button_style'] === 'btn-rounded' ) {
            $button_content = '<a href="' . esc_url( $settings['button_link']['url'] ) . '"' . $button_target . $button_nofollow . '>' . $icon_html . '</a>';
        } else {
            $before_text = ( $settings['icon_position'] === 'before' && $icon_html ) ? '<span class="lia-btn-icon-before">' . $icon_html . '</span>' : '';
            $after_text = ( $settings['icon_position'] === 'after' && $icon_html ) ? '<span class="lia-btn-icon-after">' . $icon_html . '</span>' : '';
            
            $button_content = $before_text . '<span class="lia-btn-text">' . esc_html( $settings['button_text'] ) . '</span>' . $after_text;
        }

        ?>
        <div class="lia-button-wrapper">
            <?php if ( $settings['button_style'] === 'btn-rounded' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $button_classes ) ); ?>">
                    <?php echo $button_content; ?>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" 
                   class="<?php echo esc_attr( implode( ' ', $button_classes ) ); ?>" 
                   <?php echo $button_target . $button_nofollow; ?>>
                    <?php echo $button_content; ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        // Button link attributes
        var button_target = settings.button_link.is_external ? ' target="_blank"' : '';
        var button_nofollow = settings.button_link.nofollow ? ' rel="nofollow"' : '';
        
        // Button classes
        var button_classes = ['lia-button', 'btn', settings.button_style];
        
        // Icon rendering
        var iconHTML = '';
        var iconClass = '';
        
        if (settings.button_style === 'btn-rounded' && settings.rounded_icon.value) {
            iconHTML = elementor.helpers.renderIcon(view, settings.rounded_icon, { 'aria-hidden': true }, 'i', 'object');
        } else if (settings.show_icon === 'yes' && settings.icon.value) {
            iconHTML = elementor.helpers.renderIcon(view, settings.icon, { 'aria-hidden': true }, 'i', 'object');
            iconClass = 'lia-btn-icon-' + settings.icon_position;
        }
        
        // Button content
        var buttonContent = '';
        
        if (settings.button_style === 'btn-rounded') {
            buttonContent = '<a href="' + settings.button_link.url + '"' + button_target + button_nofollow + '>' + iconHTML.value + '</a>';
        } else {
            var beforeText = (settings.icon_position === 'before' && iconHTML.value) ? '<span class="lia-btn-icon-before">' + iconHTML.value + '</span>' : '';
            var afterText = (settings.icon_position === 'after' && iconHTML.value) ? '<span class="lia-btn-icon-after">' + iconHTML.value + '</span>' : '';
            
            buttonContent = beforeText + '<span class="lia-btn-text">' + settings.button_text + '</span>' + afterText;
        }
        #>
        
        <div class="lia-button-wrapper">
            <# if (settings.button_style === 'btn-rounded') { #>
                <div class="{{ button_classes.join(' ') }}">
                    {{{ buttonContent }}}
                </div>
            <# } else { #>
                <a href="{{ settings.button_link.url }}" 
                   class="{{ button_classes.join(' ') }}" 
                   {{{ button_target }}} {{{ button_nofollow }}}>
                    {{{ buttonContent }}}
                </a>
            <# } #>
        </div>
        <?php
    }
}