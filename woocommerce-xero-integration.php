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
        require WOOXERO_PATH.'controllers/authentication/XeroOAuth.php';
        require WOOXERO_PATH.'controllers/authentication/OAuthSimple.php';
        add_action ( 'init', array ($this,'load_text_domain' ), 1 );
        add_action('wp_enqueue_scripts', array($this,'addStyles'));
        add_action('wp_enqueue_scripts', array($this,'addScripts'));
        //add_action('wp_enqueue_scripts', array($this,'load_custom_scripts'));
        if (is_admin ()) {
            include_once WOOXERO_PATH .'controllers/admin/xero-settings.php';
            add_action ( 'admin_enqueue_scripts', array ($this,'load_admin_scripts' ), 99 );
            add_action('admin_menu', array($this, 'create_admin_menu'), 5);
        }
    }
    function create_admin_menu(){
        global $menu;
        include_once WOOXERO_PATH .'controllers/admin/xero-admin.php';
        $admin = new XERO_ADMIN();
        add_menu_page(__('Xero', WOOXERO_TEXT_DOMAIN), __('Xero', WOOXERO_TEXT_DOMAIN), 'manage_woocommerce','xero', array($admin,'testConnect' ));
       // add_submenu_page ( 'salesforce', __ ( 'Report sync data', WOOXERO_TEXT_DOMAIN ), __ ( 'Report sync data', WOOXERO_TEXT_DOMAIN), 'manage_woocommerce', 'report_sync_data', array($admin,'report_sync_data' ));

        //add_submenu_page('admin.php?page=salesforce', __('Report sync data', SALESFORCE_TEXT_DOMAIN), __('Report sync data', SALESFORCE_TEXT_DOMAIN), 'manage_woocommerce', 'salesforce', array($admin,'index' ));
    }
    public function add_settings_page(){
        $settings [] = include (WOOXERO_PATH. 'controllers/admin/salesforce-settings.php');
        return apply_filters ( 'xero_setting_classes', $settings );
    }
    public function addStyles(){
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('	jquery-ui-datepicker');
        wp_enqueue_script('jquery-ui-widget');
    }

    public function addScripts(){
        wp_enqueue_media();
        // Enqueue JavaScript.
        if (!wp_script_is('jquery', 'queue')){
            wp_enqueue_script('jquery');
        }
        if (!wp_script_is('jquery-ui-sortable', 'queue')){
            wp_enqueue_script('jquery-ui-sortable');
        }
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('	jquery-ui-datepicker');
        wp_enqueue_script('jquery-ui-widget');
    }

    public function load_admin_scripts($hook){
        global $woocommerce;
        if (is_object($woocommerce))
            wp_enqueue_style ( 'woocommerce_admin_styles', $woocommerce->plugin_url () . '/assets/css/admin.css' );
            wp_enqueue_style('magenestxero' , WOOXERO_URL .'/assets/css/style.css');

    }

    public function load_text_domain(){
        load_plugin_textdomain ( WOOXERO_TEXT_DOMAIN, false, 'woocommerce-xero-integration/languages' );
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