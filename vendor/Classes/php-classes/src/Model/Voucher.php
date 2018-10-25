<?php 

namespace Classes\Model;

use \Classes\DB\Sql;
use \Classes\Model;

class Voucher Extends Model {

	Const ERROR = "VoucherError";

	public static function listAll(){

		$sql = new Sql();
		return $sql->select("SELECT vou.id_voucher, voust.des_status, vou.int_valor, vou.dt_register, 
                                    us.id_user, us.des_login, us.des_password, us.inadmin, us.dt_register,
	   								pe.des_person, pe.des_email, pe.nr_phone, pe.des_pis, pe.des_cpf, pe.des_rg, pe.num_salario
							 FROM tab_vouchers vou 
							 INNER JOIN tab_users us USING(id_user)
							 INNER JOIN tab_persons pe USING(id_person)
							 INNER JOIN tab_vouchersstatus voust USING(id_status)
							 WHERE MONTH(vou.dt_register) = MONTH(NOW());
							 ORDER BY pe.des_person;");
	}

	public static function setError($msg){
		$_SESSION[Voucher::ERROR] = $msg;
	}

	public static function getError(){
		$msg = ( isset($_SESSION[Voucher::ERROR]) && $_SESSION[Voucher::ERROR] ) ? $_SESSION[Voucher::ERROR] : "";
		Voucher::clearError();
		return $msg;
	}

	public function clearError(){
		$_SESSION[Voucher::ERROR] = NULL;
	}

}

?>