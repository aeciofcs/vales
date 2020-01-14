<?php 

use \Classes\PageAdmin;
use \Classes\Model\User;
use \Classes\Model\Voucher;

$app->get('/vouchers/:id_voucher/:id_user/delete', function($id_voucher, $id_user){
	//Rotina para o usuário administrador deletar o vale de qualquer funcionário.
	User::verifyLogin();
	User::verifyAdmin();	

	$vouchers = New Voucher();
	$vouchers->get((int)$id_voucher, (int)$id_user);	
	
	$vouchers->delete();

	//Redireciona para a lista de vales do usuário.
	header("Location: /vouchers");
	exit;

});

$app->get('/vouchers/pay/:id_voucher/:id_user', function($id_voucher, $id_user){
	//Rotina para o usuário administrador pagar o vale ao funcionário.
	User::verifyLogin();
	User::verifyAdmin();	

	$vouchers = New Voucher();
	$vouchers->get((int)$id_voucher, (int)$id_user);
	
	$vouchers->payment();

	//Redireciona para a lista de vales do usuário.
	header("Location: /vouchers");
	exit;

});

$app->get('/vouchers', function(){
	//Lista todos os vales de todos os funcionarios para o usuário administrador.
	User::verifyLogin();
	User::verifyAdmin();

	$vouchers = Voucher::listAll();
	//echo json_encode((array)$vouchers);
	//exit;
	$mes      = formatMonth(date('m'));	

	$page = New PageAdmin();
	$page->setTpl("vouchers", [
		'vouchers' => $vouchers,
		'month'    => $mes
	]);
});


//Rotina para vales dos usuários.
$app->get('/vouchers/user', function(){
	//Listagem de vales para cada usuário.
	User::verifyLogin();

	$user = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);

	$vouchers = New Voucher();
	$data     = $vouchers->listAllUser($user->getid_user());	

	$page = New PageAdmin();
	$page->setTpl("vouchers-user", [
		'voucher_user' => $data ]);
});

$app->get('/vouchers/user/:id_voucher/delete', function($id_voucher) {
	//Deletar vale do usuario.	
	User::verifyLogin();
	
	$user = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);

	$voucher = new Voucher();	
	$voucher->get((int)$id_voucher, $user->getid_user());
	
	$voucher->delete();
	
	//Redireciona para a lista de vales do usuário.
	header("Location: /vouchers/user");
	exit;
});

$app->get('/vouchers/user/create', function(){
	//Abre a tela para lançamento do vale.
	User::verifyLogin();

	$user = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);

	$page = New PageAdmin();
	$page->setTpl("voucher-create", [
		'user'     => $user->getdes_person(),
		'MsgError' => Voucher::getError()
	]);
});

$app->post('/vouchers/user/create', function(){
	// Gravação do lançamento do vale.
	User::verifyLogin();

	if (!isset($_POST['int_valor']) || $_POST['int_valor'] === '') {
		Voucher::setError("Digite o valor do vale.");
		header("Location: /vouchers/user/create");
		Exit;
	}

	$user   = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);
	$limite = ( $user->getnum_salario() * 0.4 );

	if ((int)$_POST['int_valor'] > (int)$limite) {
		Voucher::setError("O valor do vale é maior do que os 30% do seu salário.");
		header("Location: /vouchers/user/create");
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

$app->get('/vouchers/user/:id_voucher', function($id_voucher){
	//Abre a tela para alteração do vale pelo usuário.
	User::verifyLogin();

	$user = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);

	$voucher = New Voucher();
	$voucher->get((int)$id_voucher, $user->getid_user());

	$page = New PageAdmin();
	$page->setTpl("voucher-user-update", [
		'user'     => $user->getdes_person(),
		'voucher'  => $voucher->getValues(),
		'MsgError' => Voucher::getError()
	]);
});

$app->post('/vouchers/user/:id_voucher', function($id_voucher){
	//Gravação da alteração do vale feita pelo usuario.
	User::verifyLogin();

	if (!isset($_POST['int_valor']) || $_POST['int_valor'] === '') {
		Voucher::setError("Digite o valor do vale.");
		header("Location: /vouchers/user/$id_voucher");
		Exit;
	}

	$user   = New User();
	$user->get((int)$_SESSION[User::SESSION]['id_user']);
	$limite = ( $user->getnum_salario() * 0.4 );

	if ((int)$_POST['int_valor'] > (int)$limite) {
		Voucher::setError("O valor do vale é maior do que os 30% do seu salário.");
		header("Location: /vouchers/user/$id_voucher");
		Exit;
	}

	$voucher = New Voucher();

	$voucher->get((int)$id_voucher, (int)$user->getid_user());

	$voucher->setint_valor($_POST['int_valor']);	
	
	$voucher->update();

	header("Location: /vouchers/user");
	Exit;
});



?>