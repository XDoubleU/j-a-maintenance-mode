<?php

/**
 * Plugin Name:        Just Another Maintenance Mode
 * Plugin URI:         https://github.com/XDoubleU/j-a-maintenance-mode
 * Description:        Adds maintenance mode.
 * Version:            1.0.0-alpha
 * Author:             Xander Warszawski
 * Author URI:         https://xdoubleu.com
 * License:            GNU General Public License v3.0
 * License URI:        https://github.com/XDoubleU/j-a-maintenance-mode/blob/master/LICENSE
 * GitHub Plugin URI:  https://github.com/XDoubleU/j-a-maintenance-mode
**/

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

function maintenance_mode_enqueue_scripts() {
    $html = file_get_contents(plugins_url('/assets/html/maintenance_mode.html',__FILE__ ));
}
add_action('wp_enqueue_scripts', 'maintenance_mode_enqueue_scripts');

/* START Maintenance Mode front-end*/
function display_search_bar () {
  /* Check if user is logged in*/
  $user = wp_get_current_user();
  $is_logged_in = $user->exists();
  if(!$is_logged_in){
    echo $html;
  }
}
add_action( 'astra_masthead_content', 'display_search_bar' );
/* END Maintenance Mode front-end */
