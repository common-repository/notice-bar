<?php
/**
 * Plugin Name: Notice Bar
 * Description: A easy way to create notice bar in WordPress sites with multiple options.
 * Plugin URI: http://wensolutions.com/plugins/notice-bar/
 * Author: WEN Solutions
 * Author URI: http://wensolutions.com
 * Version: 3.1.3
 * Requires at least: 4.1
 * Requires PHP: 5.6
 * Tested up to: 6.5
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: notice-bar
 * Domain Path: languages
 *
 * @package Notice_Bar
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NOTICE_BAR_FILE_PATH', __FILE__ );
define( 'NOTICE_BAR_BASE_PATH', dirname( __FILE__ ) );
define( 'NOTICE_BAR_IMG_PATH', NOTICE_BAR_BASE_PATH . '\css\images' );
define( 'NOTICE_BAR_FILE_URL', plugins_url( '', __FILE__ ) );
define( 'NOTICE_BAR_VERSION', '3.1.0' );
define( 'NOTICE_BAR_POST_TYPE', 'notice-bar' );

if ( ! class_exists( 'Notice_Bar' ) && ! class_exists( 'Notice_Bar_Pro' ) ) :

	/**
	 * Main Class.
	 */
	class Notice_Bar {

		/**
		 * Plugin instance.
		 *
		 * @var Notice_Bar The single instance of the class.
		 * @since 1.0.0
		 */
		private static $instance = null;

		/**
		 * Main Notice_Bar Instance.
		 *
		 * Ensures only one instance of Notice_Bar is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @return Notice_Bar - Main instance.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		private function __construct() {

			$this->includes();
			$this->load_notice_types();
			$this->init_hooks();

		}

		/**
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function init_hooks() {

			// Load plugin text domain for localization.
			load_plugin_textdomain( 'notice-bar', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

			// Add settings link in plugin listing.
			$plugin = plugin_basename( __FILE__ );
			add_filter( 'plugin_action_links_' . $plugin, array( $this, 'add_settings_link' ) );
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			include NOTICE_BAR_BASE_PATH . '/inc/notice-bar-functions.php';
			include NOTICE_BAR_BASE_PATH . '/inc/backend/class-notice-bar-post-type.php';
			include NOTICE_BAR_BASE_PATH . '/inc/backend/class-notice-bar-meta-tabs.php';
			include NOTICE_BAR_BASE_PATH . '/inc/backend/class-notice-bar-admin-sidebar-banners.php';
			include NOTICE_BAR_BASE_PATH . '/inc/class-notice-bar-subscribers.php';
			include NOTICE_BAR_BASE_PATH . '/inc/class-notice-bar-frontend-scripts.php';
			include NOTICE_BAR_BASE_PATH . '/inc/class-notice-bar-admin-scripts.php';
			include NOTICE_BAR_BASE_PATH . '/inc/class-notice-bar-settings.php';
		}

		/**
		 * Load notice types/ modules.
		 *
		 * @since 1.0.0
		 * @access private
		 * @return void
		 */
		private function load_notice_types() {
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/class-notice-bar-plain-text.php';
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/class-notice-bar-slider.php';
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/class-notice-bar-news-ticker.php';
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/class-notice-bar-nb-subscribe.php';
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/class-notice-bar-cta.php';
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/class-notice-bar-shortcodes.php';
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/class-notice-bar-tweets.php';
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/class-notice-bar-social-icons.php';

		}

		/**
		 * Activate.
		 *
		 * @since 1.0.0
		 */
		public static function activate() {

			/**
			 * For New version settings
			 *
			 * @version 1.0.0
			 */
			include NOTICE_BAR_BASE_PATH . '/inc/cores/activation.php';
			include NOTICE_BAR_BASE_PATH . '/inc/backend/import-notice.php';

		}

		/**
		 * Deactivate.
		 *
		 * @since 1.0.0
		 */
		public static function deactivate() {

		}

		/**
		 * Links in plugin listing.
		 *
		 * @since 1.0.0
		 *
		 * @param array $links Array of links.
		 * @return array Modified array of links.
		 */
		public static function add_settings_link( $links ) {
			$url           = add_query_arg(
				array(
					'page' => 'notice-bar',
				),
				admin_url( 'admin.php' )
			);
			$settings_link = '<a href="' . esc_url( $url ) . '">' . __( 'Settings', 'notice-bar' ) . '</a>';
			array_unshift( $links, $settings_link );
			return $links;
		}

	}

endif;

// Trigger plugin instance.
add_action( 'plugins_loaded', array( 'Notice_Bar', 'get_instance' ) );

// Activation hook.
register_activation_hook( __FILE__, array( 'Notice_Bar', 'activate' ) );

// Deactivation hook.
register_deactivation_hook( __FILE__, array( 'Notice_Bar', 'deactivate' ) );
