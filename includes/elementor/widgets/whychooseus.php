<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Utils;

class Lia_Why_Choose_Us_Widget extends Widget_Base {

    public function get_name() {
        return 'lia-why-choose-us';
    }

    public function get_title() {
        return __( 'Why Choose Us', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-check-circle';
    }

    public function get_categories() {
        return [ 'lia-elements' ];
    }

    protected function register_controls() {

        /* =====================
         * CONTENT
         * ===================== */
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'lia-core' ),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => __( 'Sub Heading', 'lia-core' ),
                'type'  => Controls_Manager::TEXT,
                'default' => __( 'Value', 'lia-core' ),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => __( 'Heading', 'lia-core' ),
                'type'  => Controls_Manager::TEXT,
                'default' => __( 'Driving Your Success in the Digital Age', 'lia-core' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'lia-core' ),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => __( 'Pellentesque adipiscing commodo elit at...', 'lia-core' ),
            ]
        );

        $this->end_controls_section();

        /* =====================
         * CARDS
         * ===================== */
        $this->start_controls_section(
            'section_cards',
            [
                'label' => __( 'Choose Us Cards', 'lia-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'lia-core' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'lia-core' ),
                'type'  => Controls_Manager::TEXT,
                'default' => __( 'Expertise', 'lia-core' ),
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => __( 'Description', 'lia-core' ),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => __( 'Ipsum suspendisse ultrices gravida...', 'lia-core' ),
            ]
        );

        $repeater->add_control(
            'highlight',
            [
                'label' => __( 'Highlight Card', 'lia-core' ),
                'type'  => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'cards',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [],
                    [],
                    [],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        /* =====================
         * IMAGE
         * ===================== */
        $this->start_controls_section(
            'section_image',
            [
                'label' => __( 'Main Image', 'lia-core' ),
            ]
        );

        $this->add_control(
            'main_image',
            [
                'label' => __( 'Choose Us Image', 'lia-core' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        /* =====================
         * BACKGROUND
         * ===================== */
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Background', 'lia-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'selector' => '{{WRAPPER}} .whychooseus-banner',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        ?>

        <div class="section whychooseus-banner">
            <div class="hero-container">
                <div class="whychooseus-wrapper">

                    <div class="chooseus-details">
                        <h6 class="sub-heading"><?php echo esc_html( $settings['sub_heading'] ); ?></h6>
                        <h3><?php echo esc_html( $settings['heading'] ); ?></h3>
                        <p><?php echo esc_html( $settings['description'] ); ?></p>

                        <?php foreach ( $settings['cards'] as $card ) :
                            $card_class = 'card card-chooseus';
                            if ( $card['highlight'] === 'yes' ) {
                                $card_class .= ' highlight';
                            }
                        ?>
                            <div class="<?php echo esc_attr( $card_class ); ?>">
                                <div class="chooseus-icon">
                                    <img src="<?php echo esc_url( $card['icon']['url'] ); ?>" class="img-fluid" alt="">
                                </div>
                                <div class="d-flex flex-column gspace-2">
                                    <h5><?php echo esc_html( $card['title'] ); ?></h5>
                                    <p><?php echo esc_html( $card['text'] ); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div class="chooseus-image-layout">
                        <div class="chooseus-image-header">
                            <i class="fa-solid fa-circle"></i>
                        </div>

                        <div class="image-container chooseus-image">
                            <img src="<?php echo esc_url( $settings['main_image']['url'] ); ?>" class="img-fluid" alt="">
                        </div>

                        <div class="chooseus-image-footer">
                            <div class="icon-wrapper">
                                <i class="fa-regular fa-square"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php
    }
}