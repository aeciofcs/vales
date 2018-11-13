<?php 

use \Classes\PageAdmin;
use \Classes\Model\User;
use \Classes\Model\Voucher;

$app->get('/vouchers', function(){
	User::verifyLogin();
	User::verifyAdmin();

	$vouchers = Voucher::listAll();
	$mes      = formatMonth(date('m'));	

	$page = New PageAdmin();
	$page->setTpl("vouchers", [
		'vouchers' => $vouchers,
		'month'    => $mes
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

	$user   = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);
	$limite = ( $user->getnum_salario() * 0.4 );

	if ((int)$_POST['int_valor'] > (int)$limite) {
		Voucher::setError("O valor do vale é maior do que os 30% do seu salário.");
		header("Location: /voucher/create");
		Exit;
	}

	$voucher = New Voucher();

	$voucher->setid_user($user->getid_user());
	$voucher->setid_status(1);
	$voucher->setint_valor($_POST['int_valor']);
	
	$voucher->save();

	header("Location: /vouchers/user");
	Exit;
});

$app->get('/vouchers/user', function(){
	User::verifyLogin();

	$user = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);

	$vouchers = New Voucher();
	$data     = $vouchers->listAllUser($user->getid_user());	

	$page = New PageAdmin();
	$page->setTpl("vouchers-user", [
		'voucher_user' => $data ]);
});


?>