<?php 

namespace Classes\Model;

use \Classes\DB\Sql;
use \Classes\Model;

class Voucher Extends Model {

	Const ERROR = "VoucherError";

	public static function listAll(){

		$sql = new Sql();
		return $sql->select("SELECT vou.id_voucher, pe.des_person, vou.int_valor, voust.des_status,  
									vou.dt_register As dt_register_voucher, vou.id_user                                  
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
			                                            	":int_valor" => Voucher::formatValueToDecimal($this->getint_valor())  ]); //
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

	public function get($id_voucher, $id_user){
		$sql     = New Sql();
		$results = $sql->select("SELECT * FROM tab_vouchers us								 
					             WHERE us.id_voucher = :id_voucher AND 
					                   us.id_user    = :id_user", [
					  	         		":id_voucher" => $id_voucher,
					  	         		":id_user"    => $id_user ]);
		$this->setData($results[0]);
	}

	public function update(){
		$sql     = New Sql();		
		$results = $sql->select("CALL sp_tab_vouchersupdate_save(:id_voucher, :id_user, :int_valor)", [ 
													        		 ":id_voucher" => $this->getid_voucher(),
															         ":id_user"    => $this->getid_user(),
															         ":int_valor"  => Voucher::formatValueToDecimal($this->getint_valor()) ]);
		$this->setData($results[0]);
	}

	public static function formatValueToDecimal($value):float{		
		$value = str_replace(',','.',$value);		
		return $value;
	}

	public function delete(){
		$sql = new Sql();
		$sql->query("CALL sp_tab_vouchers_delete(:id_voucher, :id_user)", [
					                  	         ":id_voucher" => $this->getid_voucher(),
					                             ":id_user"    => $this->getid_user() ]);
	}

	public function payment(){
		$sql = new Sql();
		$sql->query("CALL sp_tab_vouchers_payment(:id_voucher, :id_user)", [
					                  	         ":id_voucher" => $this->getid_voucher(),
					                             ":id_user"    => $this->getid_user() ]);
	}

}

?>