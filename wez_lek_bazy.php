<?php 
//Zakldam ze ten skrypt bedzie zaladowany po zaladowaniu zmiennych
//	require_once 'conf/zmienne.php';
	require_once "inc/baza.php";
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";

//$dbServer,  serwer, na którym dzia³a MySQL
//$dbLogin, nazwa u¿ytkownika
//$dbHaslo, haslo uzytkownika
//$dbBaza, wybrana baza danych

//Polaczenie z baza
	$baza= new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);

//czy sie udalo
	if ($baza->connect_error > 0){
		die('Nie mo¿na po³¹czyæ siê z baz¹ ['. $baza->connect_error .']');
	}

//Ustawienie wlasciwego kodowania
	$baza->set_charset("utf8");
	
//Odebranie zmiennych z formularza 
	$dbEan = $_POST['ean'];
	echo $dbEan;
	$dbIlosc = $_POST['ilosc'];
	$dbData = $_POST['data'];
//	$dbUzytkownik=$_SESSION['uzytkownik'];
	$dbUzytkownik= "Kamelia";

//Uzupelnianie tabeli 
	$sql = "INSERT INTO zazyte_leki VALUES (NULL, '$dbEan', '$dbUzytkownik', '$dbIlosc', '$dbData')";

	


//
	if($baza->query($sql) == TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: " . $sql . "<br>" . $baza->error;
	}



// odejmowanie leku
	$sql0= "SELECT ilosc FROM BazaLekow WHERE ean='$dbEan'";
//		if($baza->query($sql0) == TRUE){
//		echo "New record selected successfully";
//	}else{
//		echo "Error: " . $sql0 . "<br>" . $baza->error;
//	}
	$result = $baza->query($sql0);
	//wyœwietlanie wyniku zapytania
	if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {
				$ilosc0 = $row["ilosc"];
				echo $ilosc0;
			}
		} else {
			echo "0 results";
		}

	$sql1= "UPDATE BazaLekow SET ilosc=($ilosc0 - $dbIlosc) WHERE ean='$dbEan'";

	if($baza->query($sql1) == TRUE){
		echo "New record updated successfully";
	}else{
		echo "Error: " . $sql1 . "<br>" . $baza->error;
	}
	$baza->close();
?>