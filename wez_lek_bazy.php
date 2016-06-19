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

	if ($dbIlosc<=0){
		echo "Podałeś nieodpowiednią liczbę. Wypełnij ponownie formularz.";
	}
	else {
	
//Wyszukanie odpowiedniego leku

	$wyszukaj = "SELECT id FROM leki_specyfikacja WHERE nazwa='$dbNazwa'";
	$lek=$baza->query($wyszukaj);
	$lek_spec=$lek->fetch_assoc();
	$lek_id=$lek_spec["id"];
	
	$wyszukaj2="SELECT * FROM BazaLekow WHERE id_specyfikacja='$lek_id'";
	$lek2=$baza->query($wyszukaj2);
	
	
	
	if ($lek2->num_rows == 0){
		echo "Nie posiadasz takiego leku w apteczce! Sprawdź, czy dobrze podałeś jego nazwę, lub wybierz się do apteki.";
	}
	else {
		//wybranie ilosci leku z tabeli 
		$akcja2= "SELECT ilosc FROM BazaLekow WHERE id_specyfikacja='$lek_id'";
		$result = $baza->query($akcja2);
		
		$row = $result->fetch_assoc();
		$ilosc0 = $row["ilosc"];
		
		
		$newval=$ilosc0 - $dbIlosc;
		if ($newval<0){
			echo "Ups! W twojej apteczce zabrakło leku ". $dbNazwa."<br>
					Obecnie jest dostępnych: ". $ilosc0." sztuk. Wybierz się do lekarza lub apteki!";
		}
		
		
		else {
		
			// Odejmowanie z bazy lekow odpowiedniej ilosci danego leku po jego zazyciu
			$akcja3= "UPDATE BazaLekow SET ilosc=$newval WHERE id_specyfikacja='$lek_id'";
		
			if($baza->query($akcja3) == TRUE){
				echo "Zanotowano wyjęcie leku z apteczki.<br>Pozostało: ". $newval." sztuk.<br>";
			}else{
				echo "Error: " . $akcja3 . "<br>" . $baza->error;
			}
		
			// znalezienie idkonta uzytkownika
			$search_user="SELECT idkonta FROM uzytkownicy WHERE email='$dbUzytkownik'";
			$user=$baza->query($search_user);
			$row=$user->fetch_assoc();
		
			$userid=$row["idkonta"]; // id uzytkownika
			// wstawienie adnotacji o zazyciu leku do tabeli zazyte
			
			$new_record="INSERT INTO zazyte VALUES (NULL, '$userid', '$dbNazwa', '$dbIlosc', '$dbData')";
		
		
			if($baza->query($new_record) == TRUE){
				echo "Dodano lek ".$dbNazwa." do listy zażytych leków.<br>";
	
			}else{
				echo "Error: " . $akcja1 . "<br>" . $baza->error;
				echo "Ups! Coś poszło nie tak i nie mogliśmy zanotować Twojego wpisu!<br>";
			}
		}
	}
	}
	

	
// Zapytanie: usuwanie leku ktorego ilosc = 0 
	$akcja4 = "DELETE from BazaLekow WHERE ilosc<=0";
	$baza->query($akcja4);
	if($baza->query($akcja4) == FALSE){
		echo "Error: " . $akcja4 . "<br>" . $baza->error;;
	}
	$baza->close();
?>