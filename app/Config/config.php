<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'mystory');


$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'db' => 'mystory'
    ),

    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),

    'session' => array(
        'session_name' => 'user'
    )
);