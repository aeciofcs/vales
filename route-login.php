<?php 

use \Classes\PageAdmin;
use \Classes\Model\User;
use \Classes\Model\Ponto;


$app->get('/', function() {

	User::verifyLogin();
	
	/*
	$data = Ponto::loadFromUsers();	
	
	foreach ($data as $user) {		
		foreach ($user as $key => $value) {
			if ($key === 'name') {
				//Echo "<dt>$key</dt><dd>$value</dd>";
				//Echo $key." = ". $value;
				//Echo "<br>$value</br>";
				Echo "$key => $value<br>";
			}			
		}		
	}
	
	Exit;*/
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