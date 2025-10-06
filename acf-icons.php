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
if ( $api ) {
    $api->addFilter('release_assets', function($assets, $release, $api) {
        foreach ($assets as $asset) {
            if (strpos($asset->name, 'acf-icons-') !== false && str_ends_with($asset->name, '.zip')) {
                return [$asset];
            }
        }
        return $assets;
    }, 10, 3);
}

function acf_icons_init() {

}
add_action( 'plugins_loaded', 'acf_icons_init' );


