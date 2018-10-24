<?php

namespace Classes\Model;

use \Classes\DB\Sql;
use \Classes\Model;

class User Extends Model {

	Const SESSION = "User";

	public static function login($login, $password){

		$sql     = new Sql();
		$results = $sql->select("SELECT * FROM tab_users 
			                     WHERE des_login = :des_login", [
			                     	":des_login" => $login ]);		
		if ( !count($results) > 0 ) {
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

		$data = $results[0]; //Dados do usuário.

		if ( password_verify($password, $data['des_password']) ) {
			$user = New User();
			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;
			
		}else{
			//Senha informada não bate com a senha gravada no banco de dados.
			throw new \Exception("Usuário inexistente ou senha inválida. SENHA");
		}
	}

	public static function verifyLogin($inadmin = true){
		if ( !isset($_SESSION[User::SESSION]) || 
			 !$_SESSION[User::SESSION] || 
			 !(int)$_SESSION[User::SESSION]['id_user'] > 0 ||
			 (bool)$_SESSION[User::SESSION]['inadmin'] !== $inadmin
		   ) {		   	
		   	header("Location: /login");
		    Exit;
		}
	}

	public static function logout(){
		$_SESSION[User::SESSION] = NULL;
	}

	public static function listAll(){
		$sql = New Sql();
		return $sql->select("SELECT * FROM tab_users user
				             INNER JOIN tab_persons per USING(id_person)
					         ORDER BY per.des_person");

	}

}

?>