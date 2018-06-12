<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.imagemattersllc.com/
 * @since             1.0.0
 * @package           Geop_Search
 *
 * @wordpress-plugin
 * Plugin Name:       GeoPlatform Search
 * Plugin URI:        www.geoplatform.gov
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Image Matters LLC
 * Author URI:        http://www.imagemattersllc.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       geoplatform-search
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-geoplatform-search-activator.php
 */
function activate_geop_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-geoplatform-search-activator.php';
	Geop_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-geoplatform-search-deactivator.php
 */
function deactivate_geop_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-geoplatform-search-deactivator.php';
	Geop_Search_Deactivator::deactivate();
}

// Applies our custom page template to the created page.
add_filter('page_template', 'geopsearch_page_template');
function geopsearch_page_template($page_template) {
    if (is_page('search'))
        $page_template = dirname( __FILE__ ) . '/public/partials/geoplatform-search-page-template.php';
    return $page_template;
}

// Sets the parameters of and then creates the search page.
function geopsearch_add_interface_page() {
	wp_delete_post(url_to_postid( get_permalink( get_page_by_title( 'GeoPlatform Search' ))), true);
	$interface_post = array(
		'post_title' => 'GeoPlatform Search',
		'post_name' => 'search',
		'post_content' => '',
		'post_status' => 'publish',
		'post_type' => 'page'
	);
	wp_insert_post($interface_post);
}

// Activation hooks, includiong our interface addition to fire on activation.
register_activation_hook( __FILE__, 'activate_geop_search' );
register_activation_hook( __FILE__, 'geopsearch_add_interface_page' );
register_deactivation_hook( __FILE__, 'deactivate_geop_search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-geoplatform-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_geop_search() {

	$plugin = new Geop_Search();
	$plugin->run();

}
run_geop_search();
