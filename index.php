<?php 

	session_start();
	require_once 'conf/zmienne.php';
//	require_once "inc/$lang/error_msg.php";
	require_once "inc/$lang/teksty.php";
	require_once "inc/funkcje.php";
	
	require_once "inc/nagl.php";
	
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
	if( !isset($_GET['wybrano'])){
		header ("Location: index.php?wybrano=0&zaloguj_sie=1");
	} else 
		$opcja  = ($_GET['wybrano']);
//	echo "Wybrano opcję nr ". $opcja . " " . $wybrane[$opcja] . "<br><br>";
	echo '<p id="blad">';
		if(isset($byl_blad_logowania)&& $byl_blad_logowania==2) echo $blad_logowania;
	echo '</p>';
	if (!isset($_SESSION['zalogowany'])){
		?>
	
		<div class="container">
			<div class="row row-content">
				<div class="col-xs-4 col-xs-offset-4">
					<form action="" method="POST">
						<fieldset align="center">
							<legend><?php echo $lgLogowanie?></legend>
							<?php echo $lbEmail?><input type="email" name="email" placeholder="<?php echo $logEmailpch?>" required><br>
							<?php echo $lbHaslo?><input type="password" name="haslo" placeholder="<?php echo $logHaslopch?>" required><br>
							<input type="submit" value="Zaloguj">
						</fieldset>	
					</form>
				</div>
			</div>
		</div>
	<?php 
	}else{ ?>
		<div class="container">
			<div class="row row-content" style="padding-top: 40px; padding-bottom: 40px;">
				<div class="col-xs-12">
					<h2>Witaj w domowej apteczce!</h2>
					<h4>Domowa apteczka to aplikacja, która pomoże Tobie i Twojej rodzinie uporządkować
					leki. Stwórz swoją własną bazę leków i na bieżąco kontroluj ich zużycie.</h4>
				</div>
			</div>	
			<div class="row row-content" style="padding-bottom: 40px;">	
				<div class="col-xs-12">
					<h2>Wziąłeś lek z apteczki?</h2>
				</div>
				<div class="col-xs-12">
					<form action="" method="POST">
						<fieldset>
							<label for="data">Data</label><br>
							<input type="date" name="data" required><br>
							<label for="nazwa">Nazwa leku</label><br>
							<input type="text" name="nazwa" required><br>
							<label for="ilosc">Ilość</label><br>
							<input type="number" name="ilosc" min="0" required><br>
							<input type="submit" value="Zapisz" style="margin: 5px;">
						</fieldset>	
					</form>
				</div>
			</div>
	<?php } ?>		
</div>
<?php
	require_once 'inc/stopka.php';
?>

