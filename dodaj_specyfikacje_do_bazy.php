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
	$dbsEan = $_GET['ean'];
	$dbsSubstancja = $_GET['substancja'];
	
// Uzupelnianie tabeli leki_specyfikacja
	$akcja = "INSERT INTO leki_specyfikacja VALUES (NULL, '$dbsNazwa', '$dbsEan', '$dbsSubstancja')";

// Wykonianie zapytania
	if($baza->query($akcja) == TRUE){
		echo "Dodano specyfikację nowego leku";?>
		<div id="tresc">
			<center style="margin: 50px 0px;"><b><a href="index.php"><?php echo $powrot; ?></a></b></center>
		</div> <?php
	}else{
		echo "Error: " . $akcja . "<br>" . $baza->error;
	}
	$baza->close();
?>