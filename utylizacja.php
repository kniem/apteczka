<?php 
//Zakldam ze ten skrypt bedzie zaladowany po zaladowaniu zmiennych
	require_once 'conf/zmienne.php';
//	require_once "inc/baza.php";
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";

//$dbServer,  serwer, na którym działa MySQL
//$dbLogin, nazwa użytkownika
//$dbHaslo, haslo uzytkownika
//$dbBaza, wybrana baza danych

//Polaczenie z baza
	$baza= new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);

//czy sie udalo
	if ($baza->connect_error > 0){
		die('Nie można połączyć się z bazą ['. $baza->connect_error .']');
	}

//Ustawienie wlasciwego kodowania
	$baza->set_charset("utf8");

$dzisiaj=date(“Y-m-d”);
$akcja0=“SELECT * FROM BazaLekow WHERE TerminWaznosci<=$dzisiaj”;

// wykonanie i przypisanie do zmiennej $przeterminowane
TUTAJ WSTAWIAJ, OLA

//tutaj petal while dla kolejnych rzedow z przeterminowane + przypisanie nazw miennyh tym zmiennym ktore sa nizej jako values

$akcja1=“INSERT INTO przeterminowane VALUES (NULL, $nazwa, $ean, $ilosc, $data_waznosci);

$akcja2=“DELETE FROM BazaLekow WHERE TerminWaznosci<=$dzisiaj”;