<?php

namespace Classes\Model;

use \Classes\DB\Sql;
use \Classes\Model;

class User Extends Model {

	Const SESSION = "User";
	Const ERROR   = "UserError";

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

	public function save(){
		$sql     = New Sql();		
		$results = $sql->select("CALL sp_tab_users_save(:des_person, :des_email, :nr_phone, :des_pis, 
			                                            :des_cpf, :des_rg, :num_salario, :des_login,
			                                        	:des_password, :inadmin)", [
			                                            	":des_person"   => $this->getdes_person(),
			                                            	":des_email"    => $this->getdes_email(),
			                                            	":nr_phone"     => $this->getnr_phone(),
			                                            	":des_pis"      => $this->getdes_pis(),
			                                            	":des_cpf"      => $this->getdes_cpf(),
			                                            	":des_rg"       => $this->getdes_rg(),
			                                            	":num_salario"  => $this->getnum_salario(),
			                                            	":des_login"    => $this->getdes_login(),
			                                            	":des_password" => User::getPasswordHash($this->getdes_password()),
			                                            	":inadmin"      => $this->getinadmin()
			                                            ]);		
		$this->setData($results[0]);
	}

	public static function setError($msg){
		$_SESSION[User::ERROR] = $msg;
	}

	public static function getError(){
		$msg = ( isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR] ) ? $_SESSION[User::ERROR] : "";
		User::clearError();
		return $msg;
	}

	public function clearError(){
		$_SESSION[User::ERROR] = NULL;
	}

	public function get($id_user){
		$sql     = New Sql();
		$results = $sql->select("SELECT * FROM tab_users us
								 INNER JOIN tab_persons pe USING(id_person)
					             WHERE us.id_user = :id_user", [
					  	         		":id_user" => $id_user ]);
		$this->setData($results[0]);
	}

	

	public function update(){
		$sql     = New Sql();		
		$results = $sql->select("CALL sp_tab_usersupdate_save(:id_user, :des_person, :des_email, 
								  :nr_phone, :des_pis, :des_cpf, :des_rg, 
								  :num_salario, :des_login, :des_password, :inadmin)", [
								  	":id_user"      => $this->getid_user(),
			                        ":des_person"   => $this->getdes_person(),
			                        ":des_email"    => $this->getdes_email(),
			                        ":nr_phone"     => $this->getnr_phone(),
			                        ":des_pis"      => $this->getdes_pis(),
			                        ":des_cpf"      => $this->getdes_cpf(),
			                        ":des_rg"       => $this->getdes_rg(),
			                        ":num_salario"  => $this->getnum_salario(),
			                        ":des_login"    => $this->getdes_login(),
			                        ":des_password" => User::getPasswordHash($this->getdes_password()),
			                        ":inadmin"      => $this->getinadmin() ]);
		$this->setData($results[0]);
	}

	Public function delete(){
		$sql     = New Sql();		
		$results = $sql->query("CALL sp_tab_users_delete(:id_user)", [
									":id_user" => $this->getid_user() ]);

	}

	public static function getForgot($des_cpf){
		$sql     = New Sql();
		$results = $sql->select("SELECT * FROM tab_users us 
								 INNER JOIN tab_persons pe USING(id_person)
					             WHERE pe.des_cpf = :des_cpf", [ 
					             	":des_cpf" => $des_cpf ]);
		if ( count($results) === 0 ) {
			throw new \Exception("Não foi possível recuperar a senha.", 1);			
		}else{			
			return $results[0];
		}
	}

	public function getCPF($des_cpf){
		$sql     = New Sql();
		$results = $sql->select("SELECT * FROM tab_users us
								 INNER JOIN tab_persons pe USING(id_person)
					             WHERE pe.des_cpf = :des_cpf", [
					  	         		":des_cpf" => $des_cpf ]);
		$this->setData($results[0]);
	}

	Public function setPassword($password){
		$sql = New Sql();
		$sql->query("UPDATE tab_users SET des_password = :des_password 
					 WHERE id_user = :id_user", [ ":id_user"      => $this->getid_user(),
					 					          ":des_password" => User::getPasswordHash($password) ]);
	}

	public static function getPasswordHash($password){
		return password_hash($password, PASSWORD_DEFAULT, [ 'cost' => 12 ] );
	}


}

?>