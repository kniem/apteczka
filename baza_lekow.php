<?php
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";
	require_once "inc/baza.php";
	
	//wylogowanie
	
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
							<th>Ilość</th>
							<th>Cena</th>
							<th>Termin przydatnośći</th>
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
		$query = "select * from BazaLekow";
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