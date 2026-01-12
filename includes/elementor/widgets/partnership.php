<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Lia_Core_Partnership_Slider extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lia-partnership-slider';
    }

    public function get_title() {
        return __( 'Partnership Slider', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'lia-core' ];
    }

    public function get_style_depends() {
        return [ 'lia-swiper' ];
    }

    public function get_script_depends() {
        return [ 'lia-swiper' ];
    }

    protected function register_controls() {

        /* =======================
         * Partner Logos
         * ======================= */
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'logo',
            [
                'label' => __( 'Logo', 'lia-core' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'partners',
            [
                'label' => __( 'Partner Logos', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [ 'logo' => [] ],
                    [ 'logo' => [] ],
                    [ 'logo' => [] ],
                ],
                'title_field' => __( 'Partner Logo', 'lia-core' ),
            ]
        );

        /* =======================
         * Slider Settings
         * ======================= */
        $this->add_control(
            'slides_desktop',
            [
                'label' => __( 'Slides (Desktop)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'min' => 1,
            ]
        );

        $this->add_control(
            'slides_tablet',
            [
                'label' => __( 'Slides (Tablet ≤1024px)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
            ]
        );

        $this->add_control(
            'slides_mobile',
            [
                'label' => __( 'Slides (Mobile ≤767px)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 1,
            ]
        );

        $this->add_control(
            'space_between',
            [
                'label' => __( 'Space Between', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 30,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Autoplay Speed (ms)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $uid = 'lia-partner-' . $this->get_id();
        ?>

        <div class="swiper <?php echo esc_attr( $uid ); ?>">
            <div class="swiper-wrapper">
                <?php foreach ( $settings['partners'] as $item ) : ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url( $item['logo']['url'] ); ?>" class="img-fluid" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.<?php echo esc_js( $uid ); ?>', {
                loop: true,
                spaceBetween: <?php echo (int) $settings['space_between']; ?>,
                slidesPerView: <?php echo (int) $settings['slides_desktop']; ?>,
                autoplay: <?php echo ( $settings['autoplay'] === 'yes' ) ? '{ delay: ' . (int) $settings['speed'] . ' }' : 'false'; ?>,
                breakpoints: {
                    0: {
                        slidesPerView: <?php echo (int) $settings['slides_mobile']; ?>
                    },
                    768: {
                        slidesPerView: <?php echo (int) $settings['slides_tablet']; ?>
                    },
                    1025: {
                        slidesPerView: <?php echo (int) $settings['slides_desktop']; ?>
                    }
                }
            });
        });
        </script>

        <?php
    }
}
