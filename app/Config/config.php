<?php

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
        'session_name' => 'user',
        'token_name' => 'token'
    ),

    'defaults' => array(
        'profile_pic' => 'man.png'
    )
);
