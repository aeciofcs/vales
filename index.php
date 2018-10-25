<?php 

Session_Start();
require_once("vendor/autoload.php");

use \Slim\Slim;

$app = new Slim();

$app->config('debug', true);

require_once("route-login.php");
require_once("route-users.php");
require_once("route-vouchers.php");

$app->run();

 ?>