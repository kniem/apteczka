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
	//Sprawdzenie czy zalogowano - 
	if(isset($_POST['email']) && isset($_POST['haslo'])){
 		if(sprawdz_login_haslo($_POST['email'],$_POST['haslo']))
			$_SESSION['zalogowany'] = $_POST['email'];
		else $byl_blad_logowania=2;}
	else{ 
		session_destroy();
	}
	
?>
	<div id="tresc">
	<?php
		if(!isset($_GET['wybrano'])){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else
			$opcja = ($_GET['wybrano']);
		
//		echo "Wybrano opcj� nr: " . $opcja . " " . $wybrane[$opcja];
	?>
	<?php
		if(!isset($_SESSION['zalogowany'])){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else{ ?>
		<div class="container">
			<div class="row row-content">
				<div class="col-xs-12">
					<h2>Twoja baza leków</h2>
				</div>	
			</div>
			<div class="row row-content">
				<div class="col-xs-12">
					<table>
						<tr>
							<th>Nazwa leku</th>
							<th>Kod EAN</th>
							<th>Ilość</th>
							<th>Cena</th>
							<th>Termin przydatności</th>
						</tr>
						<tr>
							<td>xxx</td>
							<td>xxx</td>
							<td>xxx</td>
							<td>xxx</td>
						</tr>	
					</table>
				</div>
			</div>
		</div>
	<?php 
//przygotowanie zapytania
		$dzisiaj=date("Y-m-d");
		$query = "select * from BazaLekow where usuniety = false";
//wykonanie zapytania i pobranie wyników
		$result = $baza->query($query);
		
		echo "<hr>";
//wyświetlanie wyniku zapytania
		if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
				echo "id: " . $row["idLeku"]. " nazwa: " . $row["Nazwa"]. " ilosc = " . $row["Ilosc"] . " termin: " .  $row["TerminWaznosci"] . "<br>";
			}
		} else {
			echo "0 results";
		}
	}?>
	
	</div>

<?php
	require_once 'inc/stopka.php';
?>