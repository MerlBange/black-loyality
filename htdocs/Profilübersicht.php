<?php if(!isset($_GET['page'])) die(header("refresh: 0; index.php?page=profil")); ?>

<div id="home">
<div id="profilleiste">
	<?php
	//Abfrage ob Session gesetzt ist
	if ($_SESSION == NULL) $benutzer = 'Gast';
	else $benutzer = $_SESSION['benutzer'];
	
	
	if(!isset($_GET["user"])) die(header("refresh: 0; index.php?page=profil&user=$benutzer"));
	$publicprofile = $_GET["user"];
	if(empty($publicprofile)) die(header("refresh: 0; index.php?page=profil&user=$benutzer"));
	
	if($publicprofile == $benutzer){
	?>
	<a href="index.php?page=profil&user=<?php echo $_SESSION["benutzer"];?>"><div class="button profil" id="Profilübersichtsbutton">Profilübersicht</div></a>
	<?php } else { ?>
	<a href="index.php?page=profil&user=<?php echo $publicprofile;?>"><div class="button profil" id="Profilübersichtsbutton">Profilübersicht von <?php echo $publicprofile?></div></a>
	<?php } ?>
	
	<script>
		document.getElementById('Profilübersichtsbutton').style.backgroundColor = 'rgb(30,30,30)';
	</script>
	<a href="index.php?page=pwchange"><div class="button profil" name="profil2">Passwort ändern</div></a>
	<a href="index.php?page=picupload"><div class="button profil" id="profil4">Profilbild hochladen</div></a>
	<?php if($g_id == 1){ ?>
		<a href="index.php?page=users"><div class="button profil" name="profil3">Alle User</div></a>
	<?php } ?>
