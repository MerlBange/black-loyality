<?php
	function abfrage(){
		if ($_SESSION != NULL){
			$user = $_SESSION["benutzer"];
			$pdo = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', 'aneLX1smurf!');
			$statement = $pdo->prepare("SELECT u_id from user where u_uname='$user'");
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$u_id = array($result["u_id"]);
			
			$statement = $pdo->prepare("SELECT g_id from usergroups where u_id='$u_id[0]'");
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$daten = array($result["g_id"]);
			return $daten[0];
		}
	}
	
	function ausgabe($daten = array()){
		if($daten[5] == 1){
			$aktiviert = 'aktiviert';
		} else $aktiviert = 'deaktiviert';
		echo '<div class="row">';
			echo '<div class="r1"> User-ID </div>';
			echo '<div class="r2"> '.$daten[0].'</div>';
		echo '</div>';
			
		echo '<div class="row">';
			echo '<div class="r1"> Username </div>';
			echo '<div class="r2"> '.$daten[1].'</div>';
		echo '</div>';

		echo '<div class="row">';
			echo '<div class="r1"> Vorname </div>';
			echo '<div class="r2"> '.$daten[2].'</div>';
		echo '</div>';
			
		echo '<div class="row">';
			echo '<div class="r1"> Nachname </div>';
			echo '<div class="r2"> '.$daten[3].'</div>';
		echo '</div>';
			
		echo '<div class="row">';
			echo '<div class="r1"> E-Mail </div>';
			echo '<div class="r2"> '.$daten[4].'</div>';
		echo '</div>';
		echo '<div class="row">';
			echo '<div class="r1"> Account aktiviert? </div>';
			echo '<div class="r2"> '.$aktiviert.'</div>';
		echo '</div>';
		echo '<div class="row">';
			echo '<div class="r1"> Gruppe </div>';
			echo '<div class="r2"> '.$daten[6].'</div>';
		echo '</div>';
	}
?>