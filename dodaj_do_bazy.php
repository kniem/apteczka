<?php
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/baza.php";
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";
	
//wylogowanie
	if($_GET['wyloguj'] == 1){
		session_destroy();
	}
	
// Odebranie zmiennych z formularza
	$dbNazwa = $_GET['nazwa'];
	$dbEan = $_GET['ean'];
	$dbIlosc = $_GET['ilosc'];
	$dbCena = $_GET['cena'];
	$dbTermin = $_GET['termin'];
	
// Uzupelnianie tabeli BazaLekow 
	$akcja = "INSERT INTO BazaLekow VALUES (NULL, '$dbNazwa', '$dbEan', '$dbIlosc', '$dbCena', '$dbTermin', 'false')";

// Wykonanie zapytania
	if($baza->query($akcja) == TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: " . $akcja . "<br>" . $baza->error;
	}
	$baza->close();
?>