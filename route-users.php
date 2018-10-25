<?php

use \Classes\PageAdmin;
use \Classes\Model\User;

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

	$page->setTpl("users-create", [
		"MsgError" => User::getError()
	]);
});

$app->get('/users/:id_user/delete', function($id_user){

	User::verifyLogin();

	$user = New User();
	$user->get((int)$id_user);
	$user->delete();
	
	header("Location: /users");
	Exit;
});

$app->get('/users/:id_user', function($id_user){

	User::verifyLogin();

	$user = New User();
	$user->get((int)$id_user);

	$page = new PageAdmin();

	$page->setTpl("users-update", [
		"user" => $user->getValues()
	]);
});

$app->post('/users/create', function(){

	User::verifyLogin();

	$user = New User();
	if ( !isset($_POST['des_person']) || $_POST['des_person'] === '' ) {
		User::setError("Digite o seu nome.");
		header("Location: /users/create");
		Exit;
	}
	if ( !isset($_POST['des_pis']) || $_POST['des_pis'] === '' ) {
		User::setError("Digite o N° do seu PIS/PASEP.");
		header("Location: /users/create");
		Exit;
	}
	if ( !isset($_POST['des_cpf']) || $_POST['des_cpf'] === '' ) {
		User::setError("Digite o N° do seu CPF.");
		header("Location: /users/create");
		Exit;
	}
	if ( !isset($_POST['num_salario']) || $_POST['num_salario'] === '' ) {
		User::setError("Digite o valor da Remuneração.");
		header("Location: /users/create");
		Exit;
	}
	if ( !isset($_POST['nr_phone']) || $_POST['nr_phone'] === '' ) {
		User::setError("Digite o valor da Remuneração.");
		header("Location: /users/create");
		Exit;
	}
	$_POST['inadmin'] = (isset($_POST['inadmin'])) ? 1 : 0;
	$user->setData($_POST);	
	$user->save();

	header("Location: /users");
	Exit;	
});

$app->post('/users/:id_user', function($id_user){

	User::verifyLogin();

	$user = New User();
	$user->get((int)$id_user);

	$_POST['inadmin'] = (isset($_POST['inadmin'])) ? 1 : 0;
	$user->setData($_POST);
	$user->update();

	header("Location: /users");
	Exit;
});

$app->get('/forgot', function(){
	
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);
	$page->setTpl("forgot", [
			"MsgError" => User::getError() ]);
});

$app->post('/forgot', function(){
	
	if (!isset($_POST['des_cpf']) || $_POST['des_cpf'] === "") {
		User::setError("Digite o seu CPF.");
		header("Location: /forgot");
		Exit;
	}
	if ( strlen($_POST['des_cpf']) <> 11 ) {
		User::setError("Verifique a quantidade de dígitos do seu CPF.");
		header("Location: /forgot");
		Exit;
	}
	
	$user = User::getForgot((string)$_POST['des_cpf']);
	
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);
	$page->setTpl("forgot-reset", [ 
		"name"    => $user['des_login'],
		"des_cpf" => $user['des_cpf']
		]);	
});

$app->post('/forgot/reset', function(){

	if (!isset($_POST['des_password']) || $_POST['des_password'] === "") {
		User::setError("Digite a nova senha.");
		header("Location: /forgot");
		Exit;
	}	
	
	$user = New User();
	$user->getCPF((string)$_POST['des_cpf']);
	$user->setPassword($_POST["des_password"]);
	
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);
	$page->setTpl("forgot-reset-success");
});

?>