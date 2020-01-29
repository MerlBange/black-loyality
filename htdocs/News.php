<script>
	document.getElementById('sidebar').style.display = 'none';
</script>

<div id="reglog">
	<div id="news_start">
		<div id="startnews">
		<?php 
			$nid = $_GET["title"];
			$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
			$connect->set_charset("utf8");
			$abfrage = "Select n_eintrag,n_text,n_datum,n_autor from news where n_eintrag='$nid'";
			$ergebnis = $connect->query($abfrage);
			if($ergebnis->num_rows> 0){
				while($row=$ergebnis->fetch_assoc()) { 
					$i = 1;
					$news[$i] = array($row["n_eintrag"],$row["n_text"],$row["n_datum"],$row["n_autor"]);
					$date = date_create($news[$i][2]);
					$datum = date_format($date, 'd.m.Y');
					echo '<p style="font-size: 22pt; border-bottom: solid; width: 96%;"><b>'.$news[$i][0].'</b></p>
					<p style="font-size: 16pt;">'.$news[$i][1].'</p>
					<p style="font-size: 13pt;"><i>Verfasst am '.$datum.' von '.$news[$i][3].'</i></p>';
				}
			}
		?>
		</div>
	</div>
</div>