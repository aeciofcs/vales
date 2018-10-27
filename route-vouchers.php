<?php 

use \Classes\PageAdmin;
use \Classes\Model\User;
use \Classes\Model\Voucher;

$app->get('/vouchers', function(){
	User::verifyLogin();
	User::verifyAdmin();

	$vouchers = Voucher::listAll();

	$page = New PageAdmin();
	$page->setTpl("vouchers", [
		'vouchers' => $vouchers
	]);

});

$app->get('/voucher/create', function(){
	User::verifyLogin();

	$user = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);

	$page = New PageAdmin();
	$page->setTpl("voucher-create", [
		'user'     => $user->getdes_person(),
		'MsgError' => Voucher::getError()
	]);
});

$app->post('/voucher/create', function(){
	User::verifyLogin();

	if (!isset($_POST['int_valor']) || $_POST['int_valor'] === '') {
		Voucher::setError("Digite o valor do vale.");
		header("Location: /voucher/create");
		Exit;		
	}
	
	//$user = New User();
	//$user->get((int)$_SESSION[User::SESSION]['id_user']);

	header("Location: /vouchers/user");
	Exit;
});

$app->get('/vouchers/user', function(){
	User::verifyLogin();

	$user = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);

	$page = New PageAdmin();
	$page->setTpl("vouchers-user", [
		'user'     => $user->getid_user() ]);
});


?>