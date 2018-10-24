<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Classes\Page;
use \Classes\PageAdmin;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new PageAdmin();

	$page->setTpl("index");	

});

$app->run();

 ?>