<div id="wrapper">
<div id="menu">
	<a href="index.php"><div class="button homebutton"><img class="ico" src="media/home.png" /> HOME</div></a>
	
	<?php
	if ($_SESSION == NULL) $benutzer = 'Gast';
		else $benutzer = $_SESSION['benutzer'];
	if (isset($_SESSION['benutzer']) || (!empty($_POST))) echo '<a href="index.php?page=profil&user='.$benutzer.'"><div id="probut" class="button homebutton"><img class="ico" src="media/user.png" /> PROFIL</div></a>';
	if (isset($_SESSION['benutzer']) || (!empty($_POST))) echo '<a href="index.php?page=forum"><div id="forumbutton" class="button homebutton"><img class="ico" src="media/blog.png" /> FORUM</div></a>';
	if ($g_id == 1) { 
	?>
		<a href="index.php?page=Blog"><div class="button homebutton" id="expe"><img class="ico" src="media/blog.png" /> BLOG</div></a>
	<?php
	} 
	?>
	<?php
	if(isset($_SESSION['benutzer']) || (!empty($_POST))){ ?>
		<a href="index.php?page=logout"><div class="button logoutbutton" id="logoutbutton"><img class="ico" src="media/logout.png" /> LOGOUT</div></a>
<?php } ?>
</div>
	