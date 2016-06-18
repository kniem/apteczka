<?php
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	require_once "inc/nagl.php";
	
	//wylogowanie
	if($_GET['wyloguj'] == 1){
		session_destroy();
	}
	/*
	//Sprawdzenie czy zalogowano - 
	if(isset($_POST['email']) && isset($_POST['haslo'])){
 		if(sprawdz_login_haslo($_POST['email'],$_POST['haslo']))
			$_SESSION['zalogowany'] = $_POST['email'];
		else $byl_blad_logowania=2;}
	else{ 
		//session_destroy();
		print_r($_POST); 
	}
	print_r($_SESSION);
?><a href="skrypt_2.php"><?php echo $menuAp;?></a>*/

?>
	<div id="tresc">
	<?php /*
		if(!isset($_GET['wybrano']) ){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else
			$opcja = ($_GET['wybrano']);
		
//		echo "Wybrano opcję nr: " . $opcja . " " . $wybrane[$opcja];*/
	?>
	<?php
		if(!isset($_SESSION['zalogowany'])){
			header("Location: index.php?wybrano=0&zaloguj_sie=1");
		}else{ ?>
			<div class="container" style="padding-top: 50px;">
				<div class="row row-content">
					<div class="col-xs-12 col-sm-6">
						<form role="form" action="dodaj_do_bazy.php" method="GET">
							<h3>Wprowadź lek do apteczki</h3>
							<div class="col-xs-12">
								<label for="nazwa">Nazwa leku</label><br>
								<input type="text" name="nazwa" required><br>
								<label for="ilosc">Ilość</label><br>
								<input type="number" name="ilosc" min="1" required><br>
								<label for="cena">Cena leku</label><br>
								<input type="number" name="cena" required><br>
								<label for="termin">Data ważności</label><br>
								<input type="date" name="termin" required><br>
								<input type="submit" value="Zapisz" style="margin: 5px;">
								
							</div>
						</form>	
					</div>
					<div class="col-xs-12 col-sm-6">
						<h3>Nie znalazłeś leku, który chcesz dodać do apteczki? Dodaj jego specyfikację.</h3>
						<form role="form" action="dodaj_specyfikacje_do_bazy.php" method="GET">
							<div class="col-xs-12">
								<label for="nazwa">Nazwa leku</label><br>
								<input type="text" name="nazwa" required><br>
								<label for="ean">Kod EAN</label><br>
								<input type="text" name="ean" required><br>
								<label for="substancja">Substancja czynna</label><br>
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
						</form></center>
				</div>
			</div>
		<?php } ?>
	</div>

<?php
	require_once 'inc/stopka.php';
?>
