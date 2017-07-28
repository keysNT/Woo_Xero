<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define('BASE_PATH',dirname(__FILE__));//XeroInte/wp-content/plugins/woocommerce-xero-integration/controllers



class XERO_CONNECTOR_CONTROLLER{
    function __construct(){
        
    }

    function getOAuth(){
        $consumer = get_option('xero_consumer_key' );
        $consumer_secret = get_option('xero_consumer_secret');
        $public_key = get_option('xero_public_key');
        $private_key = get_option('xero_private_key');
        $app_mode = get_option('xero_app_mode');
        $xero_app_type = '';
        $user_agent = 'magenest_test';
        $call_back = 'http://localhost/XeroInte/';//oob
        switch ($app_mode){
            case 'public':
                $xero_app_type = 'Public';
                $user_agent .= '_public';
                break;
            case 'partner':
                $xero_app_type = 'Partner';
                $user_agent .= '_partner';
                break;
            case 'private':
                $xero_app_type = ' Private';
                $user_agent .= '_private';
                break;
        }
        $signatures = array (
            'consumer_key' => $consumer,
            'shared_secret' => $consumer_secret,
            // API versions
            'core_version' => '2.0',
            'payroll_version' => '1.0',
            'file_version' => '1.0'
        );
        if ($xero_app_type =="Private"||$xero_app_type=="Partner") {
            $signatures['rsa_private_key']= BASE_PATH . '/certs/privatekey.pem';
            $signatures['rsa_public_key']= BASE_PATH . '/certs/publickey.cer';
        }
        //include BASE_PATH.'/authentication/XeroOAuth.php';
        $XeroOAuth = new XeroOAuth ( array_merge ( array (
            'application_type' => $xero_app_type,
            'oauth_callback' => $call_back,
            'user_agent' => $user_agent
        ), $signatures ) );

        $initialCheck = $XeroOAuth->diagnostics ();
        $checkErrors = count ( $initialCheck );
        $message = '';
        if ($checkErrors > 0) {
            // you could handle any config errors here, or keep on truckin if you like to live dangerously
            foreach ( $initialCheck as $check ) {
                $message = 'Error: ' . $check . PHP_EOL;
            }
        }else{
            $message = 'Connect!';
            $here = XeroOAuth::php_self ();
            session_start ();
            $oauthSession = $this->retrieveSession ();

            $params = array (
                'oauth_callback' => $call_back
            );

            $response = $XeroOAuth->request ( 'GET', $XeroOAuth->url ( 'RequestToken', '' ), $params );
            //var_dump($response); exit('huhu');
            if ($XeroOAuth->response ['code'] == 200) {

                $scope = "";
                // $scope = 'payroll.payrollcalendars,payroll.superfunds,payroll.payruns,payroll.payslip,payroll.employees,payroll.TaxDeclaration';
                //if ($_REQUEST ['authenticate'] > 1)
                    $scope = 'payroll.employees,payroll.payruns,payroll.timesheets';

                print_r ( $XeroOAuth->extract_params ( $XeroOAuth->response ['response'] ) );
                $_SESSION ['oauth'] = $XeroOAuth->extract_params ( $XeroOAuth->response ['response'] );
                var_dump($_SESSION ['oauth']);
                $authurl = $XeroOAuth->url ( "Authorize", '' ) . "?oauth_token={$_SESSION['oauth']['oauth_token']}&scope=" . $scope;
                $message = '<p>To complete the OAuth flow follow this URL: <a href="' . $authurl . '">' . $authurl . '</a></p>';
            } else {
                $this->outputError ( $XeroOAuth );
            }
        }
        return $message;
    }

    function outputError($XeroOAuth){
        echo 'Error: ' . $XeroOAuth->response['response'] . PHP_EOL;
        $this->pr($XeroOAuth);
    }
    function pr($obj)
    {

        if (!($this->is_cli()))
            echo '<pre style="word-wrap: break-word">';
        if (is_object($obj))
            print_r($obj);
        elseif (is_array($obj))
            print_r($obj);
        else
            echo $obj;
        if (!($this->is_cli()))
            echo '</pre>';
    }

    function is_cli()
    {
        return (PHP_SAPI == 'cli' && empty($_SERVER['REMOTE_ADDR']));
    }
    function retrieveSession(){
        if (isset($_SESSION['access_token'])) {
            $response['oauth_token']            =    $_SESSION['access_token'];
            $response['oauth_token_secret']     =    $_SESSION['oauth_token_secret'];
            $response['oauth_session_handle']   =    $_SESSION['session_handle'];
            return $response;
        } else {
            return false;
        }

    }
    function sendRequest(){

    }
}

?>