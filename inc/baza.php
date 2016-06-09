<?php 
// Polaczenie z baza danych

//$dbServer,  serwer, na którym dzia³a MySQL
//$dbLogin, nazwa u¿ytkownika
//$dbHaslo, haslo uzytkownika
//$dbBaza, wybrana baza danych

//Polaczenie z baza
	$baza= new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);

//Sprawdzenie czy polaczenie sie udalo
	if ($baza->connect_error > 0){
		die('Nie mo¿na po³¹czyæ siê z baz¹ ['. $baza->connect_error .']');
	}

//Ustawienie wlasciwego kodowania
	$baza->set_charset("utf8");
		
?>