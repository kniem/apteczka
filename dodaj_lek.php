<?php
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";
	
	//wylogowanie
	if($_GET['wyloguj'] == 1){
		session_destroy();
	}
	//Sprawdzenie czy zalogowano - 
	if(isset($_POST['email']) && isset($_POST['haslo'])){
 		if(sprawdz_login_haslo($_POST['email'],$_POST['haslo']))
			$_SESSION['zalogowany'] = $_POST['email'];
		else $byl_blad_logowania=2;}
	else{ 
		//session_destroy();
		print_r($_POST); 
	}
	print_r($_SESSION);
?><a href="skrypt_2.php"><?php echo $menuAp;?></a>
