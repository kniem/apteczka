<?php
	session_start();
	print_r($_SESSION);
//	require_once 'conf/zmienne.php';
//	require_once "inc/$lang/teksty.php";
//	require_once "inc/nagl.php";
	// WYSLAC TO POSTEM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
?>

	<div id="tresc">
	<?php
//		if(!isset($_GET['wybrano']) ){
//			header("Location: index.php?wybrano=0&zaloguj_sie=1");
//		}else
//			$opcja = ($_GET['wybrano']);

		print_r($_SESSION);
	?>
	<?php 
	/*
		if(!isset($_SESSION['zalogowany'])){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else{ ?>
			<div class="container">
				<div class="row row-content">
					<div>
						<form role="form" action="dodaj_specyfikacje_do_bazy.php" method="POST">
							<h3>Wprowadź specyfikację do bazy</h3>
							<div class="col-xs-12">
								<label for="nazwa">Nazwa leku</label><br>
								<input type="text" name="nazwa" required><br>
								<label for="ean">Kod EAN</label><br>
								<input type="text" name="ean" required><br>
								<label for="ilosc">Ilość sztuk w opakowaniu</label><br>
								<input type="number" name="ilosc" required><br>
								<label for="substancja">Substancja czynna</label><br>
								<input type="text" name="substancja" required><br>
								<input type="submit" value="Zapisz" style="margin: 5px;">
							</div>
						</form>	
					</div>
				</div>
			</div>
	<?php }*/ ?>
	</div>

<?php 
	require_once 'inc/stopka.php';
?>