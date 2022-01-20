<?php
/**
 * Plugin Name:     Pantheon Decoupled Gatsby
 * Plugin URI:      https://pantheon.io/
 * Description:     Configuration necessary for using WordPress with Gatsby on Pantheon.
 * Version:         0.1.0
 * Author:          Pantheon
 * Author URI:      https://pantheon.io/
 * Text Domain:     pantheon-decoupled-gatsby
 * Domain Path:     /languages
 *
 * @package         Pantheon_Decoupled
 */

register_activation_hook( __FILE__, 'pantheon_decoupled_gatsby_enable_deps' );

function pantheon_decoupled_gatsby_enable_deps() {
  activate_plugin( 'pantheon-decoupled/pantheon-decoupled.php' );
  activate_plugin( 'wp-gatsby/wp-gatsby.php' );
}
