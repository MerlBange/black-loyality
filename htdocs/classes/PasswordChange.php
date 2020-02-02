<?php if(!isset($_GET['page'])) die(header("refresh: 0; ../index.php?page=pwchange")); ?>

<div id="home">
	<div id="profilleiste">
		<a href="index.php?page=profil&user=<?php echo $_SESSION["benutzer"];?>"><div class="button profil" id="Profilübersichtsbutton">Profilübersicht</div></a>
		<a href="index.php?page=pwchange"><div class="button profil" id="profil2">Passwort ändern</div></a>
		<a href="index.php?page=picupload"><div class="button profil" id="profil4">Profilbild hochladen</div></a>
		<script>
			document.getElementById('profil2').style.backgroundColor = 'rgb(30,30,30)';
		</script>
		<?php if($g_id == 1){ ?>
			<a href="index.php?page=users"><div class="button profil" id="profil3">Alle User</div></a>
		<?php } ?>
	</div>
	<div id="profil">
		<div id="startnews">
			<script type="text/javascript">
				document.title = "Black Loyality || Passwort ändern"
			</script>
	<?php
		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
		$pdo = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', 'aneLX1smurf!');
		$Form = true;
		 
		if($_GET["send"] == 1 && !empty($_POST)) {
			$error = false;
			$currentuser = $_SESSION['benutzer'];
			
			if($_POST['currentpw']) {
				$currentpw = md5($_POST['currentpw']);
			} else {
				$currentpw = '';
			}
			
			$passwort = $_POST['passwordnew1'];
			$passwort2 = $_POST['passwordnew2'];
			
			$statement = $pdo->prepare("SELECT * FROM user WHERE u_uname='$currentuser' AND u_password='$currentpw'");
			$statement->execute();
				
			if($statement->fetch() == 0) {
				echo '<div class="row">
						<div class="r4">
							<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Das Passwort stimmt nicht mit dem in unserem System überein<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>
						</div>
					</div>';
				header( "refresh:3; url=index.php?page=pwchange" );
				$error = true;
			}
		
			if(strlen($passwort) < 8) {
				echo '<div class="row">
						<div class="r4">
							<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Bitte ein Passwort mit min. 8 Stellen eingeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>
						</div>
					</div>';
				header( "refresh:3; url=index.php?page=pwchange" );
				$error = true;
			} 
			if($passwort != $passwort2) {
				echo '<div class="row">
						<div class="r4">
							<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Die Passwörter müssen übereinstimmen<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>
						</div>
					</div>';
				header( "refresh:3; url=index.php?page=pwchange" );
				$error = true;
			}
			
			$Form = false;
			
			if(!$error) {
				$passwort = md5($passwort);
				$statement = $pdo->prepare("UPDATE user SET u_password = '$passwort' WHERE u_uname='$currentuser'");
				$statement->execute();
				
				if($statement) {        
					echo '<p style="color: white; margin-left: 37%"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Passwort erfolgreich geändert<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
					header( "refresh:3; url=index.php?page=pwchange" );
					$Form = false;
				} else {
					echo 'Es ist ein Fehler aufgetreten';
					header( "refresh:3; url=index.php?page=pwchange" );
				}
			}
		}
		 
	if($Form) {
	?>
		<form action = "index.php?page=pwchange&send=1" method = "post">
			<div class="row">
				<div class="r1">
					<label for="currentpw">Aktuelles Passwort</label>
				</div>
				<div class="r2">
					<input type="password" name="currentpw" placeholder="Aktuelles Passwort">
				</div>
			</div>
			<div class="row">
				<div class="r1">
					<label for="passwordnew1">Neues Passwort</label>
				</div>
				<div class="r2">
					<input type="password" name="passwordnew1" placeholder="Neues Passwort">
				</div>
			</div>
			<div class="row">
				<div class="r1">
					<label for="passwordnew2">Passwort wiederholen</label>
				</div>
				<div class="r2">
					<input type="password" name="passwordnew2" placeholder="Passwort wiederholen">
				</div>
			</div>
			<div class="row">
				<div class="r7">
					<button class="button menu" type="submit">Passwort ändern</button>
				</div>
			</div>
		</form>
		</div>
	</div>
	<?php
	}
	?>
</div>