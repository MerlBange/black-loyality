<div id="reglog">
	<script>
		document.getElementById('sidebar').style.display = 'none';
		document.getElementById('logout').style.display = 'none';
		document.getElementById('probut').style.display = 'none';
	</script>

	<?php
	
		if($_SESSION != NULL) {
			echo '<div id="startnews">';
				echo '<p style="font-size: 18pt; color: white; text-align: center;">Du musst ausgeloggt sein, um dich zu registrieren</p>
					<p style="font-size: 14pt; color: white; text-align: center;">Du wirst weitergeleitet, falls keine Weiterleitung erfolgt <a href="index.php">bitte hier</a> klicken</p>';
			echo '</div>';
			die(header( "refresh:2; url=index.php"));
		}
		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
		$pdo = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', 'aneLX1smurf!');
		$Form = true;
		 
		if($_GET["send"] == 1 && !empty($_POST)) {
			$error = false;
			$username = $_POST['username'];
			$passwort = $_POST['password'];
			$passwort2 = $_POST['password2'];
			$name = $_POST['name'];
			$vname = $_POST['vname'];
			$email = $_POST['email'];
		  
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo '<p style="color: white; margin-left: 37%"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Bitte eine gültige E-Mail-Adresse eingeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
				$error = true;
			}
			if(strlen($passwort) < 8) {
				echo '<p style="color: white; margin-left: 37%"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Bitte ein Passwort mit min. 8 Stellen eingeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
				$error = true;
			}
			if($passwort != $passwort2) {
				echo '<p style="color: white; margin-left: 37%"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Die Passwörter müssen übereinstimmen<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
				$error = true;
			}
			
			$statement = $pdo->prepare("SELECT * FROM user WHERE u_email='$email'");
			$statement->execute();
				
			if($statement->fetch() > 0) {
				echo '<p style="color: white; margin-left: 37%"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Diese E-Mail ist bereits vergeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
				$error = true;
			}
			
			$statement = $pdo->prepare("SELECT * FROM user WHERE u_uname='$username'");
			$statement->execute();
				
			if($statement->fetch() > 0) {
				echo '<p style="color: white; margin-left: 37%"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Dieser Nutzername ist bereits vergeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
				$error = true;
			}
			
			
			if(!$error) {
				$passwort = md5($passwort);
				$statement = $pdo->prepare("INSERT INTO user (u_uname, u_password, u_vname, u_name, u_email) VALUES (?,?,?,?,?)");
				$statement->execute(array($username,$passwort,$vname,$name,$email));
				
				if($statement) {        
					echo 'Du wurdest erfolgreich registriert. <a href="index.php"><div class="button login">Zum Login</div></a>';
					$Form = false;
				} else {
					echo 'Es ist ein Fehler aufgetreten';
				}
			}
			$Form = false;
			header( "refresh:3; url=index.php?page=register&send=0" );
		}
		 
		if($Form) {
	?>
	<?php
		if(!isset($_SESSION['benutzer'])){ 
	?>
		<div id="register">
			<form action = "index.php?page=register&send=1" method = "post">
				<p style="text-align: center; font-size: 16pt;"><u>Registrieren</u></p>
				<div class="row">
					<div class="r1">
						<label for="username">Nutzername</label>
					</div>
					<div class="r2">
						<input type="text" name="username" placeholder="Benutzername">
					</div>
				</div>
				<div class="row">
					<div class="r1">
						<label for="password">Passwort</label>
					</div>
					<div class="r2">
						<input type="password" name="password" placeholder="Passwort">
					</div>
				</div>
				<div class="row">
					<div class="r1">
						<label for="password2">Passwort</label>
					</div>
					<div class="r2">
						<input type="password" name="password2" placeholder="Passwort wiederholen">
					</div>
				</div>
				<div class="row">
					<div class="r1">
						<label for="vname">Vorname</label>
					</div>
					<div class="r2">
						<input type="text" name="vname" placeholder="Vorname">
					</div>
				</div>
				<div class="row">
					<div class="r1">
						<label for="name">Nachname</label>
					</div>
					<div class="r2">
						<input type="text" name="name" placeholder="Nachname">
					</div>
				</div>
				<div class="row">
					<div class="r1">
						<label for="email">E-Mail</label>
					</div>
					<div class="r2">
						<input type="text" name="email" placeholder="E-Mail">
					</div>
				</div>
				<div class="row">
					<div class="r5">
						<button class="button menu" type="submit">Registrieren</button>
					</div>
					</form>
					<div class="r6">
						<a href="index.php"><div class="button menu">Zum Login</div></a>
					</div>
				</div>
		</div>
	<?php } ?>
</div>
<?php
}
?>