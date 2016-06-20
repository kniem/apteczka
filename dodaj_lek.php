<?php
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";
	
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
					<div class="col-xs-12 col-sm-6">
						<form role="form" action="dodaj_do_bazy.php" method="GET">
							<h3><?php echo $dodajWprowadz; ?></h3>
							<div class="col-xs-12">
								<label for="nazwa"><?php echo $dodajNazwa; ?></label><br>
								<input type="text" name="nazwa" required><br>
								<label for="ilosc"><?php echo $dodajIlosc; ?></label><br>
								<input type="number" name="ilosc" min="1" required><br>
								<label for="cena"><?php echo $dodajCena; ?></label><br>
								<input type="number" name="cena" required><br>
								<label for="termin"><?php echo $dodajTermin; ?></label><br>
								<input type="date" name="termin" required><br>
								<input type="submit" value="Zapisz" style="margin: 5px;">
								
							</div>
						</form>	
					</div>
					<div class="col-xs-12 col-sm-6">
						<h3><?php echo $dodajSpec; ?></h3>
						<form role="form" action="dodaj_specyfikacje_do_bazy.php" method="GET">
							<div class="col-xs-12">
								<label for="nazwa"><?php echo $dodajNazwa; ?></label><br>
								<input type="text" name="nazwa" required><br>
								<label for="ean"><?php echo $dodajEan; ?></label><br>
								<input type="text" name="ean" required><br>
								<label for="substancja"><?php echo $dodajSubst; ?></label><br>
								<input type="text" name="substancja" required><br>
								<input type="submit" value="Zapisz" style="margin: 5px;">
							</div>
						</form>	
					</div>
				</div>
				<div class="row" style="padding: 20px 0px;">
					<center>
						<form role="form" action="specyfikacje.php" method="GET">
							<input type="submit" value="Sprawdź leki dostępne w bazie"> 
						</form>
					</center>
				</div>
			</div>
		<?php } ?>
	</div>

<?php
	require_once 'inc/stopka.php';
?>
