<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//session_start();
include "vendor/autoload.php";

dump($_SESSION);
include "views/includes/header.php";

$_SESSION['token'] = 'adsfadsfdsf';

