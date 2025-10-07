<?php
/**
 * Plugin Name: ACF Icons
 * Description: Add any icons from library.
 * Version: 0.0.5
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
if ( $api ) {
	// Va chercher un asset nommé "acf-icons-*.zip"
	$api->enableReleaseAssets('/^acf-icons-.*\.zip$/');
	
	// Si le repo est privé, ajoute ton token GitHub :
	// $myUpdateChecker->setAuthentication('ghp_XXXXXXX');
}


// 🔁 Vérifier automatiquement les mises à jour quand on est sur l'admin
add_action('admin_init', function() use ($myUpdateChecker) {
	// On ne vérifie qu'une fois par chargement admin
	if ( current_user_can('update_plugins') ) {
		$myUpdateChecker->checkForUpdates();
	}
});

// 🚫 Supprimer le lien “Check for updates”
add_filter('puc_manual_check_link-acf-icons', '__return_empty_string');


function acf_icons_init() {

}
add_action( 'plugins_loaded', 'acf_icons_init' );


