<?php
/**
Plugin Name: Woocommerce xero integration
Plugin URI: http://store.magenest.com/
Description:
Version: 1.0
Author: Magenest
Author URI:
License:
Text Domain: WOOXERO
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly


if (!defined('WOOXERO_TEXT_DOMAIN'))
    define('WOOXERO_TEXT_DOMAIN', 'WOOXERO');

// Plugin Folder Path
if (!defined('WOOXERO_PATH'))
    define('WOOXERO_PATH', plugin_dir_path(__FILE__));

// Plugin Folder URL
if (!defined('WOOXERO_URL'))
    define('WOOXERO_URL', plugins_url('woocommerce-xero-integration', 'woocommerce-xero-integration.php'));

// Plugin Root File
if (!defined('WOOXERO_FILE'))
    define('WOOXERO_FILE', plugin_basename(__FILE__));

class MAGENEST_WOOXERO_MAIN{

    //Plugin version
    const VERSION = '1.0';

    private static $xero_integration;
    public function __construct(){
        global $wpdb;
        add_filter ( 'woocommerce_settings_tabs_array', array ($this,'add_settings_page' ), 10);
    }
    public function add_settings_page(){
        $settings [] = include (WOOXERO_PATH. 'controllers/admin/salesforce-settings.php');
        return apply_filters ( 'xero_setting_classes', $settings );
    }
    /**
     * Get the singleton instance of our plugin
     *
     * @return class The Instance
     * @access public
     */
    public static function getInstance() {
        if (! self::$xero_integration) {
            self::$xero_integration = new MAGENEST_WOOXERO_MAIN();
        }
        return self::$xero_integration;
    }
}
return new MAGENEST_WOOXERO_MAIN();
?>