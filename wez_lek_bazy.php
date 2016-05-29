<?php 
//Zakldam ze ten skrypt bedzie zaladowany po zaladowaniu zmiennych
//	require_once 'conf/zmienne.php';
	require_once "inc/baza.php";
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
	
//Odebranie zmiennych z formularza 
	$dbEan = $_POST[‘ean’];
	$dbIlosc = $_POST['ilosc'];
	$dbData = $_POST[‘data’];
	$dbUzytkownik=$_SESSION[‘uzytkownik’]	

//Uzupelnianie tabeli 
	$sql = "INSERT INTO zazyte_leki VALUES (NULL, '$dbEan’, ‘$dbUzytkownik’, '$dbIlosc', '$dbData’)";

	


//
	if($baza->query($sql) == TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: " . $sql . "<br>" . $baza->error;
	}
	$baza->close();
?>


// odejmowanie leku
	$ilosc0= “SELECT FROM BazaLekow ilosc WHERE ean=$dbEan”;
	$sql1= “UPDATE BazaLekow SET ilosc=($ilosc0 - $dbIlosc) WHERE ean=$dbEan”;

//
	if($baza->query($sql1) == TRUE){
		echo "New record updated successfully";
	}else{
		echo "Error: " . $sql . "<br>" . $baza->error;
	}
	$baza->close();
?>