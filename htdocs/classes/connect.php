<?php
	$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
	$connect->set_charset("utf8");
	if(!isset($_SESSION['benutzer'])) {
		$username = 'Gast';
		$password = '';
	}
	if (!empty($_POST) ) {
		$username= $_POST['username'];
		$password= md5($_POST['password']);
	}
	if(!isset($_SESSION['benutzer'])) {
		$sql="select u_uname, u_activated from user where u_uname='$username' and u_password='$password'";
		$result= $connect->query($sql);

		if($result->num_rows> 0){
			$row=$result->fetch_assoc();
			if($username != 'Gast' && $row["u_activated"] == 1) {
				$_SESSION['benutzer'] = $username;
				header( "refresh:0; url=index.php" );
			} 
			if($row["u_activated"] == 0){ ?>
				<script>
					document.getElementById('logoutbutton').style.display = 'none';
					document.getElementById('sidebar').style.display = 'none';
					document.getElementById('probut').style.display = 'none';
					document.getElementById('forumbutton').style.display = 'none';
					document.getElementById('expe').style.display = 'none';
					document.getElementById('class').style.display = 'none';
				</script>
				<?php
				echo '<div id="reglog">';
					echo '<div id="startnews">';
						echo '<p style="font-size: 18pt; color: white; text-align: center;">Dein Benutzeraccount wurde noch nicht aktiviert.
						<br>Bei Fragen oder Unklarheiten, melde dich bei einem Admin im TS</p>
						<p style="font-size: 14pt; color: white; text-align: center;">Du wirst weitergeleitet, falls keine Weiterleitung erfolgt <a href="index.php">bitte hier</a> klicken</p>';
					echo '</div>';
				echo '</div>';
				die(header( "refresh:5; url=index.php" ));
			}
		} else {
				?>
				<script>
					document.getElementById('logoutbutton').style.display = 'none';
					document.getElementById('sidebar').style.display = 'none';
					document.getElementById('probut').style.display = 'none';
					document.getElementById('forumbutton').style.display = 'none';
					document.getElementById('expe').style.display = 'none';
					document.getElementById('class').style.display = 'none';
				</script>
				<?php
				echo '<div id="reglog">';
					echo '<div id="startnews">';
						echo '<p style="font-size: 18pt; color: white; text-align: center;">Benutzername oder Passwort falsch</p>
						<p style="font-size: 14pt; color: white; text-align: center;">Du wirst weitergeleitet, falls keine Weiterleitung erfolgt <a href="index.php">bitte hier</a> klicken</p>';
					echo '</div>';
				echo '</div>';
				die(header( "refresh: 3; url=index.php" ));
				}
	}
?>