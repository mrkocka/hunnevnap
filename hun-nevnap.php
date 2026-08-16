<?php
/**
 * Plugin Name:       HunNévnap
 * Plugin URI:        https://hunnevnap.hu
 * Description:       Magyar dátum, pontos idő és névnap Elementor widgetként.
 * Version:           2.1.0
 * Author:            Celli Egyesület
 * Text Domain:       hun-nevnap
 * Requires at least: 6.5
 * Requires PHP:      7.2
 * Requires Plugins:  elementor
 * License:           GPLv2 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HUN_NEVNAP_VERSION', '2.1.0' );
define( 'HUN_NEVNAP_PATH', plugin_dir_path( __FILE__ ) );
define( 'HUN_NEVNAP_URL', plugin_dir_url( __FILE__ ) );

/**
 * Inicializálja az Elementor-integrációt.
 */
function hun_nevnap_init() {
	load_plugin_textdomain( 'hun-nevnap', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'hun_nevnap_elementor_notice' );
		return;
	}

	add_action( 'wp_enqueue_scripts', 'hun_nevnap_register_assets' );
	add_action( 'elementor/widgets/register', 'hun_nevnap_register_widget' );
}
add_action( 'plugins_loaded', 'hun_nevnap_init', 20 );

/**
 * Regisztrálja a widget csak szükség esetén betöltődő fájljait.
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
 * Regisztrálja a dátum és névnap widgetet.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgetkezelő.
 */
function hun_nevnap_register_widget( $widgets_manager ) {
	require_once HUN_NEVNAP_PATH . 'includes/class-hun-nevnap-widget.php';
	$widgets_manager->register( new \Hun_Nevnap_Widget() );
}

/**
 * Figyelmeztet, ha az Elementor nincs aktiválva.
 */
function hun_nevnap_elementor_notice() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( 'A HunNévnap 2.0 használatához aktiválni kell az Elementor bővítményt.', 'hun-nevnap' )
	);
}
