<?php
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";
	
	
?>
	<div id="tresc">
	<?php
		if(!isset($_GET['wybrano']) ){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else
			$opcja = ($_GET['wybrano']);
		
//		echo "Wybrano opcję nr: " . $opcja . " " . $wybrane[$opcja];
	?>
	<?php
		if(!isset($_SESSION['zalogowany'])){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else{ ?>
			<div class="container">
				<div class="row row-content">
					<div>
						<form role="form" action="dodaj_do_bazy.php?wybrano=5" method="POST">
							<h3>Wprowadź lek do apteczki</h3>
							<div class="col-xs-12">
								<label for="nazwa">Nazwa leku</label><br>
								<input type="text" name="nazwa" required><br>
								<label for="ean">Kod EAN</label><br>
								<input type="number" name="ean" required><br>
								<label for="cena">Cena leku</label><br>
								<input type="text" name="cena" required><br>
								<label for="termin">Termin przydatnośći</label><br>
								<input type="date" name="termin" required><br>
								<input type="submit" value="Zapisz" style="margin: 5px;">
							</div>
						</form>	
					</div>
				</div>
				<div>
					<a href="dodaj_specyfikacje.php?wybrano=6">Dodaj nowy lek do bazy</a>
				</div>
			</div>
	<?php } ?>
	</div>

<?php
	require_once 'inc/stopka.php';
?>