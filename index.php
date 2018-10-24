<?php 

Session_Start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Classes\Page;
use \Classes\PageAdmin;
use \Classes\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");
});

$app->get('/login', function() {
    
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("login");
});

$app->post('/login', function() {
    
	User::login($_POST['login'], $_POST['password']);

	header("Location: /");
	Exit;
});

$app->get('/logout', function() {
    
	User::logout();

	header("Location: /");
	Exit;
});

$app->get('/users', function(){

	User::verifyLogin();

	$users = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("users", [
		'users' => $users
	]);
});

$app->get('/users/create', function(){

	User::verifyLogin();	

	$page = new PageAdmin();

	$page->setTpl("users-create");
});

$app->get('/users/:id_user', function($id_user){

	User::verifyLogin();

	//$users = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("users-update");
});

$app->post('/users/create', function(){

	User::verifyLogin();	
	
});

$app->post('/users/:id_user', function($id_user){

	User::verifyLogin();	
	
});

$app->get('/users/:id_user/delete', function($id_user){

	User::verifyLogin();	
	
});

$app->run();

 ?>