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
	
//Odebranie zmiennych z formularza 
	$dbUzytkownik = $_SESSION['zalogowany'];

//Wyszukanie odpowiednich leków

	$dzisiaj=date("Y-m-d");
	
	$akcja3= "UPDATE BazaLekow SET usuniety = true WHERE (TerminWaznosci<='$dzisiaj' AND usuniety = false)";
	
	if($baza->query($akcja3) == TRUE){
		echo "Zanotowano usunięcie przeterminowanych leków apteczki";
	}else{
		echo "Error: " . $akcja3 . "<br>" . $baza->error;
	}
	
	$baza->close();
?>