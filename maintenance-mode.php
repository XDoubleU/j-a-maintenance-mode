<?php

/**
 * Plugin Name:        Just Another Maintenance Mode
 * Plugin URI:         https://github.com/XDoubleU/j-a-maintenance-mode
 * Description:        Adds maintenance mode.
 * Version:            1.0.0
 * Author:             Xander Warszawski
 * Author URI:         https://xdoubleu.com
 * License:            GNU General Public License v3.0
 * License URI:        https://github.com/XDoubleU/j-a-maintenance-mode/blob/master/LICENSE
 * GitHub Plugin URI:  https://github.com/XDoubleU/j-a-maintenance-mode
**/

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

function maintenance_mode_register_settings() {
  add_option( 'maintenance_mode_active', 'false');
  register_setting( 'maintenance_mode_options_group', 'maintenance_mode_active', 'maintenance_mode_callback' );
}
add_action( 'admin_init', 'maintenance_mode_register_settings' );

function maintenance_mode_register_options_page() {
  add_dashboard_page('Maintenance Mode', 'Maintenance Mode', 'manage_options', 'maintenance_mode', 'maintenance_mode_options_page');
}
add_action('admin_menu', 'maintenance_mode_register_options_page');

function maintenance_mode_options_page(){
  $is_enabled = get_option('maintenance_mode_active');
  ?>
  <div>
    <?php screen_icon(); ?>
    <h1>Maintenance Mode Settings</h1>
    <form method="post" action="options.php">
      <?php settings_fields( 'maintenance_mode_options_group' ); ?>
      <table>
        <tr valign="top">
          <th scope="row"><label for="maintenance_mode_active">Maintenance Mode</label></th>
          <td>
            <input name="maintenance_mode_active" value="on" type="checkbox" <?php echo checked( $is_enabled === "on");?>>
          </td>
        </tr>
      </table>
      <?php  submit_button(); ?>
    </form>
  </div>
  <?php
}

/* START Maintenance Mode front-end */
function display_maintenance_mode(){
  $is_enabled = get_option('maintenance_mode_active');
  if($is_enabled === "on"){
    $request_uri =  str_replace("/", '',"$_SERVER[REQUEST_URI]");
    if(!is_user_logged_in() && $request_uri != "hackerman"){
      $protocol = $_SERVER["SERVER_PROTOCOL"];
      if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
      $protocol = 'HTTP/1.0';
      header( "$protocol 503 Service Unavailable", true, 503 );
      header( 'Content-Type: text/html; charset=utf-8' );
      ?>
      <html>
      <body>
      <h1>Briefly unavailable for scheduled maintenance.</h1>
      </body>
      </html>
      <?php die();
    }
  }
}
add_action('init', 'display_maintenance_mode');
/* END Maintenance Mode front-end */
