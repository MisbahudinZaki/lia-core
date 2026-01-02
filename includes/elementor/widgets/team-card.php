<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Lia_Team_Card_Widget extends Widget_Base {

    public function get_name() {
        return 'lia-team-card';
    }

    public function get_title() {
        return __( 'Team Card', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return [ 'lia-elements' ];
    }

    /**
     * Register Controls
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
                'label'   => __( 'Number of Members', 'lia-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
                'min'     => 1,
            ]
        );

        $this->add_control(
            'show_social',
            [
                'label'        => __( 'Show Social Icons', 'lia-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'lia-core' ),
                'label_off'    => __( 'No', 'lia-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Output
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $query = new WP_Query([
            'post_type'      => 'team',
            'posts_per_page' => $settings['posts_per_page'],
        ]);

        if ( ! $query->have_posts() ) {
            return;
        }

        echo '<div class="team-wrapper">';

        while ( $query->have_posts() ) {
            $query->the_post();

            $position = get_post_meta( get_the_ID(), 'lia_team_position', true );
            $facebook = get_post_meta( get_the_ID(), 'lia_team_facebook', true );
            $twitter  = get_post_meta( get_the_ID(), 'lia_team_twitter', true );
            $linkedin = get_post_meta( get_the_ID(), 'lia_team_linkedin', true );
            ?>

            <div class="team-layout">
                <div class="image-container">

                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'full', [ 'class' => 'img-fluid' ] ); ?>
                    <?php endif; ?>

                    <div class="team-detail">
                        <h5><?php the_title(); ?></h5>

                        <?php if ( $position ) : ?>
                            <span class="team-designation">
                                <?php echo esc_html( $position ); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ( 'yes' === $settings['show_social'] ) : ?>
                            <div class="social-container">

                                <?php if ( $facebook ) : ?>
                                    <a href="<?php echo esc_url( $facebook ); ?>" class="social-item" target="_blank" rel="nofollow">
                                        <i class="fa-brands fa-xs fa-facebook"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if ( $twitter ) : ?>
                                    <a href="<?php echo esc_url( $twitter ); ?>" class="social-item" target="_blank" rel="nofollow">
                                        <i class="fa-brands fa-xs fa-x-twitter"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if ( $linkedin ) : ?>
                                    <a href="<?php echo esc_url( $linkedin ); ?>" class="social-item" target="_blank" rel="nofollow">
                                        <i class="fa-brands fa-xs fa-linkedin-in"></i>
                                    </a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <?php
        }

        echo '</div>';

        wp_reset_postdata();
    }
}
