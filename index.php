<?php 
	session_start();
	
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	require_once "inc/funkcje.php";
	require_once "inc/nagl.php";
	require_once "inc/baza.php";

//wylogowanie
	if($_GET['wyloguj'] == 1){
		header("Location: index.php?wybrano=0");
		session_destroy();
		exit();
	}

//AKCJA LOGOWANIE 

	if(!isset($_SESSION['zalogowany'])){
		if(isset($_POST['email']) && isset($_POST['haslo'])){
			if($baza -> connect_errno != 0){
				echo "Error: " . $baza -> connect_errno;
			}else{
				$email = $_POST['email'];
				$haslo = $_POST['haslo'];
				// wybranie z tabeli uzytkowanicy odpowiedniego rekordu
				$akcja = "SELECT * FROM uzytkownicy WHERE email = '$email'";
				$user = $baza -> query($akcja);
				if(($user -> num_rows) == 1){
					$row = $user -> fetch_assoc();
					
					//szyfrowanie podanego przez usera hasla
					$szyfr_haslo = crypt($haslo, CRYPT_MD5);
					//pobranie hasla z bazy
					$haslo_baza = $row['haslo'];
					//porownanie hasel
					if(strcmp($haslo_baza, $szyfr_haslo) == 0){
						$_SESSION['zalogowany'] = $_POST['email'];
						$uzytkownik = $row['imie'];
					}else {echo "<h4 style=\"margin: 10px;\">Podane hasło jest nieprawidłowe</h4>"; session_destroy();}
				}else {echo "<h4 style=\"margin: 10px;\">Nie istnieje konto o podanym adresie e-mail</h4>"; session_destroy();}
			}
		}else{
			session_destroy();
		}
	}

//////////////KONIEC LOGOWANKA////////////////////
?>


<?php

//FORMULARZE 

	if (!isset($_SESSION['zalogowany'])){
		?>
	<div id="tresc">
		<div class="container" style="padding-top: 100px;">
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
			<br><center>
			<h4>Nie masz konta?</h4><br>
				<form action="rejestracja.php" method="POST">
				<input type="submit" value="Zarejestruj się"></form>
				</center>
		</div>
	</div>
	<?php 
	}else{ ?>
	<div id="tresc">
		<div class="container">
			<div class="row row-content" style="padding-top: 40px; padding-bottom: 40px;">
				<div class="col-xs-12">
					<h2>Witaj w domowej apteczce <?php echo $uzytkownik;?>!</h2>
					<h4>Domowa apteczka to aplikacja, która pomoże Tobie i Twojej rodzinie uporządkować
					leki. Stwórz swoją własną bazę leków i na bieżąco kontroluj ich zużycie.</h4>
				</div>
			</div>	
			<div class="row row-content" style="padding-bottom: 40px;">	
				<div class="col-xs-12">
					<h2>Wziąłeś lek z apteczki?</h2>
				</div>
				<div class="col-xs-12">
					<form action="wez_lek_bazy.php" method="GET">
						<fieldset>
							<label for="data">Data</label><br>
							<input type="date" name="data" required><br>
							<label for="ean">Nazwa</label><br>
							<input type="text" name="name" required><br>
							<label for="ilosc">Ilość</label><br>
							<input type="number" name="ilosc" min="1" required><br>
							<input type="submit" value="Zapisz" style="margin: 5px;">
						</fieldset>	
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>		

<?php
	require_once 'inc/stopka.php';
?>
