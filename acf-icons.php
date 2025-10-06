<?php
/**
 * Plugin Name: ACF Icons
 * Description: Add any icons from library.
 * Version: 0.0.1
 * Author: Dimitri Bertin
 * Author URI: https://dimitribertin.com
 * License: GPL2
 * Text Domain: acf-icons
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
}

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/DimitriBertin/acf-icons/',
    __FILE__,
    'acf-icons'
);

$myUpdateChecker->setBranch('main');

$api = $myUpdateChecker->getVcsApi();
$api = $myUpdateChecker->getVcsApi();
if ( $api ) {
	// Va chercher un asset nommé "acf-icons-*.zip"
	$api->enableReleaseAssets('/^acf-icons-.*\.zip$/');
	
	// Si le repo est privé, ajoute ton token GitHub :
	// $myUpdateChecker->setAuthentication('ghp_XXXXXXX');
}


function acf_icons_init() {

}
add_action( 'plugins_loaded', 'acf_icons_init' );


