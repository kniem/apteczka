<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/baza.php";
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";
	
//wylogowanie
	if($_GET['wyloguj'] == 1){
		session_destroy();
	} ?>
	
	<div id="tresc">
	<?php
//		if(!isset($_GET['wybrano'])){
//			header("Location: index.php?wybrano=0&zaloguj_sie=1");
//		}else
//			$opcja = ($_GET['wybrano']);
//		
//		echo "Wybrano opcję nr: " . $opcja . " " . $wybrane[$opcja];
	?>
	<?php
		if(!isset($_SESSION['zalogowany'])){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else{ ?>
		<div class="container">
			<div class="row row-content">
				<div class="col-xs-12">

											
<?php 	

// Wybranie z bazy lekow przeterminowanych
	$dzisiaj=date("Y-m-d");
	$akcja1= "SELECT * FROM BazaLekow WHERE TerminWaznosci<='$dzisiaj' AND usuniety = false";
	
// wykonanie i przypisanie do zmiennej $przeterminowane
	$result = $baza->query($akcja1);

			if ($result->num_rows > 0) { ?>
					<h2>Leki przeterminowane</h2>
					<table>
						<tr>
							<th>Nazwa leku</th>
							<th>Kod EAN</th>
							<th>Ilość</th>
							<th>Cena</th>
							<th>Termin przydatności</th>
						</tr>				
					
<?php			while($row = $result->fetch_assoc()) {
				echo "<tr> <td>" .  $row["Nazwa"]. "</td> <td>" . $row["ean"] . " </td> <td> " . $row["Ilosc"] . " </td> <td> " .$row["Cena"] . "</td> <td>" .  $row["TerminWaznosci"] . "</td> </tr>";
			} ?>
					</table>
					<button>
						<a href="utylizacja_bazy.php">Utylizuj leki</a>
					</button>

<?php		} else {
			echo "<h2>Nie masz żadnych leków do utylizacji</h2>";
		} ?>
				</div>
			</div>
		</div>
	</div>
<?php }
	require_once 'inc/stopka.php';
	
// wykonanie utylizacji lekow przeterminowanych	
	$akcja2 = "UPDATE BazaLekow SET usuniety = true WHERE idLeku = $idLeku";
	$baza->close();
?>