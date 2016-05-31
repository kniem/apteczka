<?php 
	require_once 'conf/zmienne.php';
	require_once "inc/baza.php";
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";

	
//Odebranie zmiennych z formularza
	$dbNazwa = $_POST['nazwa'];
	$dbEan = $_POST['ean'];
	$dbIlosc = $_POST['ilosc'];
	$dbCena = $_POST['cena'];
	$dbTermin = $_POST['termin'];
	
//Uzupelnianie tabeli 
	$sql = "INSERT INTO BazaLekow VALUES (NULL, '$dbNazwa', '$dbEan', '$dbIlosc', '$dbCena', '$dbTermin', 'false')";
//
	if($baza->query($sql) == TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: " . $sql . "<br>" . $baza->error;
	}
	$baza->close();
?>