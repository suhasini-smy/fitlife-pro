<?php

/*
Plugin Name: FitLife Core
Description: Core functionality for FitLife.
Version: 1.0
Author: Suhasini
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


define( 'FITLIFE_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'FITLIFE_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once FITLIFE_CORE_PATH . 'includes/meta-boxes/trainer-meta.php';
require_once FITLIFE_CORE_PATH . 'includes/meta-boxes/program-meta.php';
require_once FITLIFE_CORE_PATH . 'includes/rest-api/endpoints.php';
require_once FITLIFE_CORE_PATH . 'includes/cpt/register-cpt.php';

require_once FITLIFE_CORE_PATH . 'admin/settings-page.php';
require_once FITLIFE_CORE_PATH . 'includes/shortcodes/trainers-shortcode.php';
require_once FITLIFE_CORE_PATH . 'includes/shortcodes/programs-shortcode.php';
require_once FITLIFE_CORE_PATH . 'includes/blocks.php';

require_once FITLIFE_CORE_PATH . 'includes/cpt/register-cpt.php';
require_once FITLIFE_CORE_PATH . 'includes/patterns.php';

function fitlife_editor_styles() {

    add_editor_style(
        plugin_dir_url( __FILE__ ) .
        'assets/css/editor-style.css'
    );

}

add_action(
    'after_setup_theme',
    'fitlife_editor_styles'
);