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

?>