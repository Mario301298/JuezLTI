<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    JuezLTI
 * @subpackage JuezLTI/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    JuezLTI
 * @subpackage JuezLTI/includes
 * @author     Your Name <email@example.com>
 */
class JuezLTI_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::JuezLTIInstallInstituciones();
	}

	private static function JuezLTIInstallInstituciones() {
    global $wpdb;

    $table_name = $wpdb->prefix . "instituciones";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      nombre varchar(100) DEFAULT '' NOT NULL,
      email varchar(100) DEFAULT '' NOT NULL,
      url_logotipo varchar(200) DEFAULT '' NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

	}

}
