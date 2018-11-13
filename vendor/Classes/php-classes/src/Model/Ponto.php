<?php

namespace Classes\Model;

use \Classes\DB\Sql;
use \Classes\Model;

class Ponto Extends Model{

	//Const SESSION = "Ponto";

	public static function loginPonto(){
		//$nrcep = str_replace("-", "", $nrcep);
		//http://viacep.com.br/ws/$nrcep/json/
		//curl_setopt($ch, CURLOPT_URL, "http://viacep.com.br/ws/$nrcep/json/");
		$data = ["login" => "admin", 
				 "password" => "admin"];
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://192.168.0.199/login.fcgi");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //informa que tem retorno;
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //não valida o SLL;
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($ch, CURLOPT_POST, true); //informa que é um POST;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json); //informa os dados do POST;

		$data = json_decode(curl_exec($ch), true); //"true" vira um array;

		curl_close($ch);

		return $data;
	}

	public static function loadFromPonto(){
		$session = Ponto::loginPonto();
		return $session;
	}

	public function loadFromUsers(){		
		$link       = "https://192.168.0.199";		
		$link_users = "/load_users.fcgi?session=".Ponto::loadFromPonto()['session'];
		$url        = $link.$link_users;

		$users = ["limit"  => 100, 
				  "offset" => 0];		
		   
		$users_pis = ["users_pis"=>[16056726720, 12532910919]];
		
		$data_json = json_encode($users_pis);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //informa que tem retorno;
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //não valida o SLL;
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($ch, CURLOPT_POST, true); //informa que é um POST;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json); //informa os dados do POST;

		$data = json_decode(curl_exec($ch), true); //"true" vira um array;

		curl_close($ch);

		//return $data['users'];
		return $data;
	}


}



?>