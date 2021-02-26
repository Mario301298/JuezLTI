<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://JuezLTI.es
 * @since             1.0.0
 * @package           JuezLTI
 *
 * @wordpress-plugin
 * Plugin Name:       JuezLTI
 * Plugin URI:        http://example.com/JuezLTI-uri/
 * Description:       Plugin que se usa para la gestión de los avances que se vayan produciendo en el desarrollo
 * Version:           1.0.0
 * Author:            Mario
 * Author URI:        https://JuezLTI.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       JuezLTI
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'JuezLTI_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-JuezLTI-activator.php
 */
function activate_JuezLTI() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-JuezLTI-activator.php';
	JuezLTI_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-JuezLTI-deactivator.php
 */
function deactivate_JuezLTI() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-JuezLTI-deactivator.php';
	JuezLTI_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_JuezLTI' );
register_deactivation_hook( __FILE__, 'deactivate_JuezLTI' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-JuezLTI.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_JuezLTI() {

	$plugin = new JuezLTI();
	$plugin->run();

}
run_JuezLTI();
