<div id="home">
	<div id="news_start">
		<div id="startnews">
			<?php
			error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
			if($g_id != 1) die("Sie haben nicht die nötigen Rechte, um diese Seite anzusehen");
			else { ?>
				<p style="font-size: 20pt; text-align: center;">Beitrag hinzufügen</p>
				
				<form action = "index.php?page=Blog&send=success" method = "post">
						<div class="row">
							<div class="r1">
								<label for="headline">Überschrift</label>
							</div>
							<div class="r2">
								<input type="text" name="headline" required placeholder="Bsp. Update Version X.X">
							</div>
						</div>
						<div class="row">
							<div class="r1">
								<label for="content">Inhalt</label>
							</div>
							<div class="r2">
								<textarea class="blog" name="content" required placeholder="Inhalt des Artikels"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="r5">
								<button type="submit" class="button menu">Hinzufügen</button>
							</div>
						</div>
				</form>
				
				<?php
				if($_GET["send"] == 'success'){
					$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
					$connect->set_charset("utf8");
					$headline = $_POST['headline'];
					$content = $_POST['content'];
					$autor = $_SESSION["benutzer"];
					$date = date("Y-m-d");

					$sql = "INSERT INTO news (n_eintrag, n_text, n_autor, n_datum) VALUES ('$headline','$content','$autor','$date')";
					if($connect->query($sql)){
						echo '<p style="font-size: 16pt; margin-left: 2%;"><img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/>
								Beitrag erfolgreich hinzugefügt<img alt="Warnung" src="media/warnung.png" height="30px" width="auto"/></p>';
						header( "refresh:1; url=index.php?page=Blog" );
					}
				}
			}
		?>
		</div>
	</div>
</div>