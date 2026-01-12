<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Lia_Achievement_Widget extends Widget_Base {

    public function get_name() {
        return 'lia-achievement';
    }

    public function get_title() {
        return __( 'Achievement Banner', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-counter';
    }

    public function get_categories() {
        return [ 'lia-elements' ];
    }

    /**
     * Register Controls
     */
    protected function register_controls() {

        /**
         * Banner Settings
         */
        $this->start_controls_section(
            'section_banner',
            [
                'label' => __( 'Achievement Banner', 'lia-core' ),
            ]
        );

        $this->add_control(
            'banner_background',
            [
                'label' => __( 'Background Image', 'lia-core' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Achievement Items
         */
        $this->start_controls_section(
            'section_items',
            [
                'label' => __( 'Achievements', 'lia-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label'   => __( 'Icon Image', 'lia-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label'   => __( 'Number', 'lia-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 25,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'   => __( 'Title', 'lia-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Years of Experience', 'lia-core' ),
            ]
        );

        $this->add_control(
            'items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [ 'number' => 25,  'title' => 'Years of Experience' ],
                    [ 'number' => 180, 'title' => 'Projects Done' ],
                    [ 'number' => 100, 'title' => 'Expert Team' ],
                    [ 'number' => 300, 'title' => 'Happy Client' ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Output
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $banner_style = '';

        if ( ! empty( $settings['banner_background']['url'] ) ) {
            $banner_style = 'style="background-image:url(' . esc_url( $settings['banner_background']['url'] ) . ');"';
        }
        ?>

        <section class="section">
            <div class="hero-container">               
                <div class="achievement-banner" <?php echo $banner_style; ?>>
                    <div class="d-flex flex-column flex-lg-row position-relative z-2 w-100">
        
                        <?php foreach ( $settings['items'] as $item ) : ?>
        
                            <div class="achievement-layout">
        
                                <div class="image-container achievement-icon">
                                    <?php if ( ! empty( $item['icon']['url'] ) ) : ?>
                                        <img src="<?php echo esc_url( $item['icon']['url'] ); ?>" alt="" class="img-fluid">
                                    <?php endif; ?>
                                </div>
        
                                <div class="achievement-stat-container">
                                    <span
                                        class="achievement-stat counter"
                                        data-target="<?php echo esc_attr( $item['number'] ); ?>"
                                    >
                                        <?php echo esc_html( $item['number'] ); ?>
                                    </span>
                                </div>
        
                                <?php if ( ! empty( $item['title'] ) ) : ?>
                                    <p><?php echo esc_html( $item['title'] ); ?></p>
                                <?php endif; ?>
        
                            </div>
        
                        <?php endforeach; ?>
        
                    </div>
                </div>
            </div>
        </section>

        <?php
    }
}