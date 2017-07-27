<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class XERO_SETTINGS extends WC_Settings_Page{
    public function __construct(){
        $this->id    = 'xero';
        $this->label = __( 'Xero Integration',  'xero' );
        add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
        add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
        add_action( 'woocommerce_sections_' . $this->id, array( $this, 'output_sections' ) );
        
    }
    /**
     * Output sections
     */
    public function output_sections() {
        global $current_section;
        $sections = $this->get_sections();
        if ( empty( $sections ) ) {
            return;
        }
        echo '<ul class="subsubsub">';
        $array_keys = array_keys( $sections );
        echo '</ul><br class="clear" />';
    }
    
    public function output(){
        global $current_section;
        $settings = $this->xero_field_setting();
        WC_Admin_Settings::output_fields( $settings );
    }
    /**
     * Save settings
     */
    public function save() {
        global $current_section;

        if( $current_section == '' ) {
            $settings = $this->xero_field_setting();
        } elseif ( $current_section == 'best_seller' ) {
            $settings = $this->hnsf_best_seller_setting();
        } else {
            $settings = $this->hnsf_recommend_setting();
        }

        WC_Admin_Settings::save_fields( $settings );
    }
    
    public function xero_field_setting(){
        $options = '';
        global $wpdb;

        $options = apply_filters( 'woocommerce_xero_field_setting', array(

            array(  'title' 		=> __( 'Setting fields',  'hnsf'  ),
                'type' => 'title'
            ),

            array(
                'title'         => __( 'Client ID',  'hnsf'  ),
                'id'            => 'hnsf_client_id',
                'type'          => 'text'
            ),
            array(
                'title'         => __( 'Client Secret',  'hnsf'  ),
                'id'            => 'hnsf_client_secret',
                'type'          => 'text'
            ),
            array(
                'title'         => __( 'Username',  'hnsf'  ),
                'id'            => 'hnsf_username',
                'type'          => 'text'
            ),
            array(
                'title'         => __( 'Password',  'hnsf'  ),
                'id'            => 'hnsf_password',
                'type'          => 'text'
            ),

            array(
                'title'         => __( 'Security Token',  'hnsf'  ),
                'id'            => 'hnsf_security_token',
                'type'          => 'text'
            ),
            array(
                'title' => __('Sync Salesforce', 'hnsf'),
                'id' => 'hnsf_sync_salesforce',
                'type'  => 'select',
                'options' => array(
                    'auto' => 'Auto Sync Salesforce',
                    'queue' => 'Add to Queue'
                )
            ),
            array(
                'type' => 'sectionend',
                'id' => 'product_autorelated_options'
            ),
        ));

        return apply_filters ('xero_general_setting', $options );
    }
}
return new XERO_SETTINGS();