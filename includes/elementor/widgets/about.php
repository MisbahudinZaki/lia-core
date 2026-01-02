<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Lia_About_Widget extends Widget_Base {

    public function get_name() {
        return 'lia-about-banner';
    }

    public function get_title() {
        return __( 'Lia About Banner', 'lia-core' );
    }

    public function get_icon() {
        return 'eicon-info-circle-o';
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
                'default'     => __( 'About', 'lia-core' ),
                'placeholder' => __( 'Enter sub heading', 'lia-core' ),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'       => __( 'Heading', 'lia-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Your Partner in Digital Growth and Innovation', 'lia-core' ),
                'placeholder' => __( 'Enter main heading', 'lia-core' ),
            ]
        );

        $this->add_control(
            'heading_tag',
            [
                'label'   => __( 'Heading HTML Tag', 'lia-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __( 'Description', 'lia-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Pellentesque adipiscing commodo elit at. Facilisis sed odio morbi quis commodo odio. Porttitor massa id neque aliquam vestibulum morbi blandit. Lectus proin nibh nisl condimentum id. Aenean et tortor at risus. Vel pharetra vel turpis nunc eget lorem dolor.', 'lia-core' ),
                'placeholder' => __( 'Enter description', 'lia-core' ),
                'rows'        => 5,
            ]
        );

        $this->end_controls_section();

        // Left Column Content
        $this->start_controls_section(
            'section_left_column',
            [
                'label' => __( 'Left Column', 'lia-core' ),
            ]
        );

        $this->add_control(
            'experience_number',
            [
                'label'       => __( 'Experience Number', 'lia-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '25',
                'placeholder' => __( 'e.g., 25', 'lia-core' ),
            ]
        );

        $this->add_control(
            'experience_text',
            [
                'label'       => __( 'Experience Text', 'lia-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Years of Experience', 'lia-core' ),
                'placeholder' => __( 'Enter experience text', 'lia-core' ),
            ]
        );

        $this->add_control(
            'card_image',
            [
                'label'   => __( 'Card Background Image', 'lia-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'card_image_size',
                'default' => 'full',
            ]
        );

        $this->add_control(
            'main_image',
            [
                'label'   => __( 'About Image', 'lia-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'main_image_size',
                'default' => 'full',
            ]
        );

        $this->end_controls_section();

        // Checklist Section
        $this->start_controls_section(
            'section_checklist',
            [
                'label' => __( 'Checklist Items', 'lia-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label'       => __( 'Item Text', 'lia-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Amet purus gravida quis blandit', 'lia-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'checklist_items',
            [
                'label'       => __( 'Checklist Items', 'lia-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'item_text' => __( 'Amet purus gravida quis blandit', 'lia-core' ),
                    ],
                    [
                        'item_text' => __( 'Condimentum lacinia quis vel eros', 'lia-core' ),
                    ],
                    [
                        'item_text' => __( 'Turpis cursus in hac habitasse', 'lia-core' ),
                    ],
                    [
                        'item_text' => __( 'Et netus et malesuada fames', 'lia-core' ),
                    ],
                    [
                        'item_text' => __( 'Amet purus gravida quis blandit', 'lia-core' ),
                    ],
                    [
                        'item_text' => __( 'Condimentum lacinia quis vel eros', 'lia-core' ),
                    ],
                    [
                        'item_text' => __( 'Turpis cursus in hac habitasse', 'lia-core' ),
                    ],
                    [
                        'item_text' => __( 'Et netus et malesuada fames', 'lia-core' ),
                    ],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

        // Button Section
        $this->start_controls_section(
            'section_button',
            [
                'label' => __( 'Button', 'lia-core' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'lia-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Learn More', 'lia-core' ),
                'placeholder' => __( 'Enter button text', 'lia-core' ),
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
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        
        // Validasi heading tag
        $allowed_tags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];
        $heading_tag = in_array( $settings['heading_tag'], $allowed_tags ) ? $settings['heading_tag'] : 'h3';
        
        // Button link attributes
        $button_target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $button_nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';

        ?>
        <div class="section about-banner">
            <div class="hero-container">
                <div class="row row-cols-xl-2 row-cols-1 lia-grid-gap-2">
                    
                    <!-- Left Column -->
                    <div class="col">
                        <div class="d-flex flex-column lia-gspace-2 position-relative">
                            
                            <!-- Experience Card -->
                            <div class="card card-about">
                                <?php if ( ! empty( $settings['card_image']['url'] ) ) : ?>
                                    <span class="wrapper" style="background-image: url('<?php echo esc_url( $settings['card_image']['url'] ); ?>');">
                                        <span class="number"><?php echo esc_html( $settings['experience_number'] ); ?></span>
                                    </span>
                                <?php endif; ?>
                                <p class="title"><?php echo esc_html( $settings['experience_text'] ); ?></p>
                            </div>
                            
                            <!-- Main Image -->
                            <?php if ( ! empty( $settings['main_image']['url'] ) ) : ?>
                                <div class="image-container about-img">
                                    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'main_image_size', 'main_image' ); ?>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col">
                        <div class="about-detail animate-box animated" data-animate="animate__fadeInRight">
                            
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
                            
                            <!-- Checklist -->
                            <?php if ( ! empty( $settings['checklist_items'] ) ) : ?>
                                <div class="row row-cols-md-2 row-cols-1 lia-grid-gap-2">
                                    <div class="col">
                                        <ul class="check-list">
                                            <?php 
                                            $item_count = count( $settings['checklist_items'] );
                                            $half_count = ceil( $item_count / 2 );
                                            
                                            for ( $i = 0; $i < $half_count; $i++ ) :
                                                if ( isset( $settings['checklist_items'][ $i ] ) ) :
                                            ?>
                                                <li><?php echo esc_html( $settings['checklist_items'][ $i ]['item_text'] ); ?></li>
                                            <?php 
                                                endif;
                                            endfor; 
                                            ?>
                                        </ul>
                                    </div>
                                    
                                    <div class="col">
                                        <ul class="check-list">
                                            <?php 
                                            for ( $i = $half_count; $i < $item_count; $i++ ) :
                                                if ( isset( $settings['checklist_items'][ $i ] ) ) :
                                            ?>
                                                <li><?php echo esc_html( $settings['checklist_items'][ $i ]['item_text'] ); ?></li>
                                            <?php 
                                                endif;
                                            endfor; 
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Button -->
                            <?php if ( ! empty( $settings['button_text'] ) ) : ?>
                                <div>
                                    <a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" 
                                       class="btn btn-accent" 
                                       <?php echo $button_target . $button_nofollow; ?>>
                                        <?php echo esc_html( $settings['button_text'] ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        // Validasi heading tag
        var allowed_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
        var heading_tag = allowed_tags.indexOf(settings.heading_tag) !== -1 ? settings.heading_tag : 'h3';
        
        // Button attributes
        var button_target = settings.button_link.is_external ? ' target="_blank"' : '';
        var button_nofollow = settings.button_link.nofollow ? ' rel="nofollow"' : '';
        
        // Split checklist items
        var item_count = settings.checklist_items.length;
        var half_count = Math.ceil(item_count / 2);
        #>
        
        <div class="section about-banner">
            <div class="hero-container">
                <div class="row row-cols-xl-2 row-cols-1 lia-grid-gap-2">
                    
                    <!-- Left Column -->
                    <div class="col">
                        <div class="d-flex flex-column lia-gspace-2 position-relative">
                            
                            <!-- Experience Card -->
                            <div class="card card-about">
                                <# if ( settings.card_image.url ) { #>
                                    <span class="wrapper" style="background-image: url('{{{ settings.card_image.url }}}');">
                                        <span class="number">{{{ settings.experience_number }}}</span>
                                    </span>
                                <# } #>
                                <p class="title">{{{ settings.experience_text }}}</p>
                            </div>
                            
                            <!-- Main Image -->
                            <# if ( settings.main_image.url ) { #>
                                <div class="image-container about-img">
                                    <img src="{{{ settings.main_image.url }}}" class="img-fluid" alt="">
                                </div>
                            <# } #>
                            
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col">
                        <div class="about-detail animate-box animated" data-animate="animate__fadeInRight">
                            
                            <# if ( settings.sub_heading ) { #>
                                <h6 class="sub-heading">{{{ settings.sub_heading }}}</h6>
                            <# } #>
                            
                            <# if ( settings.heading ) { #>
                                <{{{ heading_tag }}}>{{{ settings.heading }}}</{{{ heading_tag }}}>
                            <# } #>
                            
                            <# if ( settings.description ) { #>
                                <p>{{{ settings.description }}}</p>
                            <# } #>
                            
                            <!-- Checklist -->
                            <# if ( settings.checklist_items.length ) { #>
                                <div class="row row-cols-md-2 row-cols-1 lia-grid-gap-2">
                                    <div class="col">
                                        <ul class="check-list">
                                            <# for ( var i = 0; i < half_count; i++ ) { #>
                                                <# if ( settings.checklist_items[i] ) { #>
                                                    <li>{{{ settings.checklist_items[i].item_text }}}</li>
                                                <# } #>
                                            <# } #>
                                        </ul>
                                    </div>
                                    
                                    <div class="col">
                                        <ul class="check-list">
                                            <# for ( var i = half_count; i < item_count; i++ ) { #>
                                                <# if ( settings.checklist_items[i] ) { #>
                                                    <li>{{{ settings.checklist_items[i].item_text }}}</li>
                                                <# } #>
                                            <# } #>
                                        </ul>
                                    </div>
                                </div>
                            <# } #>
                            
                            <!-- Button -->
                            <# if ( settings.button_text ) { #>
                                <div>
                                    <a href="{{{ settings.button_link.url }}}" 
                                       class="btn btn-accent" 
                                       {{{ button_target }}} {{{ button_nofollow }}}>
                                        {{{ settings.button_text }}}
                                    </a>
                                </div>
                            <# } #>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
    }
}