<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Lia_Featured_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lia-featured';
    }

    public function get_title() {
        return esc_html__( 'LIA Featured', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_categories() {
        return [ 'lia-elements' ]; // Adjust if your category is different
    }

    public function get_keywords() {
        return [ 'featured', 'cards', 'lia' ];
    }

    protected function register_controls() {
        // Section for Creative Solution Card
        $this->start_controls_section(
            'section_creative_solution',
            [
                'label' => esc_html__( 'Creative Solution Card', 'lia-core' ),
            ]
        );

        $this->add_control(
            'creative_title',
            [
                'label' => esc_html__( 'Title', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Creative Solution', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter title', 'lia-core' ),
            ]
        );

        $this->add_control(
            'creative_description',
            [
                'label' => esc_html__( 'Description', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter description', 'lia-core' ),
            ]
        );

        $this->add_control(
            'creative_button_text',
            [
                'label' => esc_html__( 'Button Text', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Learn More', 'lia-core' ),
            ]
        );

        $this->add_control(
            'creative_button_link',
            [
                'label' => esc_html__( 'Button Link', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'lia-core' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'creative_background_image',
            [
                'label' => esc_html__( 'Background Image (Banner)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Section for Business Available Card
        $this->start_controls_section(
            'section_business_available',
            [
                'label' => esc_html__( 'Business Available Card', 'lia-core' ),
            ]
        );

        $this->add_control(
            'business_icon',
            [
                'label' => esc_html__( 'Icon', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'business_title',
            [
                'label' => esc_html__( 'Title', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Avaliable for All Business', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter title', 'lia-core' ),
            ]
        );

        $this->add_control(
            'business_description',
            [
                'label' => esc_html__( 'Description', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter description', 'lia-core' ),
            ]
        );

        $this->add_control(
            'business_background_image',
            [
                'label' => esc_html__( 'Background Image (Banner)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Section for Client Rating Card
        $this->start_controls_section(
            'section_client_rating',
            [
                'label' => esc_html__( 'Client Rating Card', 'lia-core' ),
            ]
        );

        $this->add_control(
            'client_rating_value',
            [
                'label' => esc_html__( 'Rating Value', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '4.8',
                'placeholder' => esc_html__( 'Enter rating (e.g., 4.8)', 'lia-core' ),
            ]
        );

        $this->add_control(
            'client_title',
            [
                'label' => esc_html__( 'Title', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Client Ratings', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter title', 'lia-core' ),
            ]
        );

        $this->add_control(
            'client_description',
            [
                'label' => esc_html__( 'Description', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter description', 'lia-core' ),
            ]
        );

        $this->add_control(
            'client_background_image',
            [
                'label' => esc_html__( 'Background Image (Banner)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Section for Solid Development Card
        $this->start_controls_section(
            'section_solid_development',
            [
                'label' => esc_html__( 'Solid Development Card', 'lia-core' ),
            ]
        );

        $this->add_control(
            'solid_title',
            [
                'label' => esc_html__( 'Title', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Solid Development', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter title', 'lia-core' ),
            ]
        );

        $this->add_control(
            'solid_description',
            [
                'label' => esc_html__( 'Description', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter description', 'lia-core' ),
            ]
        );

        $this->add_control(
            'solid_button_text',
            [
                'label' => esc_html__( 'Button Text', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Learn More', 'lia-core' ),
            ]
        );

        $this->add_control(
            'solid_button_link',
            [
                'label' => esc_html__( 'Button Link', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'lia-core' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'solid_background_image',
            [
                'label' => esc_html__( 'Background Image (Banner)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Section for Great Experience Card
        $this->start_controls_section(
            'section_great_experience',
            [
                'label' => esc_html__( 'Great Experience Card', 'lia-core' ),
            ]
        );

        $this->add_control(
            'experience_title',
            [
                'label' => esc_html__( 'Title', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Great Experience', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter title', 'lia-core' ),
            ]
        );

        $this->add_control(
            'experience_description',
            [
                'label' => esc_html__( 'Description', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lia-core' ),
                'placeholder' => esc_html__( 'Enter description', 'lia-core' ),
            ]
        );

        $this->add_control(
            'experience_button_text',
            [
                'label' => esc_html__( 'Button Text', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Learn More', 'lia-core' ),
            ]
        );

        $this->add_control(
            'experience_button_link',
            [
                'label' => esc_html__( 'Button Link', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'lia-core' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'experience_background_image',
            [
                'label' => esc_html__( 'Background Image (Banner)', 'lia-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Prepare background styles
        $creative_bg = ! empty( $settings['creative_background_image']['url'] ) ? ' style="background-image: url(' . esc_url( $settings['creative_background_image']['url'] ) . ');"' : '';
        $business_bg = ! empty( $settings['business_background_image']['url'] ) ? ' style="background-image: url(' . esc_url( $settings['business_background_image']['url'] ) . ');"' : '';
        $client_bg = ! empty( $settings['client_background_image']['url'] ) ? ' style="background-image: url(' . esc_url( $settings['client_background_image']['url'] ) . ');"' : '';
        $solid_bg = ! empty( $settings['solid_background_image']['url'] ) ? ' style="background-image: url(' . esc_url( $settings['solid_background_image']['url'] ) . ');"' : '';
        $experience_bg = ! empty( $settings['experience_background_image']['url'] ) ? ' style="background-image: url(' . esc_url( $settings['experience_background_image']['url'] ) . ');"' : '';
        ?>
        <div class="section">
            <div class="hero-container">
                <div class="row row-cols-lg-2 row-cols-1 lia-grid-gap-2">
                    <div class="col col-lg-4">
                        <div class="d-flex flex-column flex-md-row flex-lg-column lia-gspace-2">
                            <div class="card card-featured creative-solution animate-box animated animate__animated" data-animate="animate__fadeInLeft"<?php echo $creative_bg; ?>>
                                <h4><?php echo esc_html( $settings['creative_title'] ); ?></h4>
                                <p><?php echo esc_html( $settings['creative_description'] ); ?></p>
                                <div>
                                    <a href="<?php echo esc_url( $settings['creative_button_link']['url'] ); ?>" class="btn btn-accent-2">
                                        <div class="d-flex flex-row align-items-center gspace-1">
                                            <span><?php echo esc_html( $settings['creative_button_text'] ); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="card card-featured bussines-avaliable animate-box animated animate__animated" data-animate="animate__fadeInDown"<?php echo $business_bg; ?>>
                                <div class="d-flex flex-row gspace-1 align-items-center">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['business_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <h5><?php echo esc_html( $settings['business_title'] ); ?></h5>
                                </div>
                                <p><?php echo esc_html( $settings['business_description'] ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-8">
                        <div class="d-flex flex-column lia-gspace-2">
                            <div class="d-flex flex-md-row flex-column lia-gspace-2">
                                <div class="card card-featured client-rating animate-box animated animate__animated" data-animate="animate__fadeIn"<?php echo $client_bg; ?>>
                                    <span class="rating"><?php echo esc_html( $settings['client_rating_value'] ); ?></span>
                                    <h5><?php echo esc_html( $settings['client_title'] ); ?></h5>
                                    <div class="stars">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <p><?php echo esc_html( $settings['client_description'] ); ?></p>
                                </div>
                                <div class="card card-featured solid-development animate-box animated animate__animated" data-animate="animate__fadeInUp"<?php echo $solid_bg; ?>>
                                    <h4><?php echo esc_html( $settings['solid_title'] ); ?></h4>
                                    <p><?php echo esc_html( $settings['solid_description'] ); ?></p>
                                    <div>
                                        <a href="<?php echo esc_url( $settings['solid_button_link']['url'] ); ?>" class="btn btn-accent-2">
                                            <div class="d-flex flex-row align-items-center gspace-1">
                                                <span><?php echo esc_html( $settings['solid_button_text'] ); ?></span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-featured experience animate-box animated animate__animated" data-animate="animate__fadeInRight"<?php echo $experience_bg; ?>>
                                <h4><?php echo esc_html( $settings['experience_title'] ); ?></h4>
                                <p><?php echo esc_html( $settings['experience_description'] ); ?></p>
                                <div>
                                    <a href="<?php echo esc_url( $settings['experience_button_link']['url'] ); ?>" class="btn btn-accent-2">
                                        <div class="d-flex flex-row align-items-center gspace-1">
                                            <span><?php echo esc_html( $settings['experience_button_text'] ); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}