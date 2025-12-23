<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Lia_Service_Card_Widget extends Widget_Base {

    public function get_name() {
        return 'lia-service-card';
    }

    public function get_title() {
        return __( 'Service Card', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'lia-elements' ];
    }

    /**
     * Controls
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'lia-core' ),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => __( 'Number of Services', 'lia-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $query = new WP_Query([
            'post_type'      => 'service',
            'posts_per_page' => $settings['posts_per_page'],
        ]);

        if ( ! $query->have_posts() ) {
            return;
        }

        while ( $query->have_posts() ) {
            $query->the_post();

            $is_highlight = get_post_meta( get_the_ID(), 'lia_service_highlight', true );

            $service_class = 'card card-service';
            if ( $is_highlight === 'yes' ) {
                $service_class .= ' highlight-service';
            }
            ?>

            <div class="card card-service-wrapper">
                <div class="<?php echo esc_attr( $service_class ); ?>">

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div>
                            <?php the_post_thumbnail( 'full', [ 'class' => 'img-fluid' ] ); ?>
                        </div>
                    <?php endif; ?>

                    <h4><?php the_title(); ?></h4>

                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>

                    <div class="service-cta">
                        <a href="<?php the_permalink(); ?>" class="service-link">
                            <?php esc_html_e( 'Learn More', 'lia-core' ); ?>
                        </a>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>

                </div>
            </div>

            <?php
        }

        wp_reset_postdata();
    }
}
