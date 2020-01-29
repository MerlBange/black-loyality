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