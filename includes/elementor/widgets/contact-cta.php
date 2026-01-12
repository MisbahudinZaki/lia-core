<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Lia_Contact_CTA_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lia-contact-cta';
    }

    public function get_title() {
        return esc_html__( 'LIA Contact CTA', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'lia-elements' ];
    }

    public function get_keywords() {
        return [ 'contact', 'cta', 'banner', 'call to action', 'lia' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'lia-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => esc_html__( 'Enter your title.', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter your title', 'lia-core' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => esc_html__( 'Enter your description', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter your description', 'lia-core' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Discover More', 'lia-core' ),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Button Link', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'lia-core' ),
                'default' => [
                    'url' => './contact.html',
                ],
                'show_external' => true,
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__( 'Background Image (Banner)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'description' => esc_html__( 'This image will be used as the full background of the CTA section.', 'lia-core' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $bg_image = ! empty( $settings['background_image']['url'] ) 
            ? ' style="background-image: url(' . esc_url( $settings['background_image']['url'] ) . ');"' 
            : '';

        $button_target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $button_nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        <div class="section contactus-banner"<?php echo $bg_image; ?>>
            <div class="hero-container">
                <div class="contactus-content">
                    <h3 class="animate-box animated animate__animated" data-animate="animate__fadeInUp">
                        <?php echo wp_kses_post( $settings['title'] ); ?>
                    </h3>
                    <p class="animate-box animated animate__animated" data-animate="animate__fadeInUp">
                        <?php echo wp_kses_post( $settings['description'] ); ?>
                    </p>
                    <div>
                        <a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>"
                           class="btn btn-accent"
                           <?php echo $button_target . $button_nofollow; ?>>
                            <?php echo esc_html( $settings['button_text'] ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}