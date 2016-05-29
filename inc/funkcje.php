<?php 
//Sprawdzenie czy zalogowano

function sprawdz_login_haslo($login,$pwd){
	if($pwd == '12345')
		return true;
	else
		return false;
}
?>