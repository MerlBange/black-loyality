<!DOCTYPE html>
<html>
<head>
	<?php
		include 'classes/functions.php';
		include 'classes/config.php';
		if(isset($_GET['page']) AND isset($dateien[$_GET['page']])) {
			$title = basename($dateien[$_GET['page']], '.php');
		} else $title = 'Startseite';
		session_start();
	?>
	<title>Black Loyality || <?= $title ?></title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="media/style.css">
</head>
<body>
<?php
	$g_id = abfrage();
?>