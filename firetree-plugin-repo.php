<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   FireTree_Plugin_Repo
 * @author    Daniel Milner <daniel@firetreedesign.com>
 * @license   GPL-2.0+
 * @link      http://firetreedesign.com/
 * @copyright 2014 FireTree Design
 *
 * @wordpress-plugin
 * Plugin Name:       FireTree Plugin Repo
 * Plugin URI:        http://firetreedesign.com/
 * Description:       Manage your own self-hosted plugin repo.
 * Version:           0.1.2
 * Author:            FireTree Design, LLC
 * Author URI:        http://firetreedesign.com/
 * Text Domain:       firetree-plugin-repo
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

const FIRETREE_PLUGIN_REPO_SLUG = 'ftpr_update';

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-firetree-plugin-repo.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'FireTree_Plugin_Repo', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'FireTree_Plugin_Repo', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'FireTree_Plugin_Repo', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-firetree-plugin-repo-admin.php' );
	add_action( 'plugins_loaded', array( 'FireTree_Plugin_Repo_Admin', 'get_instance' ) );

}
