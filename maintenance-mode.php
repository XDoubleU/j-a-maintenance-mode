<?php

/**
 * Plugin Name:        Just Another Maintenance Mode
 * Plugin URI:         https://github.com/XDoubleU/j-a-maintenance-mode
 * Description:        Adds maintenance mode.
 * Version:            1.0.1-alpha
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
  if(not is_user_logged_in()){
    echo $html;
  }
}
add_action( 'astra_masthead_content', 'display_search_bar' );
/* END Maintenance Mode front-end */
