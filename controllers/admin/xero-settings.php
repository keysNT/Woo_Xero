<?php
if (! defined ( 'ABSPATH' )) exit (); // Exit if accessed directly

if (!class_exists('WC_Settings_Page'))
    include_once dirname (WOOXERO_PATH) . '/woocommerce/includes/admin/settings/class-wc-settings-page.php';

class XERO_SETTINGS extends WC_Settings_Page {
    public function __construct(){
        $this->id    = 'xero';
        $this->label = __( 'Xero Integration',  'WOOXERO_TEXT_DOMAIN' );

        add_filter ( 'woocommerce_settings_tabs_array', array ( $this, 'add_settings_page' ), 999 );
        add_action ( 'woocommerce_settings_' . $this->id, array ( $this, 'output' ) );
        add_action ( 'woocommerce_settings_save_' . $this->id, array ( $this, 'save' ) );

    }
    /**
     * Save settings
     */
    public function get_settings(){

        $options = apply_filters( 'woocommerce_xero_field_setting', array(

            array(  'title' 		=> __( 'Setting fields',  'WOOXERO_TEXT_DOMAIN'  ),
                'type' => 'title'
            ),

            array(
                'title'         => __( 'Consumer Key',  'WOOXERO_TEXT_DOMAIN'  ),
                'id'            => 'xero_consumer_key',
                'type'          => 'text'
            ),
            array(
                'title'         => __( 'Consumer secret',  'WOOXERO_TEXT_DOMAIN'  ),
                'id'            => 'xero_consumer_secret',
                'type'          => 'text'
            ),
            array(
                'title'         => __( 'App Mode',  'WOOXERO_TEXT_DOMAIN'  ),
                'id'            => 'xero_app_mode',
                'type'          => 'select',
                'options' => array (
                    'public' => __ ( 'Public', 'WOOXERO_TEXT_DOMAIN' ),
                    'partner' => __ ( 'Partner', 'WOOXERO_TEXT_DOMAIN' ),
                    'private' => __ ( 'Private', 'WOOXERO_TEXT_DOMAIN' ),
                )
            ),
            array(
                'title'         => __( 'Public Key (.cer)',  'WOOXERO_TEXT_DOMAIN'  ),
                'id'            => 'xero_public_key',
                'type'          => 'textarea'
            ),
            array(
                'title'         => __( 'Private Key (.pem)',  'WOOXERO_TEXT_DOMAIN'  ),
                'id'            => 'xero_private_key',
                'type'          => 'textarea'
            ),
        ));

        return $options;
    }
}
return new XERO_SETTINGS();