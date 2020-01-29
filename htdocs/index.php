<?php
include 'classes/header.php';
include 'classes/footer.php';
include 'classes/menue.php';
include 'classes/sidebar.php';
	if(isset($_GET['page']) AND isset($dateien[$_GET['page']])) {
		if(!file_exists($dateien[$_GET['page']])) echo "Error 404";
			include $dateien[$_GET['page']]; 
		} else {
			include 'classes/connect.php';
			echo '<div id="home">';
				include $dateien['startseite'];
			echo '</div>';
			}
?>