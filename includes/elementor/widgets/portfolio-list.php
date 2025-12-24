<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Lia_Portfolio_List_Widget extends Widget_Base {

    public function get_name() {
        return 'lia-portfolio-list';
    }

    public function get_title() {
        return __( 'Portfolio Grid', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'lia-elements' ];
    }

    /**
     * Controls
     */
    protected function register_controls() {

        /**
         * Content
         */
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'lia-core' ),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => __( 'Number of Projects', 'lia-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'lia-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC'  => __( 'Oldest First', 'lia-core' ),
                    'DESC' => __( 'Newest First', 'lia-core' ),
                ],
            ]
        );

        $this->add_control(
            'enable_filter',
            [
                'label'        => __( 'Enable Category Filter', 'lia-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'lia-core' ),
                'label_off'    => __( 'No', 'lia-core' ),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->end_controls_section();

        /**
         * Layout
         */
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Layout', 'lia-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __( 'Columns', 'lia-core' ),
                'type'  => Controls_Manager::NUMBER,
                'min'   => 1,
                'max'   => 6,
                'default' => 3,
                'selectors' => [
                    '{{WRAPPER}} .lia-portfolio-list' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => __( 'Grid Gap', 'lia-core' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .lia-portfolio-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $query = new WP_Query([
            'post_type'      => 'portfolio',
            'posts_per_page' => (int) $settings['posts_per_page'],
            'orderby'        => 'date',
            'order'          => $settings['order'],
            'post_status'    => 'publish',
        ]);

        /**
         * Filter
         */
        if ( $settings['enable_filter'] === 'yes' ) {

            $terms = get_terms([
                'taxonomy'   => 'portfolio-category',
                'hide_empty' => true,
            ]);

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                echo '<div class="lia-portfolio-filter">';
                echo '<button class="active" data-filter="*">' . esc_html__( 'All', 'lia-core' ) . '</button>';

                foreach ( $terms as $term ) {
                    echo '<button data-filter="' . esc_attr( $term->slug ) . '">';
                    echo esc_html( $term->name );
                    echo '</button>';
                }

                echo '</div>';
            }
        }

        if ( ! $query->have_posts() ) {
            return;
        }

        echo '<div class="lia-portfolio-list">';

        $counter = 1;

        while ( $query->have_posts() ) {
            $query->the_post();

            // FIX META KEY
            $client = get_post_meta( get_the_ID(), 'lia_portfolio_client', true );
            $date   = get_post_meta( get_the_ID(), 'lia_portfolio_date', true );

            // taxonomy class
            $term_slugs = wp_get_post_terms(
                get_the_ID(),
                'portfolio-category',
                [ 'fields' => 'slugs' ]
            );

            $term_class = ! empty( $term_slugs )
                ? implode( ' ', $term_slugs )
                : '';
            ?>

            <div class="portfolio-layout <?php echo esc_attr( $term_class ); ?>">

                <div class="portfolio-header">

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="portfolio-image-wrapper">
                            <div class="image-container portfolio-image">
                                <?php the_post_thumbnail( 'full', [ 'class' => 'img-fluid' ] ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <h4 class="number">
                        <?php echo esc_html( str_pad( $counter, 2, '0', STR_PAD_LEFT ) ); ?>
                    </h4>

                </div>

                <div class="portfolio-content">

                    <h5><?php the_title(); ?></h5>

                    <div class="portfolio-meta-wrapper">

                        <?php if ( $client ) : ?>
                            <div class="portfolio-meta">
                                <i class="fa-solid fa-users"></i>
                                <div>
                                    <span class="title"><?php esc_html_e( 'Client', 'lia-core' ); ?></span>
                                    <p><?php echo esc_html( $client ); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( $date ) : ?>
                            <div class="portfolio-meta">
                                <i class="fa-solid fa-calendar-days"></i>
                                <div>
                                    <span class="title"><?php esc_html_e( 'Date', 'lia-core' ); ?></span>
                                    <p><?php echo esc_html( $date ); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    
                    <div class="portfolio-cta-container">
                        <?php if ( has_excerpt() ) : ?>
                            <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                        <?php endif; ?>
                        
                        <div class="portfolio-btn-wrapper">
                            <div>
                                <div class="portfolio-btn">
                                    <a href="<?php the_permalink(); ?>" class="button">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <?php
            $counter++;
        }

        echo '</div>';

        wp_reset_postdata();
    }
}