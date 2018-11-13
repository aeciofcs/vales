<?php 

namespace Classes\Model;

use \Classes\DB\Sql;
use \Classes\Model;

class Voucher Extends Model {

	Const ERROR = "VoucherError";

	public static function listAll(){

		$sql = new Sql();
		return $sql->select("SELECT vou.id_voucher, pe.des_person, vou.int_valor, voust.des_status,  
									vou.dt_register As dt_register_voucher                                    
							 FROM tab_vouchers vou 
							 INNER JOIN tab_users us USING(id_user)
							 INNER JOIN tab_persons pe USING(id_person)
							 INNER JOIN tab_vouchersstatus voust USING(id_status)
							 WHERE MONTH(vou.dt_register) = MONTH(NOW())
							 ORDER BY vou.dt_register DESC;"); //pe.des_person
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

	public function save(){
		$sql     = New Sql();		
		$results = $sql->select("CALL sp_tab_vouchers_save(:id_user, :id_status, :int_valor)", [
			                                             	":id_user"   => $this->getid_user(),  //
			                                            	":id_status" => $this->getid_status(), //
			                                            	":int_valor" => $this->getint_valor()  ]); //
		$this->setData($results[0]);
	}

	
	public function listAllUser($user){
		$sql            = New Sql();
		return $results = $sql->select("SELECT vo.id_voucher, MONTH(vo.dt_register) As month_register, 
			                            vo.int_valor, st.des_status, vo.dt_register As dt_register_voucher 
			                            FROM tab_vouchers vo 
			                            INNER JOIN tab_vouchersstatus st USING(id_status) 
			                            WHERE vo.id_user = :id_user", [ 
			                     		       ':id_user' => $user    ]);		
	}

}

?>