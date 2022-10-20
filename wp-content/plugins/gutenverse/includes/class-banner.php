<?php
/**
 * Banner
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package gutenverse
 */

namespace Gutenverse;

/**
 * Class Style Generator
 *
 * @package gutenverse
 */
class Banner {
	/**
	 * Option Name.
	 *
	 * @var string
	 */
	private $option_name = 'gutenverse_active_time';

	/**
	 * How Long timeout until first banner shown.
	 *
	 * @var int
	 */
	private $first_time_show = 3;

	/**
	 * How Long timeout after first banner shown.
	 *
	 * @var int
	 */
	private $another_time_show = 30;

	/**
	 * Init constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_active_time' ) );
		add_action( 'admin_notices', array( $this, 'notice' ) );
		add_action( 'wp_ajax_gutenverse_notice_close', array( $this, 'close' ) );
		add_action( 'wp_ajax_gutenverse_notice_review', array( $this, 'review' ) );
	}

	/**
	 * Enqueue Script.
	 */
	public function enqueue_script() {
		wp_enqueue_style(
			'fontawesome-gutenverse',
			GUTENVERSE_URL . '/assets/fontawesome/css/all.css',
			array(),
			GUTENVERSE_VERSION
		);
	}

	/**
	 * Register Active Time.
	 */
	public function register_active_time() {
		$time = get_option( $this->option_name );

		if ( ! $time ) {
			$next_time = time() + $this->get_second( $this->first_time_show );
			add_option( $this->option_name, $next_time );
		}
	}

	/**
	 * Get Second by days.
	 *
	 * @param int $days Days Number.
	 *
	 * @return int
	 */
	public function get_second( $days ) {
		return $days * 24 * 60 * 60;
	}

	/**
	 * Check if we can render notice.
	 */
	public function can_render_notice() {
		$option = get_option( $this->option_name );
		$time   = time();

		if ( 'review' === $option ) {
			return false;
		}

		return $time > $option;
	}

	/**
	 * Close Button Clicked.
	 */
	public function close() {
		$time = get_option( $this->option_name );
		if ( is_int( $time ) ) {
			$next_time = $time + $this->get_second( $this->another_time_show );
			update_option( $this->option_name, $next_time );
		}
	}

	/**
	 * Review Button Clicked.
	 */
	public function review() {
		update_option( $this->option_name, 'review' );
	}

	/**
	 * Show Notice.
	 */
	public function notice() {
		if ( $this->can_render_notice() ) {
			$this->enqueue_script();
			?>
			<div class="notice gutenverse-banner">
				<div class="gutenverse-banner-logo">
					<svg width="20" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.667 14.432h-10L5 11.546H5L3.334 8.659 1.666 5.771 0 8.658v.001l1.666 2.887 1.667 2.886L5 17.32h10l1.667-2.888z" fill="#3B57F7"></path><path d="M3.33 8.66h6.667l1.667 2.886 1.666 2.886h3.333l-1.666-2.886-3.333-5.775H1.662L3.33 8.66z" fill="#3B57F7"></path><path d="M18.333 5.774l-1.666-2.887L15 0H5L3.332 2.887h10.002l1.665 2.886 1.667 2.888 1.667 2.887L20 8.66H20l-1.667-2.887z" fill="#5CD0DA"></path>
					</svg>
				</div>
				<div class="gutenverse-banner-content">
					<h2><?php esc_html_e( 'Enjoy Using Gutenverse?', 'gutenverse' ); ?></h2>
					<p><?php esc_html_e( 'Hi there! It\'s been sometime since you use Gutenverse plugin. We hope our plugin is proving helpful in building your website. If you can spare a few moments, please let us know what you think of Gutenverse by leaving a rating we\'d be super grateful — Thanks a lot!', 'gutenverse' ); ?></p>
					<div class="gutenverse-notice-action">
						<div class="gutenverse-notice-action-left">
							<a href="https://wordpress.org/support/plugin/gutenverse/reviews/#new-post" target="_blank" class="gutenverse-notice-action-button">
								<?php esc_html_e( 'Yes, You deserve ★★★★★', 'gutenverse' ); ?>
							</a>
						</div>
						<div class="gutenverse-notice-action-right">
							<a href='https://www.facebook.com/groups/gutenversecommunity' target="_blank" class="community">
								<?php esc_html_e( 'Join our community', 'gutenvese' ); ?>
							</a>
							<a href='https://wordpress.org/support/plugin/gutenverse/' target="_blank" class="support">
								<?php esc_html_e( 'Got Question?', 'gutenvese' ); ?>
							</a>
							<a href='https://gutenverse.com/docs/' target="_blank" class="documentation">
								<?php esc_html_e( 'Documentation', 'gutenvese' ); ?>
							</a>
						</div>
					</div>
				</div>
				<div class="gutenverse-notice-close">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
				</div>
			</div>
			<script>
				(function ($) {
					$('.gutenverse-notice-close').on('click', function () {
						$('.gutenverse-banner').fadeOut();
						$.post( ajaxurl, {
							action: 'gutenverse_notice_close'
						});
					});

					$('.gutenverse-notice-action-button').on('click', function () {
						$.post( ajaxurl, {
							action: 'gutenverse_notice_review'
						});
						return true;
					});
				})(jQuery);
			</script>
			<style>
				.gutenverse-banner {
					position: relative;
					display: flex;
					margin: 10px 0 20px !important;
					padding: 0 !important;
					border: 1px solid #c3c4c7;
					border-left-width: 0;
				}

				.gutenverse-banner .gutenverse-banner-logo {
					background: #ECF0F8;
					padding: 20px 15px;
					border-left: 4px;
					border-right: 0;
					border-style: solid;
					border-image: linear-gradient(to bottom, #3F3BF7, #5CD0DA) 1 100%;
				}

				.gutenverse-banner .gutenverse-banner-content {
					padding: 20px 20px 25px 20px;
				}

				.gutenverse-banner .gutenverse-banner-content h2 {
					margin-top: 0;
					margin-bottom: 10px;
				}

				.gutenverse-notice-action {
					display: flex;
					justify-content: space-between;
					margin-top: 20px;
				}

				.gutenverse-notice-action .gutenverse-notice-action-button {
					color: #fff;
					background: #1B67A5;
					border-radius: 3px;
					cursor: pointer;
					padding: 7px 15px;
					text-decoration: none;
				}

				.gutenverse-notice-action-right {
					display: flex;
					gap: 20px;
				}

				.gutenverse-notice-action-right a {
					display: flex;
					gap: 7px;
					text-decoration: none;
					color: #1B67A5;
					justify-content: center;
					align-items: center;
				}

				.gutenverse-notice-action-right a:before {
					display: block;
					font-size: 16px;
				}

				.gutenverse-notice-action .community:before {
					font-family: 'Font Awesome 5 Brands';
					content: "\f09a";
				}

				.gutenverse-notice-action .support:before {
					font-family: 'Font Awesome 5 Free';
					content: "\f1cd";
				}

				.gutenverse-notice-action .documentation:before {
					font-family: 'Font Awesome 5 Brands';
					content: "\f791";
				}

				.gutenverse-notice-action-right {
					display: flex;
				}

				.gutenverse-notice-close {
					position: absolute;
					display: flex;
					right: 10px;
					top: 10px;
					width: 19px;
					cursor: pointer;
				}

				.gutenverse-notice-close svg {
					color: #aaa;
				}
			</style>
			<?php
		}
	}

}
