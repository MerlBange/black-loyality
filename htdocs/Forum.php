<?php if(!isset($_GET['page'])) die(header("refresh: 0; index.php?page=forum")); ?>
<script>
	document.getElementById('sidebar').style.display = 'none';
</script>

<div id="reglog">
	<div id="forumback">
		<div id="startnews">
		<?php
			$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
			$connect->set_charset("utf8");
			if(isset($_SESSION['benutzer'])){
				$name = $_SESSION['benutzer'];
			}
			$abfrage = "Select t_id,t_titel,t_datum,t_autor from threads order by t_datum desc";
			$ergebnis = $connect->query($abfrage);
			$i = 0;
			if($ergebnis->num_rows> 0){
				while($row=$ergebnis->fetch_assoc()) { 
					$i++;
					$thread[$i] = array($row["t_titel"],$row["t_datum"],$row["t_autor"], $row["t_id"]);
					$date = date_create($thread[$i][1]);
					$datum = date_format($date, 'd.m.Y');
					echo '<p style="font-size: 14pt; width: 40%;"><b>'.$thread[$i][0].'</b><br><a href="index.php?page=fthread&threadId='.$thread[$i][3].'">mehr...</a></p>
					<p style="font-size: 12pt;"><i>Erstellt am '.$datum.' von <a href="index.php?page=profil&user='.$thread[$i][2].'">'.$thread[$i][2].'</i></a></p>';
				}
			}
		?>
		</div>
	</div>
</div>