<script>
	document.getElementById('logoutbutton').style.display = 'none';
	document.getElementById('sidebar').style.display = 'none';
	document.getElementById('probut').style.display = 'none';
	document.getElementById('forumbutton').style.display = 'none';
	document.getElementById('class').style.display = 'none';
	document.getElementById('expe').style.display = 'none';
</script>


<?php
	if(isset($_SESSION['benutzer'])){
			echo '<div id="reglog">';
				echo '<div id="startnews">';
					echo '<p style="font-size: 18pt; color: white; text-align: center;">Erfolgreich ausgeloggt</p>
					<p style="font-size: 14pt; color: white; text-align: center;">Du wirst weitergeleitet, falls keine Weiterleitung erfolgt <a href="index.php">bitte hier</a> klicken</p>';
				echo '</div>';
			echo '</div>';
	}
	session_destroy();
	header( "refresh:3; url=index.php" );
?>