<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Lia_Footer_Widget extends Widget_Base {

	public function get_name() {
		return 'lia-footer';
	}

	public function get_title() {
		return __( 'Lia Footer', 'lia-core' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	public function get_categories() {
		return [ 'lia-elements' ];
	}

	/* ====================================================
	 * CONTROLS
	 * ==================================================== */
	protected function register_controls() {

		/* ================= Footer Banner ================= */
		$this->start_controls_section(
			'section_footer_banner',
			[
				'label' => __( 'Footer Banner', 'lia-core' ),
			]
		);

		$this->add_control(
			'background_image',
			[
				'label' => __( 'Background Image', 'lia-core' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'logo',
			[
				'label' => __( 'Logo', 'lia-core' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'lia-core' ),
				'type'  => Controls_Manager::TEXTAREA,
				'rows'  => 4,
			]
		);

		$this->end_controls_section();

		/* ================= Social Media ================= */
		$this->start_controls_section(
			'section_social',
			[
				'label' => __( 'Social Media', 'lia-core' ),
			]
		);

		$socials = [
			'facebook'  => 'Facebook',
			'twitter'   => 'X / Twitter',
			'linkedin'  => 'LinkedIn',
			'instagram' => 'Instagram',
		];

		foreach ( $socials as $key => $label ) {
			$this->add_control(
				'social_' . $key,
				[
					'label' => $label,
					'type'  => Controls_Manager::URL,
				]
			);
		}

		$this->end_controls_section();

		/* ================= Get In Touch ================= */
		$this->start_controls_section(
			'section_contact',
			[
				'label' => __( 'Get In Touch', 'lia-core' ),
			]
		);

		$this->add_control( 'phone', [
			'label' => __( 'Phone', 'lia-core' ),
			'type'  => Controls_Manager::TEXT,
		] );

		$this->add_control( 'email', [
			'label' => __( 'Email', 'lia-core' ),
			'type'  => Controls_Manager::TEXT,
		] );

		$this->add_control( 'address', [
			'label' => __( 'Address', 'lia-core' ),
			'type'  => Controls_Manager::TEXTAREA,
		] );

		$this->end_controls_section();

		/* ================= Quick Links ================= */
		$this->start_controls_section(
			'section_quick_links',
			[
				'label' => __( 'Quick Links', 'lia-core' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Link Text', 'lia-core' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'url',
			[
				'label' => __( 'Link URL', 'lia-core' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'quick_links',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();
	}

	/* ====================================================
	 * RENDER
	 * ==================================================== */
	protected function render() {
		$s = $this->get_settings_for_display();
		?>

		<footer>
			<div class="section footer-banner"
				style="<?php
					if ( ! empty( $s['background_image']['url'] ) ) {
						echo 'background-image:url(' . esc_url( $s['background_image']['url'] ) . ')';
					}
				?>">
				<div class="hero-container">

					<div class="footer-header">
						<div class="logo-container footer">
							<?php if ( ! empty( $s['logo']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $s['logo']['url'] ); ?>" class="img-fluid" alt="">
							<?php endif; ?>
						</div>

						<?php if ( $s['description'] ) : ?>
							<p><?php echo esc_html( $s['description'] ); ?></p>
						<?php endif; ?>

						<div class="social-container">
							<?php foreach ( [ 'facebook', 'twitter', 'linkedin', 'instagram' ] as $social ) :
								if ( ! empty( $s[ 'social_' . $social ]['url'] ) ) : ?>
									<a href="<?php echo esc_url( $s[ 'social_' . $social ]['url'] ); ?>" class="social-item">
										<i class="fa-brands fa-<?php echo esc_attr( $social ); ?>"></i>
									</a>
							<?php endif; endforeach; ?>
						</div>
					</div>

					<div class="footer-link">
						<div class="row row-cols-xl-4 row-cols-md-2 row-cols-1 g-3">

							<!-- Get In Touch -->
							<div class="col">
								<h5 class="accent-color">Get In Touch</h5>
								<?php if ( $s['phone'] ) : ?><p><?php echo esc_html( $s['phone'] ); ?></p><?php endif; ?>
								<?php if ( $s['email'] ) : ?><p><?php echo esc_html( $s['email'] ); ?></p><?php endif; ?>
								<?php if ( $s['address'] ) : ?><p><?php echo esc_html( $s['address'] ); ?></p><?php endif; ?>
							</div>

							<!-- Quick Links -->
							<div class="col">
								<h5 class="accent-color">Quick Links</h5>
								<ul class="footer-list">
									<?php foreach ( $s['quick_links'] as $link ) : ?>
										<li>
											<a href="<?php echo esc_url( $link['url']['url'] ); ?>">
												<?php echo esc_html( $link['text'] ); ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>

							<!-- Newsletter (Empty Placeholder) -->
							<div class="col"></div>

							<!-- Reserved -->
							<div class="col"></div>

						</div>
					</div>

					<div class="copyright-container">
						<p>
							&copy; <?php echo esc_html( date( 'Y' ) ); ?>
							<?php bloginfo( 'name' ); ?>.
							<?php esc_html_e( 'All rights reserved.', 'lia' ); ?>
						</p>
					</div>

				</div>
			</div>
		</footer>

		<?php
	}
}