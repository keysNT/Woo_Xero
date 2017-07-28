<?php

/**
 * Created by PhpStorm.
 * User: magenest4
 * Date: 28/07/2017
 * Time: 13:33
 */
class XERO_ADMIN
{
    public function testConnect(){
        //getOAuth
        include WOOXERO_PATH .'controllers/xero-connector-controller.php';
        $a = new XERO_CONNECTOR_CONTROLLER();
        $b = $a->getOAuth();
        $template_path = WOOXERO_PATH.'views/';
        $default_path = WOOXERO_PATH.'views/';
        wc_get_template('xero-template-admin.php', array('link' => $b),$template_path,$default_path );
    }
}