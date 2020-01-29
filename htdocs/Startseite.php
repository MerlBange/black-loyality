<div id="news_start">
	<div id="startnews">
		<p style="text-align: center; font-size: 20pt; 	color: white; border-bottom: solid; width: 95%;">Aktuelle News</p>
		<?php
			if(isset($_SESSION['benutzer'])){
				$name = $_SESSION['benutzer'];
			}
			$i = 0;
			$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
			$connect->set_charset("utf8");
			$abfrage = "Select n_eintrag,n_datum,n_autor from news order by n_datum desc";
			$ergebnis = $connect->query($abfrage);
			if($ergebnis->num_rows> 0){
				while($row=$ergebnis->fetch_assoc()) { 
					$i++;
					$news[$i] = array($row["n_eintrag"],$row["n_datum"],$row["n_autor"]);
					$date = date_create($news[$i][1]);
					$datum = date_format($date, 'd.m.Y');
					echo '<p style="font-size: 14pt; width: 40%;"><b>'.$news[$i][0].'</b><br><a href="index.php?page=news&title='.$news[$i][0].'">mehr...</a></p>
					<p style="font-size: 12pt;"><i>Verfasst am '.$datum.' von '.$news[$i][2].'</i></p>';
				}
			}
		?>
	</div>
</div>