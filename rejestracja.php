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
		if(isset($_POST['email']) && isset($_POST['haslo']) && isset($_POST['nazwisko']) && isset($_POST['imie'])){
			$email = $_POST['email'];
			$haslo = $_POST['haslo'];
			$imie = $_POST['imie'];
			$nazwisko = $_POST['nazwisko'];
			$szyfr_haslo = crypt($haslo, CRYPT_MD5);
			echo $email .$szyfr_haslo;
			
			if($baza -> connect_errno != 0){
				echo "Error: " . $baza -> connect_errno;
			}
			
			else{
				$akcja = "INSERT INTO uzytkownicy VALUES (NULL, '$imie', '$nazwisko', '$email', '$szyfr_haslo')";
				$new_user = $baza -> query($akcja);
				
				echo "Zarejestrowałeś się w aplikacji Domowa Apteczka. Przejdź na stronę główną, by się zalogować."
				?>
				<center><b><a href="index.php">Strona główna</a></b></center>
				<?php
			}
		}
	
		else {
			?>
			<div id="tresc">
				<div class="container" style="padding-top: 100px;">
						<div class="row row-content">
							<div class="col-xs-4 col-xs-offset-4">
								<form action="" method="POST">
									<fieldset align="center">
									<legend>Utwórz nowe konto</legend>
										<?php echo $lbEmail?><input type="email" name="email" placeholder="<?php echo $logEmailpch?>" required><br>
										<?php echo $lbHaslo?><input type="password" name="haslo" placeholder="<?php echo $logHaslopch?>" required><br>
										Imię<input type="text" name="imie" required><br>
										Nazwisko<input type="text" name="nazwisko" required><br>
										<input type="submit" value="Rejestruj">
									</fieldset>	
								</form>
							</div>				
						</div>
						
					</div>
				</div>
				<?php 
			
				$email = $_POST['email'];
				$haslo = $_POST['haslo'];
				$imie = $_POST['imie'];
				$nazwisko = $_POST['nazwisko'];
				$szyfr_haslo = crypt($haslo, CRYPT_MD5);
				
				
		}
	}
		
		else{
			session_destroy();
		}


?>
<?php
	require_once 'inc/stopka.php';
?>

