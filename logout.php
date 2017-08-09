<?php
require_once "vendor/autoload.php";

use \Classes\Member\MembershipService;
use \Classes\Util\Redirect;

$objMembershipService = new MembershipService();
$objMembershipService->logout();

Redirect::to('index.php');