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

	$dzisiaj=date("Y-m-d");
	$akcja0= "SELECT * FROM BazaLekow WHERE TerminWaznosci<='$dzisiaj' AND usuniety = false";
	
	$utylizuj = "UPDATE BazaLekow SET usuniety = true WHERE idLeku = $idLeku";

// wykonanie i przypisanie do zmiennej $przeterminowane
	$result = $baza->query($akcja0);

			if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
				echo "id: " . $row["idLeku"]. " nazwa: " . $row["Nazwa"]. " ilosc = " . $row["ean"] . " termin: " .  $row["TerminWaznosci"] . "<br>";
			}
		} else {
			echo "0 results";
		}
	

$baza->close();
?>