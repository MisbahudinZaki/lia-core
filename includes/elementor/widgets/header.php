<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Lia_Header_Widget extends Widget_Base {

	public function get_name() {
		return 'lia-header';
	}

	public function get_title() {
		return __( 'Lia Header', 'lia-core' );
	}

	public function get_icon() {
		return 'eicon-header';
	}

	public function get_categories() {
		return [ 'lia-elements' ];
	}

	public function get_keywords() {
		return [ 'header', 'navigation', 'menu', 'lia' ];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Header Layout', 'lia-core' ),
			]
		);

		$this->add_control(
			'header_style',
			[
				'label'   => __( 'Header Style', 'lia-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fixed',
				'options' => [
					'fixed'    => __( 'Fixed (Sticky)', 'lia-core' ),
					'relative' => __( 'Relative (Normal)', 'lia-core' ),
				],
			]
		);

		$this->add_control(
			'show_right',
			[
				'label'   => __( 'Show Right Section (CTA)', 'lia-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

        $this->add_control(
            'show_cta',
            [
                'label'   => __( 'Show CTA Button', 'lia-core' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label'     => __( 'CTA Text', 'lia-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Contact Us', 'lia-core' ),
                'condition' => [
                    'show_cta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'cta_link',
            [
                'label'     => __( 'CTA Link', 'lia-core' ),
                'type'      => Controls_Manager::URL,
                'options'   => [ 'url', 'is_external', 'nofollow' ],
                'default'   => [
                    'url' => '#',
                ],
                'condition' => [
                    'show_cta' => 'yes',
                ],
            ]
        );


		$this->end_controls_section();
	}

	/**
	 * Render output
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$header_class = 'lia-header';
		$header_class .= ( 'fixed' === $settings['header_style'] )
			? ' header-fixed'
			: ' header-relative';
		?>

		<header class="<?php echo esc_attr( $header_class ); ?>">
			<div class="hero-container">
				<nav class="lia-navbar">
                    <!-- LEFT : LOGO -->
                    <div class="header-left header-logo">
                        <a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php
                            if ( has_custom_logo() ) {
                                the_custom_logo();
                            } else {
                                ?>
                                <img
                                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.webp' ); ?>"
                                    alt="<?php bloginfo( 'name' ); ?>">
                                <?php
                            }
                            ?>
                        </a>
                    </div>

                    <!-- CENTER + MOBILE -->
                    <div class="nav-link-wrapper">

                        <button class="btn nav-btn" type="button" aria-label="<?php esc_attr_e( 'Toggle navigation', 'lia-core' ); ?>">
                            <i class="fa-solid fa-bars-staggered"></i>
                        </button>

                        <div class="header-center">
                            <?php
                            wp_nav_menu( [
                                'theme_location' => 'primary',
                                'menu_class'     => 'lia-menu',
                                'container'      => false,
                                'depth'          => 3,
                            ] );
                            ?>
                        </div>

                    </div>

                    <!-- RIGHT : CTA -->
                    <?php if ( 'yes' === $settings['show_right'] ) : ?>
                        <div class="header-right navbar-cta-container">
                            <a
                                href="<?php echo esc_url( $settings['cta_link']['url'] ); ?>"
                                class="btn btn-accent-outline"
                                <?php echo $settings['cta_link']['is_external'] ? 'target="_blank"' : ''; ?>
                                <?php echo $settings['cta_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>
                            >
                                <?php echo esc_html( $settings['cta_text'] ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
				</nav>
			</div>
		</header>

		<?php
	}
}