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

?>
	<div id="tresc">
	<?php
		if(!isset($_SESSION['zalogowany'])){
			header("Location: index.php?wybrano=0");
		}else{ ?>
			<div class="container" style="padding-top: 50px;">
				<div class="row row-content">
					<div class="col-xs-12">
						<form action="" method="GET" style="margin-bottom: 25px;">
							<h3 style="margin-bottom: 20px;"><?php echo $raportNaglowek; ?></h3>
							<div class="col-xs-4">
								<label for="data_od"><?php echo $raportOd; ?></label>
								<input type="date" name="data_od" required>
							</div>
							<div class="col-xs-4">
								<label for="data_do"><?php echo $raportDo; ?></label>
								<input type="date" name="data_do" required>
							</div>
								<input type="submit" value="Wygeneruj raport" style="margin: 5px 0px 0px 15px;">
						</form>	
					</div>
				</div>	
			
		<?php } ?>
			<div class="row">
				<div class="col-xs-12"> <?php
			if(isset($_GET['data_od']) && isset($_GET['data_do'])){
				//odebranie danych z formularza
				$data_od = $_GET['data_od'];
				$data_do = $_GET['data_do'];
				// zapytanie - wybranie lekow, ktore przeterminowaly sie w podanym okresie czasu
				$wyszukaj_przeterminowane = "SELECT * from BazaLekow WHERE TerminWaznosci > '$data_od' && TerminWaznosci < '$data_do'";
				//wykonanie zapytania
				$przeterminowane = $baza -> query($wyszukaj_przeterminowane);
				if($przeterminowane -> num_rows == 0){
					// jesli nie znaleziono zadnego rekordu tzn. ze zadne leki sie nie przeterminowaly
					echo "<h4>W okresie od " . $data_od . " do " . $data_do . " nie miałeś żadnych przeterminowanych leków.<h4>";
				}else{
					// jesli znaleziono
					echo "<h4>W okresie od " . $data_od . " do " . $data_do . " przeterminowały się następujące leki:</h4>";
					echo "<ul>";
					
					$wartosc_przetrminowane = 0;
					
					while($row = $przeterminowane -> fetch_assoc()){
						$id_spec = $row['id_specyfikacja'];
						// wybranie z tabeli specyfikacja leku o danym id
						$wyszukaj_nazwe = "SELECT nazwa FROM leki_specyfikacja WHERE id='$id_spec'";
						$nazwa = $baza -> query($wyszukaj_nazwe);
						$row_nazwa = $nazwa -> fetch_assoc();
						// wypisanie nazwy przeterminowanego leku
						echo "<li>" . $row_nazwa['nazwa'] . "</li>";
						// obliczenie wartosci przeterminowanych lekow w kolejnych iteracjach petli
						$wartosc_przeterminowane = $wartosc_przeterminowane + $row['Cena'];
					}
					echo "</ul>";
					echo "<h4>Koszt utylizacji powyższych leków wynosił " . $wartosc_przeterminowane . " złotych.</h4>";
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
