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
	$dbIlosc = $_GET['ilosc'];
	$dbNazwa = $_GET['name'];
	$dbData = $_GET['data'];
	$dbUzytkownik = $_SESSION['zalogowany'];

//Wyszukanie odpowiedniego leku

	$wyszukaj = "SELECT id FROM leki_specyfikacja WHERE nazwa='$dbNazwa'";
	$lek=$baza->query($wyszukaj);
	$lek_spec=$lek->fetch_assoc();
	$lek_id=$lek_spec["id"];
	
	$wyszukaj2="SELECT * FROM BazaLekow WHERE id_specyfikacja='$lek_id'";
	$lek2=$baza->query($wyszukaj2);
/*
	
	if ($lek2->num_rows == 0){
		echo "Nie posiadasz takiego leku w apteczce! Sprawdź, czy dobrze podałeś jego nazwę, lub wybierz się do apteki.";
	}
	else {
		
	
		// uzupelnienie tab zazyte leki
		$akcja1 = "INSERT INTO zazyte_leki VALUES (NULL, '$lek_id', '$dbUzytkownik', '$dbIlosc', '$dbData')";
		
		if($baza->query($akcja1) == TRUE){
			echo "Zanotowano zażycie leku";
		}else{
			echo "Error: " . $akcja1 . "<br>" . $baza->error;
		}
		*/
		// zmniejszenie leku w bazie o 1
		$akcja2= "SELECT ilosc FROM BazaLekow WHERE id_specyfikacja='$lek_id'";
		$result = $baza->query($akcja2);
		
			//pobieranie aktualnej ilosci leku
		//if ($result->num_rows > 0) {
		
		//	while() {
		$row = $result->fetch_assoc();
		$ilosc0 = $row["ilosc"];
		//	}
		//} else {
		//	echo "0 results";
		//}
		
		$newval=$ilosc0 - $dbIlosc;
		echo $newval;
		// Odejmowanie z bazy lekow odpowiedniej ilosci danego leku po jego zazyciu
		$akcja3= "UPDATE BazaLekow SET ilosc=$newval WHERE id_specyfikacja='$lek_id'";
		
		if($baza->query($akcja3) == TRUE){
			echo "Zanotowano wyjęcie leku z apteczki";
		}else{
			echo "Error: " . $akcja3 . "<br>" . $baza->error;
		}
	//}
	;
	

	
// Zapytanie: usuwanie leku ktorego ilosc = 0 DO POPRAWY NIE MOZNA USUWAC Z BAZY!!!!!!!!!!!!!!!!!!!	
	$akcja4 = "DELETE from BazaLekow WHERE ilosc=0";
	$baza->query($akcja4);
	/*if($baza->query($akcja4) == TRUE){
		echo "Record deleted successfully";
	}else{
		echo "Error: " . $akcja4 . "<br>" . $baza->error;
	}*/
	
	$baza->close();
?>