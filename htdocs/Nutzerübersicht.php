<div id="home">
	<div id="profilleiste">
		<a href="index.php?page=profil&user=<?php echo $_SESSION["benutzer"];?>"><div class="button profil" id="Profilübersichtsbutton">Profilübersicht</div></a>
		<a href="index.php?page=pwchange"><div class="button profil" id="profil2">Passwort ändern</div></a>
		<a href="index.php?page=picupload"><div class="button profil" id="profil4">Profilbild hochladen</div></a>
		<?php if($g_id == 1){ ?>
			<a href="index.php?page=users"><div class="button profil" id="profil3">Alle User</div></a>
		<?php } ?>
		<script>
			document.getElementById('profil3').style.backgroundColor = 'rgb(30,30,30)';
		</script>
	</div>
	<div id="profil">
		<div id="startnews">
			<?php
			error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
			function fehler(){
			$error = FALSE;
				if(empty($_POST["ausgabe"])){
				echo '<p style="color: white; margin-left: 37%"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Keinen Nutzer ausgewählt<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
				$error = TRUE;
			}
			return $error;
			}
			
			if($g_id != 1) die("Sie haben nicht die nötigen Rechte, um diese Seite anzusehen");
			else {
			$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
			$connect->set_charset("utf8");
			if(!$_GET["user"] && !$_GET["delete"] && !$_GET["activate"]){
			
			$abfrage = "Select u_id, u_uname, u_vname, u_name, u_email, u_activated, g_name from user INNER JOIN usergroups using(u_id) INNER JOIN groups using (g_id) order by u_id asc";
			
			$ergebnis = $connect->query($abfrage);
			if($ergebnis->num_rows> 0){
				$i = 0;
				?>
				<form action="index.php?page=users&delete=success" method="POST">
				<?php
				while($row=$ergebnis->fetch_assoc()) { 
					$i++;
					$daten[$i] = array($row["u_id"],$row["u_uname"],$row["u_vname"],$row["u_name"],$row["u_email"], $row["u_activated"], $row["g_name"]);
					$max = $i;
					echo '<div class="row">';
						echo '<div class="r9">';
							echo '<input style="" type="radio" value="'.$daten[$i][0].'" name="ausgabe" />';
						echo '</div>';
					echo '</div>';
					ausgabe($daten[$i]);
				}
				?>
				
				<?php
			}
			?>
		</div>
		<button type="submit" class="button menu">Nutzer löschen</button>
		<button type="submit" class="button menu" formaction="index.php?page=users&activate=success">Nutzer aktivieren/deaktivieren</button>
		<button type="submit" class="button menu" formaction="index.php?page=users&user=edit">Nutzer bearbeiten</button>
		</form>
	<?php }
	
		if($_GET["activate"] == 'success'){
			if(fehler()){
				header( "refresh:2; url=index.php?page=users" );
			} else {
				$test = $_POST['ausgabe'];
				$abfrage = "SELECT u_activated FROM user WHERE u_id='$test'";
				$ergebnis = $connect->query($abfrage);
				$row=$ergebnis->fetch_assoc();
				if($row["u_activated"] == 0){
					$abfrage = "UPDATE user SET u_activated=1 WHERE u_id='$test'";
					$ergebnis = $connect->query($abfrage);
					echo 'Sie haben den User mit der ID '.$test.' aktiviert';
				} else {
					$abfrage = "UPDATE user SET u_activated=0 WHERE u_id='$test'";
					$ergebnis = $connect->query($abfrage);
					echo 'Sie haben den User mit der ID '.$test.' deaktiviert';
				}
				header( "refresh:2; url=index.php?page=users" );
			}
		}
		
		if($_GET["delete"] == 'success'){
			if(fehler()){
				header( "refresh:2; url=index.php?page=users" );
			} else {
				$test = $_POST['ausgabe'];
				$abfrage = "DELETE FROM user WHERE u_id='$test'";
				if($ergebnis = $connect->query($abfrage)){
					echo 'Sie haben den User mit der ID '.$test.' gelöscht';
				} else {
					echo 'Es ist ein Fehler aufgetreten';
				}
				header( "refresh:2; url=index.php?page=users" );
			}
		}
		
		if($_GET["user"] == 'edit'){
			if(fehler()){
				header( "refresh:2; url=index.php?page=users" );
			} else {
				$test = $_POST['ausgabe'];
				$abfrage = "Select u_id, u_uname, u_vname, u_name, u_email, u_activated, g_name from user INNER JOIN usergroups using(u_id)
							INNER JOIN groups using (g_id) where u_id='$test' order by u_id asc";
				$ergebnis = $connect->query($abfrage);
				if($ergebnis->num_rows> 0){
					while($row=$ergebnis->fetch_assoc()){
					$testdaten = array($row["u_id"],$row["u_uname"],$row["u_vname"],$row["u_name"],$row["u_email"], $row["u_activated"], $row["g_name"]);
					} ?>
					<form action="index.php?page=users&user=save" method="POST">
				
					<div class="row">
						<div class="r1"> User-ID </div>
						<div class="r2"> <input type="hidden" name="userid" id="userid" value="<?php echo $testdaten[0]; ?>"><?php echo $testdaten[0]; ?></input></div>
					</div>
					
					<div class="row">
						<div class="r1"> <label for="username">Username </label></div>
						<div class="r2"> <input type="text" id="username" name="username" placeholder="<?php echo $testdaten[1]; ?>"></input></div>
					</div>
					
					<div class="row">
						<div class="r1"> <label for="vorname">Vorname </label> </div>
						<div class="r2"> <input type="text" name="vorname" id="vorname" placeholder="<?php echo $testdaten[2]; ?>"></input></div>
					</div>
					
					<div class="row">
						<div class="r1"> Nachname </div>
						<div class="r2"> <input type="text" name="nachname" id="nachname" placeholder="<?php echo $testdaten[3]; ?>"></input></div>
					</div>
					
					<div class="row">
						<div class="r1"> E-Mail </div>
						<div class="r2"> <input type="text" name="email" id="email" placeholder="<?php echo $testdaten[4]; ?>"></input></div>
					</div>
					<div class="row">
						<div class="r1"> Gruppe </div>
						<div class="r2">
							<select name="group">
								<option value="<?php echo $testdaten[6] ?>"><?php echo $testdaten[6] ?></option>
  								<option value="Lehrer">Lehrer</option>
 								<option value="Klassensprecher">Klassensprecher</option>
								<option value="Supporter">Supporter</option>
								<option value="Schueler">Schüler</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="r3">
							<button class="button login" type="submit">Speichern</button>
						</div>
					</div>
				</form>
				<?php
				} else {
					echo 'Ein Fehler ist aufgetreten';
					header( "refresh:2; url=index.php?page=users" );
				}
			}
		}
		if($_GET["user"] == 'save'){
			$id = $_POST["userid"];
			$username = $_POST["username"];
			$vorname = $_POST["vorname"];
			$nachname = $_POST["nachname"];
			$email = $_POST["email"];

			$abfrage = "Select u_id, u_uname, u_vname, u_name, u_email, u_activated, g_name from user INNER JOIN usergroups using(u_id)
							INNER JOIN groups using (g_id) where u_id='$id' order by u_id asc";
			$ergebnis = $connect->query($abfrage);
			if($ergebnis->num_rows> 0){
				while($row=$ergebnis->fetch_assoc()){
				$daten = array($row["u_id"],$row["u_uname"],$row["u_vname"],$row["u_name"],$row["u_email"], $row["u_activated"], $row["g_name"]);
				}
			}

			$pdo = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', 'aneLX1smurf!');
			if(empty($_POST['username']) && empty($_POST['vorname']) && empty($_POST['nachname']) && empty($_POST['email'])) {
				echo '<p style="font-size: 16pt; margin-left: 2%;"><img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/>Nichts geändert<img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/></p>';
				header( "refresh:2; url=index.php?page=users" );
			} else {
				$error = false;
				
				if( !empty($_POST['username'])){
					$uname = $_POST['username'];
					if(!$error) {
						$statement = $pdo->prepare("SELECT * FROM user WHERE u_uname='$uname'");
						$statement->execute();
						if($statement->fetch() > 0) {
							echo '<p style="color: white; margin-left: 2%; font-size: 16pt;"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Dieser Nutzername ist bereits vergeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
							header( "refresh:2; url=index.php?page=users" );
							$error = true;
						}
					}
				} else $uname = $daten[1];
				
				if( !empty($_POST['vorname'])){
					$uvname = $_POST['vorname'];
				} else $uvname = $daten[2];

				if( !empty($_POST['nachname'])){
					$unname = $_POST['nachname'];
				} else $unname = $daten[3];
					
				if( !empty($_POST['email'])){
					$uemail = $_POST['email'];
					if(!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
						echo '<p style="color: white; margin-left: 2%; font-size: 16pt;"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Bitte eine gültige E-Mail-Adresse eingeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
						header( "refresh:2; url=index.php?page=users" );
						$error = true;
					}
					if(!$error) {
						$statement = $pdo->prepare("SELECT * FROM user WHERE u_email='$uemail'");
						$statement->execute();
						if($statement->fetch() > 0) {
							echo '<p style="color: white; margin-left: 2%; font-size: 16pt;"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Diese E-Mail ist bereits vergeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
							header( "refresh:2; url=index.php?page=users" );
							$error = true;
						}
					}
				} else $uemail = $daten[4];
					
				if(!$error){
					$sql = "UPDATE user SET u_uname='$uname', u_vname='$uvname', u_name='$unname', u_email='$uemail' where u_id = '$id' ";

					if(mysqli_query($connect, $sql)) {
						echo '<p style="font-size: 18pt;"><img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/>Erfolgreich geändert<img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/></p>';
						if($daten[1] == $_SESSION["benutzer"]){
							session_destroy();
							session_start();
							$_SESSION['benutzer'] = $uname;
							die(header( "refresh:1; url=index.php?page=profil" ));
						}
						header( "refresh:1; url=index.php?page=users" );
					} else echo'Fehler';
				}
		}
	}
}
		?>
	</div>
</div>