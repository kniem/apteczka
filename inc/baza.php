<?php 
// Polaczenie z baza danych

//$dbServer,  serwer, na kt�rym dzia�a MySQL
//$dbLogin, nazwa u�ytkownika
//$dbHaslo, haslo uzytkownika
//$dbBaza, wybrana baza danych

//Polaczenie z baza
	$baza= new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);

//Sprawdzenie czy polaczenie sie udalo
	if ($baza->connect_error > 0){
		die('Nie mo�na po��czy� si� z baz� ['. $baza->connect_error .']');
	}

//Ustawienie wlasciwego kodowania
	$baza->set_charset("utf8");
		
?>