<div id="sidebar">
	<?php
	$break = 1;
	if(isset($_SESSION['benutzer']) || (!empty($_POST))){ ?>
		<p style="text-align: center; font-size: 20pt; color: white;">Statistik</p>
		<?php
		$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
		$connect->set_charset("utf8");
		if($abfrage = $connect->query("Select u_id from user")){
			$anzahl = $abfrage->num_rows;
			$anzahl = $anzahl;
			echo '<p style="color: white; margin-left: 5%;">Anzahl Registrierter User: '.$anzahl.'</p>';
		}
		
		if($abfrage = $connect->query("SELECT t_id FROM threads")){
			$anzahl = $abfrage->num_rows;
			$anzahl = $anzahl;
			echo '<p style="color: white; margin-left: 5%;">Anzahl eröffneter Threads: '.$anzahl.'</p>';
		}
		
		if($abfrage = $connect->query("SELECT a_id FROM answers")){
			$anzahl = $abfrage->num_rows;
			$anzahl = $anzahl;
			echo '<p style="color: white; margin-left: 5%;">Anzahl Antworten: '.$anzahl.'</p>';
		}
		
		$user = $_SESSION["benutzer"];
		
		$abfrage = "SELECT u_id FROM user WHERE u_uname = '$user'";
		$ergebnis = $connect->query($abfrage);
		$row = $ergebnis->fetch_assoc();
		$id = $row["u_id"];
		
		$abfrage = "SELECT k_id FROM userklassen WHERE u_id = '$id'";
		$ergebnis = $connect->query($abfrage);
		$row = $ergebnis->fetch_assoc();
		$kid = $row["k_id"];
		
		$abfrage = "SELECT k_name FROM klassen WHERE k_id = '$kid'";
		$ergebnis = $connect->query($abfrage);
		$row = $ergebnis->fetch_assoc();
		$klasse = $row["k_name"];
		echo '<br><p style="color: white; text-align: center;"><b>Deine Klasse: '.$klasse.'</b></p>';
		
		$abfrage = "SELECT k_name, k_klassenlehrer, k_klassensprecher, u_id, u_uname FROM klassen INNER JOIN userklassen USING(k_id) INNER JOIN user USING (u_id) WHERE k_id=$kid ORDER BY u_id DESC";
		$ergebnis = $connect->query($abfrage);
		if($ergebnis->num_rows> 0){
			while($row = $ergebnis->fetch_assoc()){
				if($row["u_id"] == $row["k_klassenlehrer"]) echo '<a href="index.php?page=profil&user='.$row["u_uname"].'"><p style="margin-left: 2%; color: red;">'.$row["u_uname"].'</a> (Klassenlehrer)</p>';
				else if($row["u_id"] == $row["k_klassensprecher"]) echo '<a style="color: yellow;" href="index.php?page=profil&user='.$row["u_uname"].'"><p style="margin-left: 2%; color: yellow;">'.$row["u_uname"].'</a> (Klassensprecher)</p>';
				else echo '<a style="color: white;"href="index.php?page=profil&user='.$row["u_uname"].'"><p style="margin-left: 2%; color: white;">'.$row["u_uname"].'</a></p>';
			}
		}
		$break = 0; 
	}
	
	if($break != 0){?>
		<form action = "index.php" method = "post">
			<p style="text-align: center; color: white;">Login</p>
			<div class="row">
				<div class="r1">
					<label for="username">Nutzername</label>
				</div>
				<div class="r2">
					<input type="text" name="username" required placeholder="Benutzername">
				</div>
			</div>
			<div class="row">
				<div class="r1">
					<label for="password">Passwort</label>
				</div>
				<div class="r2">
					<input type="password" id="pass" name="password" minlength="8" required placeholder="Passwort">
				</div>
			</div>
			<div class="row">
				<div class="r3">
					<button class="button login" type="submit">Login</button>
				</div>
				</form>
				<div class="r4">
					<a href="index.php?page=register&send=0"><div class="button login">Registrieren</div></a></p>
				</div>
			</div>
	<?php } ?>
</div>