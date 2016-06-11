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
	$dbEan = $_GET['ean'];
	$dbIlosc = $_GET['ilosc'];
	$dbData = $_GET['data'];
	$dbUzytkownik = $_SESSION['zalogowany'];

// Zapytanie: uzupelnianie tabeli zazyte_leki 
	$akcja1 = "INSERT INTO zazyte_leki VALUES (NULL, '$dbEan', '$dbUzytkownik', '$dbIlosc', '$dbData')";

//
	if($baza->query($akcja1) == TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: " . $akcja1 . "<br>" . $baza->error;
	}
	
// Zapytanie: wybranie z bazy lekow zazytego przez uzytkownika leku
	$akcja2= "SELECT ilosc FROM BazaLekow WHERE ean='$dbEan'";

	$result = $baza->query($akcja2);
	
// Wyœwietlanie wyniku zapytania
	if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {
				$ilosc0 = $row["ilosc"];
			}
		} else {
			echo "0 results";
		}
// Zapytanie: odejmowanie z bazy lekow odpowiedniej ilosci danego leku po jego zazyciu
	$akcja3= "UPDATE BazaLekow SET ilosc=($ilosc0 - $dbIlosc) WHERE ean='$dbEan'";

	if($baza->query($akcja3) == TRUE){
		echo "New record updated successfully";
	}else{
		echo "Error: " . $akcja3 . "<br>" . $baza->error;
	}
	
// Zapytanie: usuwanie leku ktorego ilosc = 0	
	$akcja4 = "DELETE from BazaLekow WHERE ilosc=0";
	
	if($baza->query($akcja4) == TRUE){
		echo "Record deleted successfully";
	}else{
		echo "Error: " . $akcja4 . "<br>" . $baza->error;
	}
	
	$baza->close();
?>