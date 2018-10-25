<?php 

use \Classes\PageAdmin;
use \Classes\Model\User;

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


?>