<?php 
	if(!isset($_GET['page'])) die(header("refresh: 0; index.php?page=classes")); 
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	if($g_id != 1) die("<p style='color:white; font-size: 18pt;'>Sie haben nicht die nötigen Rechte, um diese Seite anzusehen</p>");
	  ?>
<script>
	document.getElementById('sidebar').style.display = 'none';
</script>

<div id="reglog">
	<div id="forumback">
		<div id="startnews">
			<a href="index.php?page=classes&create=1"><button id="klassenbutton" style="margin-top: 2%;" class="button answerbutton">Klasse hinzufügen</button></a>
			<a href="index.php?page=classes&delete=1"><button id="klassedelete" style="margin-top: 2%;" class="button answerbutton">Klasse löschen</button></a>
			<a href="index.php?page=classes&edit=1"><button id="klasseedit" style="margin-top: 2%;" class="button answerbutton">Klasse bearbeiten</button></a>
			<a href="index.php?page=classes&add=1"><button id="klasseadd" style="margin-top: 2%;" class="button answerbutton">Schüler hinzufügen</button></a>
			<a href="index.php?page=classes&remove=1"><button id="klasserem" style="margin-top: 2%;" class="button answerbutton">Schüler entfernen</button></a>
			<?php
			$connect = new mysqli('localhost', 'root', 'aneLX1smurf!','user');
			$connect->set_charset("utf8");
			if($_GET["delete"] == 2){
				if($_POST["kname"]){
				$abfrage = 'DELETE FROM klassen WHERE k_id='.$_POST["kname"].'';
				$ergebnis = $connect->query($abfrage);
				echo 'Klasse erfolgreich entfernt';
				header("refresh: 1; index.php?page=classes");
				}
			} else {
				if($_GET["delete"] == 1){
					echo '<div id="antwort">';?>
						<script>
							document.getElementById('klassenbutton').style.display = 'none';
							document.getElementById('klasseadd').style.display = 'none';
							document.getElementById('klasseedit').style.display = 'none';
							document.getElementById('klasserem').style.display = 'none';
							document.getElementById('klassedelete').style.display = 'none';
						</script>
						<form action="index.php?page=classes&delete=2" method="POST">
							<div class="row">
								<div class="r1">Welche Klasse wollen Sie entfernen?</div>
							</div>
							<div class="row">
								<div class="r1"> <label for="kname"> Klasse auswählen </label></div>
								<div class="r2"> 
									<select name="kname">
										<?php
										$abfrage = "SELECT k_id, k_name from klassen";
										$ergebnis = $connect->query($abfrage);
										if($ergebnis->num_rows> 0){
											while($row=$ergebnis->fetch_assoc()) {
												echo '<option value="'.$row["k_id"].'">'.$row["k_name"].'</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="r3">
								<button class="button login" type="submit">Weiter -></button>
							</div>
							</div>
						</form>
						
					<?php
				} else {
					if($_GET["remove"] == 2){
						foreach($_POST["student"] as $student){
							$abfrage = "DELETE FROM userklassen WHERE u_id=$student";
							$ergebnis = $connect->query($abfrage);
						}
						echo 'Schüler erfolgreich entfernt';
						header("refresh: 1; index.php?page=classes");
					} else {
						if($_GET["remove"] == 1){
							echo '<div id="antwort">'; ?>
								<script>
									document.getElementById('klassenbutton').style.display = 'none';
									document.getElementById('klasseadd').style.display = 'none';
									document.getElementById('klasseedit').style.display = 'none';
									document.getElementById('klasserem').style.display = 'none';
									document.getElementById('klassedelete').style.display = 'none';
								</script>
								<form action="index.php?page=classes&remove=2" method="POST">
										<div class="row">
											<div class="r1">Schüler zum entfernen auswählen</div>
										</div>
										<div class="row">
											<div class="r2">
												<?php
												$abfrage = "SELECT u_id, k_id, k_name, u_uname, u_name, u_vname FROM user INNER JOIN userklassen USING (u_id) INNER JOIN klassen USING (k_id)";
												$ergebnis = $connect->query($abfrage);
												if($ergebnis->num_rows> 0){
													echo '________________________________________<br>';
													while($row=$ergebnis->fetch_assoc()) {
														echo '<input type="checkbox" name="student[]" value="'.$row["u_id"].'">Username: '.$row["u_uname"].'<br>Name: '.$row["u_vname"].' '.$row["u_vname"].'<br>Klasse: '.$row["k_name"].'<br>________________________________________</input>';
													}
												}
												?>
											</div>
										</div>
										<div class="r3">
											<button class="button login" type="submit">Weiter -></button>
										</div>
										</div>
									</form> <?php
							echo '</div>';
						} else {
							if($_GET["add"] == 3){
								$klassenid = $_POST["kid"];
								
								foreach($_POST["student"] as $student){
									$abfrage = "SELECT k_id FROM userklassen WHERE u_id = $student";
									$ergebnis = $connect->query($abfrage);
									if($ergebnis->num_rows> 0){
										echo 'Schüler mit der ID '.$student.' ist schon Teil einer anderen Klasse';
										header ("refresh: 1; index.php?page=classes&class=$klassenid");
									} else {
										$abfrage = "INSERT INTO userklassen (u_id, k_id) VALUES ($student, $klassenid)";
										$ergebnis = $connect->query($abfrage);
										echo 'Schüler erfolgreich hinzugefügt';
										header ("refresh: 1; index.php?page=classes&class=$klassenid");
									}
								}
							} else {
								if($_GET["add"] == 2){
									echo '<div id="antwort">';
									$klassenid = $_POST["kname"];
									?>
									<script>
										document.getElementById('klassenbutton').style.display = 'none';
										document.getElementById('klasseadd').style.display = 'none';
										document.getElementById('klasseedit').style.display = 'none';
										document.getElementById('klasserem').style.display = 'none';
										document.getElementById('klassedelete').style.display = 'none';
									</script>
									<form action="index.php?page=classes&add=3" method="POST">
										<div class="row">
											<div class="r1">Schüler auswählen</div>
										</div>
										<div class="row">
											<div class="r2">
												<?php
												$abfrage = "SELECT u_id, u_uname, u_name, u_vname FROM user";
												$ergebnis = $connect->query($abfrage);
												if($ergebnis->num_rows> 0){
													echo '________________________________________<br>';
													while($row=$ergebnis->fetch_assoc()) {
														echo '<input type="checkbox" name="student[]" value="'.$row["u_id"].'">Username: '.$row["u_uname"].'<br>Name: '.$row["u_vname"].' '.$row["u_name"].'<br>________________________________________</input>';
													}
												}
												?>
											</div>
										</div>
										<div class="r3">
											<input type="hidden" name="kid" value="<?= $klassenid ?>"/>
											<button class="button login" type="submit">Weiter -></button>
										</div>
										</div>
									</form>
									
								<?php
								} else {
									if($_GET["add"] == 1){
										echo '<div id="antwort">';?>
										<script>
											document.getElementById('klassenbutton').style.display = 'none';
											document.getElementById('klasseadd').style.display = 'none';
											document.getElementById('klasseedit').style.display = 'none';
											document.getElementById('klasserem').style.display = 'none';
											document.getElementById('klassedelete').style.display = 'none';
										</script>
										<form action="index.php?page=classes&add=2" method="POST">
											<div class="row">
												<div class="r1">Zu welcher Klasse wollen Sie Schüler hinzufügen?</div>
											</div>
											<div class="row">
												<div class="r1"> <label for="kname"> Klasse auswählen </label></div>
												<div class="r2"> 
													<select name="kname">
														<?php
														$abfrage = "SELECT k_id, k_name from klassen";
														$ergebnis = $connect->query($abfrage);
														if($ergebnis->num_rows> 0){
															while($row=$ergebnis->fetch_assoc()) {
																echo '<option value="'.$row["k_id"].'">'.$row["k_name"].'</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="r3">
												<button class="button login" type="submit">Weiter -></button>
											</div>
											</div>
										</form>
										
									<?php
									} else {
										if($_GET["save"] > 0){
											$klassenid = $_GET["save"];
											$kname = $_POST["kname"];
											$klehrer = $_POST["klehrer"];
											$ksprecher = $_POST["ksprecher"];
											
											$abfrage = "SELECT * FROM klassen WHERE k_id=$klassenid";
											$ergebnis = $connect->query($abfrage);
											$row=$ergebnis->fetch_assoc();
											
											$error = FALSE;
											
											if($klehrer != $row["k_klassenlehrer"]){
												$abfrage = "SELECT * FROM klassen WHERE k_klassenlehrer = '$klehrer'";
												$test = $connect->query($abfrage);
												if($test->num_rows> 0){
													$error = TRUE;
												}
											}
											
											if($kname != $row["k_name"]){
												$abfrage = "SELECT * FROM klassen WHERE k_name = '$kname'";
												$test = $connect->query($abfrage);
												if($test->num_rows> 0){
													$error = TRUE;
												}
											}

											if($ksprecher != $row["k_klassensprecher"]){
												$abfrage = "SELECT * FROM klassen WHERE k_klassensprecher = '$ksprecher'";
												$test = $connect->query($abfrage);
												if($test->num_rows> 0){
													$error = TRUE;
												}
											}
											
											if(!$error){
												$abfrage = "UPDATE klassen SET k_name='$kname', k_klassenlehrer='$klehrer', k_klassensprecher='$ksprecher' where k_id = '$klassenid' ";
												if(mysqli_query($connect, $abfrage)) {
													echo 'Klasse erfolgreich bearbeitet';
													header("refresh: 1; index.php?page=classes&class=$klassenid");
												} else {
													echo 'Änderungen konnten nicht übernommen werden';
													header("refresh: 1; index.php?page=classes&class=$klassenid");
												}
											} else {
												echo 'Nichts geändert oder Datensätze doppelt';
												header("refresh: 1; index.php?page=classes&class=$klassenid");
											}
										} else {
											if($_GET["edit"] == 2){
												echo '<div id="antwort">';
												$klassenid = $_POST["kname"];
												$abfrage = "SELECT k_name, k_klassenlehrer, u_uname FROM klassen INNER JOIN user ON klassen.k_klassenlehrer = user.u_id WHERE k_id = $klassenid";
												$ergebnis = $connect->query($abfrage);
												$row=$ergebnis->fetch_assoc();
												
												?>
												<script>
													document.getElementById('klassenbutton').style.display = 'none';
													document.getElementById('klasseadd').style.display = 'none';
													document.getElementById('klasseedit').style.display = 'none';
													document.getElementById('klasserem').style.display = 'none';
													document.getElementById('klassedelete').style.display = 'none';
												</script>
												<form action="index.php?page=classes&save=<?= $klassenid ?>" method="POST">
															
													<div class="row">
														<div class="r1"> 
															<label for="kname"> Name der Klasse </label>
														</div>
														<div class="r2"> 
															<input type="text" id="kname" name="kname" value="<?= $row["k_name"]?>"></input>
														</div>
													</div>
															
													<div class="row">
														<div class="r1">
															<label for="klehrer"> Klassenlehrer </label>
														</div>
														<div class="r2"> 
															<select name="klehrer">
																<option value="<?= $row["k_klassenlehrer"]?>"><?= $row["u_uname"] ?></option>
																<?php
																$abfrage = "SELECT u_id, u_uname FROM user";
																$ergebnis = $connect->query($abfrage);
																
																if($ergebnis->num_rows> 0){
																	while($row=$ergebnis->fetch_assoc()) {
																		echo '<option value="'.$row["u_id"].'">'.$row["u_uname"].'</option>';
																	}
																}
																?>
															</select>
														</div>
													</div>
													
													<div class="row">
														<div class="r1"> <label for="ksprecher"> Klassensprecher </label> </div>
														<div class="r2"> 
															<select name="ksprecher">
																<?php
																$abfrage = "SELECT k_klassensprecher, u_uname FROM klassen INNER JOIN user ON klassen.k_klassensprecher = user.u_id WHERE k_id = $klassenid";
																$ergebnis = $connect->query($abfrage);
																$row=$ergebnis->fetch_assoc();?>
																<option value="<?= $row["k_klassensprecher"]?>"><?php echo $row["u_uname"]; ?></option>
																<?php
																$abfrage = "SELECT u_id, u_uname FROM user";
																$ergebnis = $connect->query($abfrage);
																
																if($ergebnis->num_rows> 0){
																	while($row=$ergebnis->fetch_assoc()) {
																		echo '<option value="'.$row["u_id"].'">'.$row["u_uname"].'</option>';
																	}
																}
																?>
															</select>
														</div>
													</div>
														<div class="r3">
															<button class="button login" type="submit">Änderung übernehmen</button>
														</div>
													</div>
												</form>
												
											<?php
											} else {
												if($_GET["edit"] == 1){
													echo '<div id="antwort">';?>
													<script>
														document.getElementById('klassenbutton').style.display = 'none';
														document.getElementById('klasseadd').style.display = 'none';
														document.getElementById('klasseedit').style.display = 'none';
														document.getElementById('klasserem').style.display = 'none';
														document.getElementById('klassedelete').style.display = 'none';
													</script>
													<form action="index.php?page=classes&edit=2" method="POST">
														
														<div class="row">
															<div class="r1"> <label for="kname"> Klasse auswählen </label></div>
															<div class="r2"> 
																<select name="kname">
																	<?php
																	$abfrage = "SELECT k_id, k_name from klassen";
																	$ergebnis = $connect->query($abfrage);
																	if($ergebnis->num_rows> 0){
																		echo 'test';
																		while($row=$ergebnis->fetch_assoc()) {
																			echo '<option value="'.$row["k_id"].'">'.$row["k_name"].'</option>';
																		}
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="r3">
															<button class="button login" type="submit">Klasse bearbeiten</button>
														</div>
														</div>
													</form>
													
												<?php
												} else {
													$abfrage = "SELECT u_id, u_uname from user";
													$ergebnis = $connect->query($abfrage);
													if($_GET["create"] == 1){
														echo '<div id="antwort">';?>
															<script>
																document.getElementById('klassenbutton').style.display = 'none';
																document.getElementById('klasseadd').style.display = 'none';
																document.getElementById('klasseedit').style.display = 'none';
																document.getElementById('klasserem').style.display = 'none';
																document.getElementById('klassedelete').style.display = 'none';
															</script>
															<form action="index.php?page=classes&success=1" method="POST">
															
															<div class="row">
																<div class="r1"> <label for="kname"> Name der Klasse </label></div>
																<div class="r2"> <input type="text" id="kname" name="kname" placeholder="...AIT18A"></input></div>
															</div>
															
															<div class="row">
																<div class="r1"> <label for="klehrer"> Klassenlehrer </label> </div>
																<div class="r2"> 
																	<select name="klehrer">
																		<?php
																		if($ergebnis->num_rows> 0){
																			while($row=$ergebnis->fetch_assoc()) {
																				echo '<option value="'.$row["u_id"].'">'.$row["u_uname"].'</option>';
																			}
																		}
																		?>
																	</select>
																</div>
															</div>
															
															<div class="row">
																<div class="r1"> <label for="ksprecher"> Klassensprecher </label> </div>
																<div class="r2"> 
																	<select name="ksprecher">
																		<?php
																		$abfrage = "SELECT u_id, u_uname from user";
																		$ergebnis = $connect->query($abfrage);
																		if($ergebnis->num_rows> 0){
																			while($row=$ergebnis->fetch_assoc()) {
																				echo '<option value="'.$row["u_id"].'">'.$row["u_uname"].'</option>';
																			}
																		}
																		?>
																	</select>
																</div>
															</div>
																<div class="r3">
																	<button class="button login" type="submit">Klasse hinzufügen</button>
																</div>
															</div>
														</form>
														<?php
														echo '</div>';
													} else {
														
														if($_GET["success"] == 1){
															$kname = $_POST["kname"];
															$klehrer = $_POST["klehrer"];
															$ksprecher = $_POST["ksprecher"];
															
															if($klehrer == $ksprecher){
																echo 'Der Klassenlehrer kann nicht gleich dem Klassensprecher sein'; ?>
																<script> document.getElementById('klassenbutton').style.display = 'none'; </script> <?php
																die(header("refresh: 2; index.php?page=classes&create=1"));
															}
															
															$abfrage = "SELECT * FROM klassen WHERE k_name = '$kname'";
															$ergebnis = $connect->query($abfrage);
															
															if($ergebnis->num_rows> 0){
																echo 'Der Klassenname ist bereits vergeben'; ?>
																<script> document.getElementById('klassenbutton').style.display = 'none'; </script> <?php
																die(header("refresh: 2; index.php?page=classes&create=1"));
															}
															
															$abfrage = "SELECT * FROM klassen WHERE k_klassensprecher = '$ksprecher'";
															$test = $connect->query($abfrage);
															if($test->num_rows> 0){
																echo 'Der gewählte Klassensprecher ist schon Klassensprecher einer anderen Klasse'; ?>
																<script> document.getElementById('klassenbutton').style.display = 'none'; </script> <?php
																die(header("refresh: 2; index.php?page=classes&create=1"));
															}
															
															$abfrage = "SELECT * FROM klassen WHERE k_klassenlehrer = '$klehrer'";
															$test = $connect->query($abfrage);
															if($test->num_rows> 0){
																echo 'Der gewählte Klassenlehrer ist schon Klassenlehrer einer anderen Klasse'; ?>
																<script> document.getElementById('klassenbutton').style.display = 'none'; </script> <?php
																die(header("refresh: 2; index.php?page=classes&create=1"));
															}
															
															$abfrage = "INSERT INTO klassen (k_name, k_klassenlehrer, k_klassensprecher) VALUES ('$kname','$klehrer','$ksprecher')";
															if($connect->query($abfrage)){
																echo 'Klasse erfolgreich hinzugefügt';
																$abfrage = "SELECT MAX(k_id) AS id FROM klassen";
																$ergebnis = $connect->query($abfrage);
																$row=$ergebnis->fetch_assoc();
																$id = $row["id"];
																$abfrage = "INSERT INTO userklassen (u_id, k_id) VALUES ('$klehrer','$id')";
																$ergebnis = $connect->query($abfrage);
																$abfrage = "INSERT INTO userklassen (u_id, k_id) VALUES ('$ksprecher','$id')";
																$ergebnis = $connect->query($abfrage);
																header("refresh: 1; index.php?page=classes&class=$id");
															} else {
																echo 'Klasse konnte nicht hinzugefügt werden';
																header("refresh: 1; index.php?page=classes&create=1");
															}
														}
														
														$abfrage = "SELECT k_id, k_name FROM klassen";
														$ergebnis = $connect->query($abfrage);
													
														if($ergebnis->num_rows> 0){
															echo '<div id="antwort">';
															while($row=$ergebnis->fetch_assoc()) {
																echo '<a href="index.php?page=classes&class='.$row["k_id"].'"><button class="button menu">'.$row["k_name"].'</button></a>';
															}
															echo '</div>';
														}
														
														if(isset($_GET["class"])){
															$klasse = $_GET["class"];
															$abfrgae = "SELECT k_name FROM klassen WHERE k_id = $klasse";
															$ergebnis = $connect->query($abfrage);
															$name = $ergebnis->fetch_assoc();
															echo '<div id="antwort">';
															echo '<p style="margin-left: 1%; font-size: 18pt;"><b>'.$name["k_name"].'</b></p><p style="margin-left: 1.5%; font-size: 16pt;"><u>Schülerliste:</u></p>';
															$abfrage = "SELECT k_name, k_klassenlehrer, k_klassensprecher, u_id, u_uname FROM klassen INNER JOIN userklassen USING(k_id) INNER JOIN user USING (u_id) WHERE k_id=$klasse";
															$ergebnis = $connect->query($abfrage);
															if($ergebnis->num_rows> 0){
																while($row=$ergebnis->fetch_assoc()) {
																	if($row["u_id"] == $row["k_klassenlehrer"]) echo '<p style="margin-left: 2%; color: red;">'.$row["u_uname"].' (Klassenlehrer)</p>';
																	else if($row["u_id"] == $row["k_klassensprecher"]) echo '<p style="margin-left: 2%; color: yellow;">'.$row["u_uname"].' (Klassensprecher)</p>';
																	else echo '<p style="margin-left: 2%;">'.$row["u_uname"].'</p>';
																}
																echo '</div>';
															}
														}
													
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			?>
		</div>
	</div>
</div>