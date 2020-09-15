<?php

/**
 * Plugin Name:        Just Another Maintenance Mode
 * Plugin URI:         https://github.com/XDoubleU/j-a-maintenance-mode
 * Description:        Adds maintenance mode.
 * Version:            1.0.2-alpha
 * Author:             Xander Warszawski
 * Author URI:         https://xdoubleu.com
 * License:            GNU General Public License v3.0
 * License URI:        https://github.com/XDoubleU/j-a-maintenance-mode/blob/master/LICENSE
 * GitHub Plugin URI:  https://github.com/XDoubleU/j-a-maintenance-mode
**/

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

$protocol = $_SERVER[“SERVER_PROTOCOL”];
if ( ‘HTTP/1.1’ != $protocol && ‘HTTP/1.0’ != $protocol )
$protocol = ‘HTTP/1.0’;
header( “$protocol 503 Service Unavailable”, true, 503 );
header( ‘Content-Type: text/html; charset=utf-8’ );
?>
<html xmlns=”http://ift.tt/pUEAca;
<body>
<h1>Briefly unavailable for scheduled maintenance. Check back in a minute.</h1>
</body>
</html>
<?php die();
/* END Maintenance Mode front-end */
