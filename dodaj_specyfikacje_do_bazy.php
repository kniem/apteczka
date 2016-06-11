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
	$dbsNazwa = $_GET['nazwa'];
	$dbsIlosc = $_GET['ilosc'];
	$dbsEan = $_GET['ean'];
	$dbsSubstancja = $_GET['substancja'];
	
// Uzupelnianie tabeli leki_specyfikacja
	$akcja = "INSERT INTO leki_specyfikacja VALUES (NULL, '$dbsNazwa', '$dbsEan', '$dbsIlosc', '$dbsSubstancja')";

// Wykonianie zapytania
	if($baza->query($akcja) == TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: " . $akcja . "<br>" . $baza->error;
	}
	$baza->close();
?>