</div>
	<div id="profil">
	<div id="startnews">
		<?php
		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
		if($publicprofile == $benutzer){
		
		$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
		$connect->set_charset("utf8");
		
		?>
		<img id="pb" style="position: absolute; margin-top: 1%; margin-left: 77%; border-radius: 100px;" src="<?php 
		if(is_file("shared/$benutzer/profilbild.png")) echo "shared/$benutzer/profilbild.png";
		else echo "shared/public/profilbild.png";
		?>" height="200px" width="200px">
		<?php
		//SQL Ausgabe für Array
		$abfrage = "Select u_id, u_uname, u_vname, u_name, u_email, u_activated, g_name from user INNER JOIN usergroups using(u_id) INNER JOIN groups using (g_id) where u_uname='$benutzer'";
		
		//Ergebnisse in ein Array einlesen
		$ergebnis = $connect->query($abfrage);
		if($ergebnis->num_rows> 0){
			$i = 0;
			while($row=$ergebnis->fetch_assoc()) { 
				$i++;
				$daten[$i] = array($row["u_id"],$row["u_uname"],$row["u_vname"],$row["u_name"],$row["u_email"],$row["u_activated"], $row["g_name"]);
				$max = $i;
			}
		}
		
		$i = 1;
		if($benutzer != 'Gast' && $_GET["edit"] == 1){?>
				<script> document.getElementById('pb').style.display = 'none'; </script>
				<form action="index.php?page=profil&user=<?= $benutzer?>&save=1" method="POST">
				
					<div class="row">
						<div class="r1"> User-ID </div>
						<div class="r2"> <?php echo $daten[$i][0]; ?></div>
					</div>
					
					<div class="row">
						<div class="r1"> <label for="username">Username </label></div>
						<div class="r2"> <input type="text" id="username" name="username" placeholder="<?php echo $daten[$i][1]; ?>"></input></div>
					</div>
					
					<div class="row">
						<div class="r1"> <label for="vorname">Vorname </label> </div>
						<div class="r2"> <input type="text" name="vorname" id="vorname" placeholder="<?php echo $daten[$i][2]; ?>"></input></div>
					</div>
					
					<div class="row">
						<div class="r1"> Nachname </div>
						<div class="r2"> <input type="text" name="nachname" id="nachname" placeholder="<?php echo $daten[$i][3]; ?>"></input></div>
					</div>
					
					<div class="row">
						<div class="r1"> E-Mail </div>
						<div class="r2"> <input type="text" name="email" id="email" placeholder="<?php echo $daten[$i][4]; ?>"></input></div>
					</div>
					<div class="row">
						<div class="r3">
							<button class="button login" type="submit">Speichern</button>
						</div>
					</div>
				</form>
			<?php
		} else if($benutzer != 'Gast' && $_GET["save"] == 1){
			$pdo = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', 'aneLX1smurf!');
			if(empty($_POST['username']) && empty($_POST['vorname']) && empty($_POST['nachname']) && empty($_POST['email'])) {
				echo '<p style="font-size: 16pt; margin-left: 2%;"><img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/>Nichts geändert<img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/></p>';
				header( "refresh:2; url=index.php?page=profil" );
			} else {
				$error = false;
				$id = $daten[$i][0];
				
				if( !empty($_POST['username'])){
					$uname = $_POST['username'];
					if(!$error) {
						$statement = $pdo->prepare("SELECT * FROM user WHERE u_uname='$uname'");
						$statement->execute();
						if($statement->fetch() > 0) {
							echo '<p style="color: white; margin-left: 2%; font-size: 16pt;"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Dieser Nutzername ist bereits vergeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
							header( "refresh:2; url=index.php?page=profil" );
							$error = true;
						}
					}
				} else $uname = $daten[$i][1];
				
				if( !empty($_POST['vorname'])){
					$uvname = $_POST['vorname'];
				} else $uvname = $daten[$i][2];

				if( !empty($_POST['nachname'])){
					$unname = $_POST['nachname'];
				} else $unname = $daten[$i][3];
					
				if( !empty($_POST['email'])){
					$uemail = $_POST['email'];
					if(!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
						echo '<p style="color: white; margin-left: 2%; font-size: 16pt;"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Bitte eine gültige E-Mail-Adresse eingeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
						header( "refresh:2; url=index.php?page=profil" );
						$error = true;
					}
					if(!$error) {
						$statement = $pdo->prepare("SELECT * FROM user WHERE u_email='$uemail'");
						$statement->execute();
						if($statement->fetch() > 0) {
							echo '<p style="color: white; margin-left: 2%; font-size: 16pt;"><img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/>Diese E-Mail ist bereits vergeben<img alt="Warnung" src="media/warnung.png" height="40px" width="auto"/></p>';
							header( "refresh:2; url=index.php?page=profil" );
							$error = true;
						}
					}
				} else $uemail = $daten[$i][4];
					
				if(!$error){
					$sql = "UPDATE user SET u_uname='$uname', u_vname='$uvname', u_name='$unname', u_email='$uemail' where u_id = '$id' ";

					if(mysqli_query($connect, $sql)) {
						echo '<p style="font-size: 18pt;"><img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/>Erfolgreich geändert<img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/></p>';
						header( "refresh:1; url=index.php?page=profil" );
						if($session != 'admin'){
							session_destroy();
							session_start();
							$_SESSION['benutzer'] = $uname;
						}
					} else echo'Fehler';
				}
			}
			echo ausgabe($daten[$i]);
		} else {
			echo ausgabe($daten[$i]);
		}
			
			
		if($_GET["edit"] == 0) {
			echo '<div class="row">
					<div class="r3">
						<a href="index.php?page=profil&user='.$benutzer.'&edit=1"><div class="button login">Daten ändern</div></a>
					</div>
				</div>';
		}
	} else {
		$abfrage = "Select u_id, u_uname, u_email, g_name from user INNER JOIN usergroups using(u_id) INNER JOIN groups using (g_id) where u_uname='$publicprofile'";
		$ergebnis = $connect->query($abfrage);
		if($ergebnis->num_rows> 0){
			$row=$ergebnis->fetch_assoc();?>
			
			<img style="position: absolute; margin-top: 1%; margin-left: 82%; border-radius: 75px;" src="<?php 
				if(is_file("shared/$publicprofile/profilbild.png")) echo "shared/$publicprofile/profilbild.png";
				else echo "shared/public/profilbild.png";
			?>" height="150px" width="150px">
			
		<?php
			echo '<div class="row">';
				echo '<div class="r1"> User-ID </div>';
				echo '<div class="r2"> '.$row["u_id"].'</div>';
			echo '</div>';
			
			echo '<div class="row">';
				echo '<div class="r1"> Username </div>';
				echo '<div class="r2"> '.$row["u_uname"].'</div>';
			echo '</div>';

			echo '<div class="row">';
				echo '<div class="r1"> E-Mail </div>';
				echo '<div class="r2"> '.$row["u_email"].'</div>';
			echo '</div>';
				
			echo '<div class="row">';
				echo '<div class="r1"> Gruppe </div>';
				echo '<div class="r2"> '.$row["g_name"].'</div>';
			echo '</div>';
			
			$abfrage = 'SELECT count(t_id) as t_anz FROM threads WHERE t_autor="'.$publicprofile.'"';
			$ergebnis = $connect->query($abfrage);
			echo '<div class="row">';
			echo '<div class="r1"> Threads eröffnet </div>';
			if($ergebnis->num_rows> 0){
				$row=$ergebnis->fetch_assoc();
				echo '<div class="r2"> '.$row["t_anz"].'</div>';
			} else echo '<div class="r2"> --KEINE--</div>';
			echo '</div>';
			
			$abfrage = 'SELECT count(a_id) as a_anz FROM answers WHERE a_autor="'.$publicprofile.'"';
			$ergebnis = $connect->query($abfrage);
			echo '<div class="row">';
			echo '<div class="r1"> Antworten geschrieben </div>';
			if($ergebnis->num_rows> 0){
				$row=$ergebnis->fetch_assoc();
					echo '<div class="r2"> '.$row["a_anz"].'</div>';
			} else echo '<div class="r2"> --KEINE--</div>';
			echo '</div>';
			?>
			<script type="text/javascript">
				document.title = "Black Loyality || Profil von <?=$publicprofile;?>"
			</script>
			<?php
		} else die('<p style="color:white; ">Dieser Nutzer existiert nicht</p>');
	}
	?>
		</div>
	</div>
</div>