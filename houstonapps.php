<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/dinab881
 * @since             1.0.0
 * @package           Houstonapps
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin for houstonapps theme
 * Plugin URI:        https://github.com/dinab881/plugin-houstonapps
 * Description:       Adds custom post types and special meta boxes to hustonapps theme
 * Version:           1.0.0
 * Author:            Dina
 * Author URI:        https://github.com/dinab881
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       houstonapps
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-houstonapps-activator.php
 */
function activate_houstonapps() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-houstonapps-activator.php';
	Houstonapps_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-houstonapps-deactivator.php
 */
function deactivate_houstonapps() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-houstonapps-deactivator.php';
	Houstonapps_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_houstonapps' );
register_deactivation_hook( __FILE__, 'deactivate_houstonapps' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-houstonapps.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_houstonapps() {

	$plugin = new Houstonapps();
	$plugin->run();

}
run_houstonapps();
