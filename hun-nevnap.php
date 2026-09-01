<?php
/**
 * Plugin Name:       HunNévnap
 * Plugin URI:        https://hunnevnap.hu
 * Description:       Displays Hungarian name days, the date, and a live clock in a customizable Elementor widget.
 * Version:           2.1.0
 * Author:            Mrkocka
 * Author URI:        https://mrkocka.hu/
 * Text Domain:       hun-nevnap
 * Requires at least: 6.5
 * Requires PHP:      7.2
 * Requires Plugins:  elementor
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HUN_NEVNAP_VERSION', '2.1.0' );
define( 'HUN_NEVNAP_MINIMUM_ELEMENTOR_VERSION', '3.5.0' );
define( 'HUN_NEVNAP_PATH', plugin_dir_path( __FILE__ ) );
define( 'HUN_NEVNAP_URL', plugin_dir_url( __FILE__ ) );

/**
 * Initializes the Elementor integration.
 */
function hun_nevnap_init() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'hun_nevnap_elementor_notice' );
		return;
	}

	if ( ! defined( 'ELEMENTOR_VERSION' ) || version_compare( ELEMENTOR_VERSION, HUN_NEVNAP_MINIMUM_ELEMENTOR_VERSION, '<' ) ) {
		add_action( 'admin_notices', 'hun_nevnap_elementor_version_notice' );
		return;
	}

	add_action( 'wp_enqueue_scripts', 'hun_nevnap_register_assets' );
	add_action( 'elementor/widgets/register', 'hun_nevnap_register_widget' );
}
add_action( 'plugins_loaded', 'hun_nevnap_init', 20 );

/**
 * Registers the widget assets.
 */
function hun_nevnap_register_assets() {
	wp_register_script(
		'hun-nevnap-widget',
		HUN_NEVNAP_URL . 'assets/hun-nevnap.js',
		array(),
		HUN_NEVNAP_VERSION,
		true
	);

	wp_register_style(
		'hun-nevnap-widget',
		HUN_NEVNAP_URL . 'assets/hun-nevnap.css',
		array(),
		HUN_NEVNAP_VERSION
	);
}

/**
 * Registers the date and name-day widget.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 */
function hun_nevnap_register_widget( $widgets_manager ) {
	require_once HUN_NEVNAP_PATH . 'includes/class-hun-nevnap-widget.php';
	$widgets_manager->register( new \Hun_Nevnap_Widget() );
}

/**
 * Warns administrators when Elementor is not active.
 */
function hun_nevnap_elementor_notice() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
		esc_html__( 'HunNévnap requires the Elementor plugin to be installed and activated.', 'hun-nevnap' )
	);
}

/**
 * Warns administrators when the installed Elementor version is too old.
 */
function hun_nevnap_elementor_version_notice() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
		esc_html__( 'HunNévnap requires Elementor 3.5.0 or newer. Please update Elementor.', 'hun-nevnap' )
	);
}
