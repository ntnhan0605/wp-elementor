<?php
/**
 * Plugin Name: NTN EXT
 * Description: Custom Elementor extension.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      NTN
 * Author URI:  https://elementor.com/
 * Text Domain: ntn-ext
 *
 * @package NTN Plugin
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define('VERSION', '1.0.0');
define('MINIMUM_ELEMENTOR_VERSION', '2.0.0');
define('MINIMUM_PHP_VERSION', '5.2');
define('ASSETS_DIR', __DIR__.'/assets/');
define('WIDGETS_DIR', __DIR__.'/widgets/');
define('CONTROLS_DIR', __DIR__.'/controls/');

final class ntnExt
{

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {

		add_action('init', [ $this, 'init' ]);

	}

	public function init() {
		load_plugin_textdomain( 'ntn-ext' );

		if ( !did_action('elementor/loaded') ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ]);
			return;
		}

		if ( !version_compare(ELEMENTOR_VERSION, MINIMUM_ELEMENTOR_VERSION, '>=') ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ]);
			return;
		}

		if ( !version_compare(PHP_VERSION, MINIMUM_PHP_VERSION, '>=') ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ]);
			return;
		}

		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ]);
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ]);
	}

	public function admin_notice_missing_main_plugin() {
		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}

		$plugin = 'elementor/elementor.php';

		if ( _is_elementor_installed() ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

			$message = '<p>' . __( 'NTN Ext is not working because you need to activate the Elementor plugin.', 'ntn-ext' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'ntn-ext' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

			$message = '<p>' . __( 'NTN Ext is not working because you need to install the Elementor plugin.', 'ntn-ext' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'ntn-ext' ) ) . '</p>';
		}

		echo '<div class="error"><p>' . $message . '</p></div>';
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_controls() {
		$control_files = glob(CONTROLS_DIR.'*.php');
		foreach ($control_files as $control_file) {
			require_once($control_file);
		}
	}

	public function init_widgets() {
		function add_elementor_widget_categories($elementor_manager) {
			$elementor_manager->add_category(
				'ntn-ext',
				[
					'title' => __('NTN Ext', 'ntn-ext'),
					'icon' => 'fa fa-plug'
				]
			);
		}

		add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

		$widget_files = glob(WIDGETS_DIR.'*.php');
		foreach ($widget_files as $widget_file) {
			require_once($widget_file);
		}
	}
}

if ( ! function_exists( '_is_elementor_installed' ) ) {

	function _is_elementor_installed() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
}

ntnExt::instance();