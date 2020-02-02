<?php if(!isset($_GET['page'])) die(header("refresh: 0; index.php?page=picupload")); ?>

<div id="home">
<div id="profilleiste">
	<a href="index.php?page=profil&user=<?php echo $_SESSION["benutzer"];?>"><div class="button profil" id="Profilübersichtsbutton">Profilübersicht</div></a>
	<a href="index.php?page=pwchange"><div class="button profil" name="profil2">Passwort ändern</div></a>
    <a href="index.php?page=picupload"><div class="button profil" id="profil4">Profilbild hochladen</div></a>
    <script>
		document.getElementById('profil4').style.backgroundColor = 'rgb(30,30,30)';
		document.title = "Black Loyality || Profilbild hochladen"
	</script>
	<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
		if($g_id == 1){ ?>
		<a href="index.php?page=users"><div class="button profil" name="profil3">Alle User</div></a>
	<?php } ?>
</div>
	<div id="profil">
	<div id="startnews">
		<a href="index.php?page=picupload&delete"><button style="position: absolute; margin-top: 20%; margin-left: 2%;" class="button menu">Profilbild löschen</button></a>
		<form action="index.php?page=picupload&upload" method="post" enctype="multipart/form-data">
			<p style="position: absolute; margin-top: 2%; margin-left: 2%;">Wähle ein Bild zum Hochladen:</p>
			<input style="position: absolute; margin-top: 5%; margin-left: 1%; height: auto; width: 24%;" type="file" name="profilbild" id="profilbild">
			<button style="position: absolute; margin-top: 10%; margin-left: 2%;" class="button menu" type="submit" name="submit">Hochladen</button>
		</form>
		
		<?php
		$user = $_SESSION["benutzer"];
		$zielverzeichnis = "shared/$user/";
		
		if(!is_dir($zielverzeichnis)){
			mkdir($zielverzeichnis);
		}

		$upload = 0;
		$imageFileType = strtolower(pathinfo(basename($_FILES["profilbild"]["name"]),PATHINFO_EXTENSION));
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["profilbild"]["tmp_name"]);
			if($check !== false) {
				$upload = 1;
			} else {
				echo '<p style="position: absolute; margin-top: 11%; margin-left: 18%;">Deine Datei ist kein Bild</p>';
				die(header("refresh: 2; index.php?page=picupload"));
			}
			$datei = "shared/$user/profilbild.png";
			if ($_FILES["profilbild"]["size"] > 5000000) {
				echo '<p style="position: absolute; margin-top: 11%; margin-left: 18%;">Deine Datei überschreitet die maximal zulässige Größe von 5MB</p>';
				die(header("refresh: 3; index.php?page=picupload"));
			}
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				echo '<p style="position: absolute; margin-top: 11%; margin-left: 18%;">Deine Datei befindet sich in einem unzulässigen Format. Erlaubte Formate: .png, .jpg, .jpeg</p>';
				die(header("refresh: 3; index.php?page=picupload"));
			}
			
			if ($upload == 0) {
				echo '<p style="position: absolute; margin-top: 11%; margin-left: 18%;">Dein Bild konnte nicht hochgeladen werden</p>';
				die(header("refresh: 2; index.php?page=picupload"));
			} else {
				if (move_uploaded_file($_FILES["profilbild"]["tmp_name"], $datei)) {
					echo '<p style="position: absolute; margin-top: 11%; margin-left: 18%;">Dein Bild '. basename( $_FILES["profilbild"]["name"]). ' wurde erfolgreich hochgeladen.';
					die(header("refresh: 2; index.php?page=picupload"));
				} else {
					echo '<p style="position: absolute; margin-top: 11%; margin-left: 18%;">Dein Bild konnte nicht hochgeladen werden</p>';
					die(header("refresh: 2; index.php?page=picupload"));
				}
			}
		}
		
		if(isset($_GET["delete"])){
			unlink("shared/$user/profilbild.png");
			echo '<p style="position: absolute; margin-top: 21%; margin-left: 21%;">Dein Bild wurde erfolgreich gelöscht</p>';
			die(header("refresh: 2; index.php?page=picupload"));
		}
		?>
	</div>
	</div>
</div>