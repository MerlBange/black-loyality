<script>
	document.getElementById('sidebar').style.display = 'none';
</script>

<div id="reglog">
	<div id="forumback">
		<div id="startnews">
		<?php
			error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
			$tid = $_GET["threadId"];
			$edit = $_GET["edit"];
			$delete = $_GET["delete"];
			$autor = $_SESSION["benutzer"];
		?>
		<a href="index.php?page=fthread&threadId=<?php echo $tid;?>&edit=answer"><div id="answerbutton" class="button answerbutton"><img class="ico" src="media/edit.png" /> ANTWORTEN</div></a>
		<?php
			$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
			$connect->set_charset("utf8");
			$abfrage = "Select t_titel,t_inhalt,t_datum,t_autor from threads where t_id='$tid'";
			$ergebnis = $connect->query($abfrage);
			
			if($ergebnis->num_rows> 0){
				while($row=$ergebnis->fetch_assoc()) { 
					$thread[$i] = array($row["t_titel"],$row["t_inhalt"],$row["t_datum"],$row["t_autor"]);
					$date = date_create($thread[$i][2]);
					$datum = date_format($date, 'd.m.Y');
					echo '<p style="font-size: 22pt; border-bottom: solid; width: 96%;"><b>'.$thread[$i][0].'</b></p>
						<p style="font-size: 16pt;">'.$thread[$i][1].'</p>
						<p style="font-size: 13pt;"><i>Erstellt am '.$datum.' von <a href="index.php?page=profil&user='.$thread[$i][3].'">'.$thread[$i][3].'</i></a></p>';
					if($edit == 'answer'){ ?>
						<script>
							document.getElementById('answerbutton').style.display = 'none';
						</script>
						<div id="antwort">
						<form action="index.php?page=fthread&threadId=<?php echo $tid;?>&edit=send" method="POST">
						<p style="text-align: center; font-size: 16pt;"><u>Antwort verfassen</u></p>
						<div class="row">
							<div class="r1">
								<input type="text" name="antwort" placeholder="Ihre Antwort...">
							</div>
							<div class="r2">
								<button class="button menu" type="submit">Antwort senden</button>
							</div>
						</div>
						</form>
						<div class="r5">
							<a href="index.php?page=fthread&threadId=<?php echo $tid;?>" method="POST"><button class="button answerbutton">Abbruch</button></a>
						</div>
						</div>
					<?php
					}
				}
			}
			?>
			<script type="text/javascript">
				document.title = "Black Loyality || <?=$thread[$i][0];?>"
			</script>
			<?php
			$abfrage = "Select a_inhalt,a_datum, a_autor, a_id, t_id from answers where t_id='$tid' order by a_datum desc";
			$ergebnis = $connect->query($abfrage);
			
			if($ergebnis->num_rows> 0){
				while($row=$ergebnis->fetch_assoc()) { 
					$answer[$i] = array($row["a_inhalt"],$row["a_datum"],$row["a_autor"],$row["a_id"]);
					$date = date_create($answer[$i][1]);
					$datum = date_format($date, 'd.m.Y - H:i');
					echo '<div id="antwort"><p style="margin-left: 5.5%; margin-top: 1.75%"><b>Antwort von <a href="index.php?page=profil&user='.$answer[$i][2].'"><style="color: red;">'.$answer[$i][2].'</style></b></a></p>';
					$user = $answer[$i][2];
					?>
					<a href="index.php?page=profil&user=<?php echo $user ?>">
					<img style="position: absolute; margin-top: -3.75%; margin-left: 1%; border-radius: 25px;" src="<?php 
					if(is_file("shared/$user/profilbild.png")) echo "shared/$user/profilbild.png";
					else echo "shared/public/profilbild.png";
					?>" height="50px" width="50px"></a>
					<?php
					echo '
					<p style="margin-left: 1%; font-size: 16pt; width: 96%; margin-top: 2%;">'.$answer[$i][0].'</p>
					<p style="margin-left: 1%; font-size: 13pt;"><i>Geantwortet am '.$datum.'</i></p>';
					if($answer[$i][2] == $autor){
						echo '<a href="index.php?page=fthread&threadId='.$tid.'&delete='.$answer[$i][3].'"><button style="position: absolute; bottom: 8%; margin-right: -1%;" class="button deletebutton">Beitrag löschen</button></a></div>';
					} else echo '</div>';
				}
			}
				
			
			
			if($edit == 'send'){
				$antwort = $_POST["antwort"];
				$timestamp = time();
				$date = date("d-m-Y H:i:s", $timestamp);
				$abfrage = "INSERT INTO answers (t_id, a_inhalt, a_datum, a_autor) VALUES ('$tid','$antwort','$date','$autor')";
				if($connect->query($abfrage)){
					header("refresh:0; url=index.php?page=fthread&threadId=$tid" );
				}
			}
			if($delete > 0){
				$abfrage = "SELECT a_autor FROM answers WHERE a_id='$delete'";
				$ergebnis = $connect->query($abfrage);
				if($ergebnis->num_rows> 0){
					$row=$ergebnis->fetch_assoc();
					if($autor == $row["a_autor"]){
						$abfrage = "DELETE FROM answers WHERE a_id='$delete'";
						if($connect->query($abfrage)){
							echo '<p style="position: absolute; margin-left: 35%; margin-top: -10%; box-shadow: 0 10px 10px rgba(225, 0, 4, 0.5); z-index: 3; background-color: #1C1C1C; color: red; padding: 5% 3%;">Antwort erfolgreich gelöscht</p>';
							header("refresh:2; url=index.php?page=fthread&threadId=$tid" );
						} else {
							echo '<p style="position: absolute; margin-left: 35%; margin-top: -10%; box-shadow: 0 10px 10px rgba(225, 0, 4, 0.5); z-index: 3; background-color: #1C1C1C; color: red; padding: 5% 3%;">Antwort konnte nicht gelöscht werden</p>';
							header("refresh:2; url=index.php?page=fthread&threadId=$tid" );
						}
					} else {
						echo '<p style="position: absolute; margin-left: 35%; margin-top: -10%; box-shadow: 0 10px 10px rgba(225, 0, 4, 0.5); z-index: 3; background-color: #1C1C1C; color: red; padding: 5% 3%;">Du hast keinen Zugriff auf diese Antwort</p>';
						header("refresh:2; url=index.php?page=fthread&threadId=$tid" );
					}
				} else {
					echo '<p style="position: absolute; margin-left: 35%; margin-top: -10%; box-shadow: 0 10px 10px rgba(225, 0, 4, 0.5); z-index: 3; background-color: #1C1C1C; color: red; padding: 5% 3%;">Du hast keinen Zugriff auf diese Antwort</p>';
					header("refresh:2; url=index.php?page=fthread&threadId=$tid" );
				}
			}
		?>
		</div>
	</div>
</div>