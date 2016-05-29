<?php 
//Zakldam ze ten skrypt bedzie zaladowany po zaladowaniu zmiennych
	require_once '/home/eaiibgrp/arak/public_html/domowa_apteczka_edits/conf/zmienne.php';
//$dbServer,  serwer, na którym dzia³a MySQL
//$dbLogin, nazwa u¿ytkownika
//$dbHaslo, haslo uzytkownika
//$dbBaza, wybrana baza danych

//Polaczenie z baza
	$baza= new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);

//czy sie udalo
	if ($baza->connect_error > 0){
		die('Nie mo¿na po³¹czyæ siê z baz¹ ['. $baza->connect_error .']');
	}

//Ustawienie wlasciwego kodowania
	$baza->set_charset("utf8");
	
//Odebranie zmiennych z formularza
	$dbNazwa = $_POST['nazwa'];
	$dbIlosc = $_POST['ilosc'];
	$dbCena = $_POST['cena'];
	$dbTermin = $_POST['termin'];
	
//Uzupelnianie tabeli // BLAD!!!!!!!!!!!!!!!!!!!!!!!!!!
	$sql = "INSERT INTO BazaLekow VALUES (NULL, '$dbNazwa', '$dbIlosc', '$dbCena', '$dbTermin')";
//
//	if($baza->query(sql) === TRUE){
//		echo "New record created successfully";
//	}else{
//		echo "Error: " . $sql . "<br>" . $baza->error;
//	}
//	$baza->close();
?>