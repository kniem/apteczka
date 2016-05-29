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
	
//Odebranie zmiennych z formularza OGARNIJ TO!!!!!!!!!!!!!!!!!!!
	$dbsNazwa = $_POST['nazwa'];
	$dbsIlosc = $_POST['ilosc'];
	$dbsEan = $_POST['ean'];
	$dbsSubstancja = $_POST['substancja'];
	
//Uzupelnianie tabeli // BLAD!!!!!!!!!!!!!!!!!!!!!!!!!!
	$sql = "INSERT INTO leki_specyfikacja VALUES (NULL, '$dbsNazwa', '$dbsEan' '$dbsIlosc', '$dbsSubstancja')";
//
	if($baza->query($sql) == TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: " . $sql . "<br>" . $baza->error;
	}
	$baza->close();
?>