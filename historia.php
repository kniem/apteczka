<?php
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";
	require_once "inc/baza.php";
	
	//wylogowanie
	if($_GET['wyloguj'] == 1){
		session_destroy();
	}
	
	$dbUzytkownik = $_SESSION['zalogowany'];
	$search_user="SELECT idkonta FROM uzytkownicy WHERE email='$dbUzytkownik'";
	$user=$baza->query($search_user);
	$row=$user->fetch_assoc();
	
	$userid=$row["idkonta"]; // id uzytkownika

?>
	<div id="tresc">
	<?php
		if(!isset($_SESSION['zalogowany'])){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else{ ?>
			<div class="container" style="padding-top: 50px;">
				<div class="row row-content">
					<div class="col-xs-12">
						<form action="" method="GET" style="margin-bottom: 25px;">
							<h3 style="margin-bottom: 20px;">Zobacz listę zażywanych przez Ciebie leków w danym okresie.</h3>
							<div class="col-xs-4">
								<label for="data_od">od</label>
								<input type="date" name="data_od" required>
							</div>
							<div class="col-xs-4">
								<label for="data_do">do</label>
								<input type="date" name="data_do" required>
							</div>
								<input type="submit" value="Filtruj" style="margin: 5px 0px 0px 15px;">
						</form>	
					</div>
				</div> 
			</div><br><br><br>
			<div class="container">
				<div class="row row-content">
					<div class="col-xs-12">
						<h2>Historia zażytych leków</h2>
					</div>	
				</div>
				<div class="row row-content">
					<div class="col-xs-12">
						<table>
							<tr>
								<th>Nazwa leku</th>
								<th>Ilość</th>
								<th>Data</th>
							</tr>												
 <?php
			
		
				
			if(isset($_GET['data_od']) && isset($_GET['data_do'])){
				//odebranie danych z formularza
				$data_od = $_GET['data_od'];
				$data_do = $_GET['data_do'];
				// zapytanie - wybranie lekow, ktore byly zazywane w wybranym okresie czasu
				$wyszukaj_zazyte = "SELECT * FROM zazyte WHERE data > '$data_od' && data < '$data_do' && idkonta='$userid'";
				//wykonanie zapytania
				$zazyte = $baza -> query($wyszukaj_zazyte);
				if($zazyte -> num_rows == 0){
					// jesli nie znaleziono zadnego rekordu tzn. ze zadne leki nie zostaly zazyte
					echo "W wybranym okresie nie zażyłeś żadnych leków.<h4>";
				}else{
					// jesli znaleziono
					while($row = $zazyte->fetch_assoc()) {
							
						echo "<tr> <td> ".  $row["lek"]." </td> <td> " . $row["liczba"] . " </td> <td> " .$row["data"] . "</td>  </tr>";
					}
					echo "</table>";
				}
				echo "Wybrany zakres <br>od ".$data_od ." do ".$data_do;
				
			}
			
			else {
				
				// Przygotowanie zapytania
				$query = "SELECT * FROM zazyte where idkonta='$userid'";
				
				//	Wykonanie zapytania i pobranie wyników
				$result = $baza->query($query);
				
				//wyświetlanie wyniku zapytania
				if ($result->num_rows > 0) {
				
					while($row = $result->fetch_assoc()) {
							
						echo "<tr> <td>" .  $row["lek"]. "</td> <td> " . $row["liczba"] . " </td> <td> " .$row["data"] . "</td>  </tr>";
					}
					echo "</table>";
				} else {
					echo "Nie zażywałeś jeszcze żadnych leków. Gratulujemy zdrowia!";
				}
			}
		}
		?>
			</div>
		</div>
	</div>
</div>


<?php

	require_once 'inc/stopka.php';
?>