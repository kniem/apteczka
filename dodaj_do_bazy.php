<?php
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/baza.php";
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";

//TO JEST DODAWANIE LEKU DO APTECZKI

//wylogowanie
	if($_GET['wyloguj'] == 1){
		session_destroy();
	}
	
// Odebranie zmiennych z formularza
	$dbNazwa = $_GET['nazwa'];
	$dbIlosc = $_GET['ilosc'];
	$dbCena = $_GET['cena'];
	$dbTermin = $_GET['termin'];
	
	$wyszukanie_specyfikacja="SELECT id FROM leki_specyfikacja WHERE nazwa='$dbNazwa'";
	$wyszukaj=$baza->query($wyszukanie_specyfikacja);
	$lek_spec=$wyszukaj->fetch_assoc();
	$idspec=$lek_spec['id'];
	
	//if($baza->query($wyszukanie_specyfikacja) == TRUE){
		
		
		
	if($lek_spec==NULL){
		//echo "Error: " . $akcja . "<br>" . $baza->error;
		echo "Nie ma takiego leku w bazie! Wprowadź jego specyfikację lub sprawdź, czy dobrze wprowadziłeś nazwę";
	}
	else {
	
	// Uzupelnianie tabeli BazaLekow 
		$akcja = "INSERT INTO BazaLekow VALUES (NULL,'$idspec','$dbIlosc', '$dbCena', '$dbTermin', 'false')";
	
	// Wykonanie zapytania
		if($baza->query($akcja) == TRUE){
			echo "Dodano lek do apteczki";
		}else{
			echo "Error: " . $akcja . "<br>" . $baza->error;
		}
	}
	$baza->close();
?>