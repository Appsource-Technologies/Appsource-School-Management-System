<?php

error_reporting(1);
//session_start();
//'mysql' => array(
//         'host' => '127.0.0.1',
//         'username' => 'root',
//         'password' => 'root@1',
//         'db' => 'parking_db'
//     ),
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'appsource-ss-5'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);
//require_once 'classes/config.php';
//require_once 'classes/config.php';
//require_once 'classes/config.php';
spl_autoload_register(function($class) {
    if (file_exists('classes/' . $class . '.php')) {
        require_once 'classes/' . $class . '.php';
        return TRUE;
    } 
        return FALSE;
   
    
});
require_once 'functions/functions.php';
$queryMSetting = DB::getInstance()->query("select * from m_setting");
foreach ($queryMSetting->results() as $result):
    $SCHOOL_NAME = $result->schoo_name;
    $MOTTO = $result->mottto;
    $LOGO_PATH = $result->logo_path;
    $ADDRESS = $result->address;
    $TEL = $result->tel;
    $EMAIL=$result->email;
    $LOCATION=$result->location;
endforeach;

?>