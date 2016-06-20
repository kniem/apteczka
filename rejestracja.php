<?php 
	session_start();
	
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
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
			
			if($baza -> connect_errno != 0){
				echo "Error: " . $baza -> connect_errno;
			}
			
			else{
				$akcja = "INSERT INTO uzytkownicy VALUES (NULL, '$imie', '$nazwisko', '$email', '$szyfr_haslo')";
				$new_user = $baza -> query($akcja);
				
				echo "Zarejestrowałeś się w aplikacji Domowa Apteczka. Przejdź na stronę główną, by się zalogować."
				?>
				<div id="tresc">
				<center style="margin: 50px 0px;"><b><a href="index.php">Strona główna</a></b></center></div>
				<?php
			}
		}
	
		else {
			?>
			<div id="tresc">
				<div class="container" style="padding-top: 100px;">
						<div class="row row-content">
							<div class="col-xs-6 col-xs-offset-3">
								<form action="" method="POST">
									<fieldset align="center">
									<legend>Utwórz nowe konto</legend>
										<label><?php echo $lbEmail?></label><br>
										<input type="email" name="email" placeholder="<?php echo $logEmailpch?>" required><br>
										<label><?php echo $lbHaslo?></label><br>
										<input type="password" name="haslo" placeholder="<?php echo $logHaslopch?>" required><br>
										<label>Imię</label><br>
										<input type="text" name="imie" placeholder="Wprowadź imię" required style="margin-left: 10px;"><br>
										<label>Nazwisko</label><br>
										<input type="text" name="nazwisko" placeholder="Wprowadź nazwisko" required><br>
										<input type="submit" value="Rejestruj" style="margin-left: 5px;">
									</fieldset>	
								</form>
							</div>				
						</div>
						
					</div>
				</div>
				<?php 				
				
		}
	}
		
		else{
			session_destroy();
		}


?>
<?php
	require_once 'inc/stopka.php';
?>

