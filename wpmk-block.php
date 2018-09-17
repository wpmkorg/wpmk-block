<?php
/**
 * @package WPMK BLOCK
 */
/*
Plugin Name: WPMK Block
Plugin URI: https://wpmk.org/plugins/wpmk-block
Description: This Plugin Create Block for your website and you can use block any where in your theme just add block shortcode and enhance your website functions and layout, it will aslo work with visual composer.
Version: 1.0.0
Author: Mubeen Khan
Author URI: https://wpmk.org/
License: GPLv2 or later
Text Domain: wpmk
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// Define Plugin Version and compatibility.
define( 'WPMK_BLOCK_VERSION', '1.0.0' );
define( 'WPMK_BLOCK_MINIMUM_WP_VERSION', '4.9.8' );
// Define Plugin Url.
define( 'WPMK_BLOCK_URL', plugin_dir_url(__FILE__));
define( 'WPMK_BLOCK_ASSETS', WPMK_BLOCK_URL . "assets/");
// Define Plugin Dir Paht.
define( 'WPMK_BLOCK_DIR', dirname(__FILE__) . '/' );
define( 'WPMK_BLOCK_WIDGETS', WPMK_BLOCK_DIR . "widgets/");

// Plugin Activation Hook.
function wpmk_block_plugin_action_bar( $actions, $plugin_file ){
    static $plugin;
    if (!isset($plugin))
    $plugin = plugin_basename(__FILE__);
        if ( $plugin == $plugin_file ) {
            $wpmk_support = array('support' => '<a href="https://wpmk.org/support" target="_blank">Support</a>');
            $actions = array_merge( $wpmk_support, $actions );
        }
    return $actions;
}
add_filter( 'plugin_action_links', 'wpmk_block_plugin_action_bar', 10, 5 );

// Include Block Class
include_once( WPMK_BLOCK_DIR . 'classes/wpmk-block-class.php' );

// Include Widget
include_once( WPMK_BLOCK_WIDGETS . 'wpmk-widget.php' );
?>