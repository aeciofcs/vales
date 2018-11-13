<?php

use \Classes\Model\User; 

function getLogin($campo){
   $user = User::getFromSession();
   switch ($campo) {
      case 'login':
   	   return $user->getdes_login();
   	  	break;
   	case 'person':
   		return $user->getdes_person();
   		break;
		case 'inadmin':
			$inadmin = $user->getinadmin();
   		return (int)$inadmin;
   		break;
		case 'id_user':
			$id_user = $user->getinadmin();
   		return (int)$id_user;
   		break;   	  		
   }
	return $user;
}


function formatDate($date){
   return date('d/m/Y H:i:s', strtotime($date));
}

function formatPrice(float $vlprice){  
   return number_format($vlprice,2,",",".");
}

function formatMonth($month){
   switch ($month) {
      case '01': return 'Janeiro';   break;
      case '02': return 'Fevereiro'; break;
      case '03': return 'Março';     break;
      case '04': return 'Abril';     break;
      case '05': return 'Maio';      break;
      case '06': return 'Junho';     break;
      case '07': return 'Julho';     break;
      case '08': return 'Agosto';    break;
      case '09': return 'Setembro';  break;
      case '10': return 'Outubro';   break;
      case '11': return 'Novembro';  break;
      case '12': return 'Dezembro';  break;
   }

}

?>