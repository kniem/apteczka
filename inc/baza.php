<?php 

//	require_once '/home/eaiibgrp/arak/public_html/domowa_apteczka_edits/conf/zmienne.php';
//$dbServer,  serwer, na kt�rym dzia�a MySQL
//$dbLogin, nazwa u�ytkownika
//$dbHaslo, haslo uzytkownika
//$dbBaza, wybrana baza danych

//Polaczenie z baza
	$baza= new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);

//czy sie udalo
	if ($baza->connect_error > 0){
		die('Nie mo�na po��czy� si� z baz� ['. $baza->connect_error .']');
	}

//Ustawienie wlasciwego kodowania
	$baza->set_charset("utf8");
		
?>