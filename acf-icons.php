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

// ✅ Charger l’autoloader Composer
if ( file_exists( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
}

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// 🧩 Configuration du système de mise à jour automatique via GitHub
$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/DimitriBertin/acf-icons/', // URL de ton repo GitHub
    __FILE__,                                   // Fichier principal du plugin
    'acf-icons'                                 // Slug unique du plugin
);

// 🪄 Définir la branche contenant les versions stables (souvent "main" ou "master")
$myUpdateChecker->setBranch('main');

// 👇 Ajoute ce bloc pour cibler ton ZIP custom
$myUpdateChecker->getVcsApi()->addFilter('release_assets', function($assets, $release, $api) {
  foreach ($assets as $asset) {
      if (strpos($asset->name, 'acf-icons-') !== false && str_ends_with($asset->name, '.zip')) {
          return [$asset];
      }
  }
  return $assets;
}, 10, 3);

// 🔧 Initialisation du plugin
function acf_icons_init() {
    // Ton code ici (par ex. : register ACF fields, etc.)
}
add_action( 'plugins_loaded', 'acf_icons_init' );
