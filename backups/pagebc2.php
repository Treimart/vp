<?php

	$author_name = "Märten Treier";
	$full_time_now = date("d.m.Y H:i:s");
	$weekday_now = date("N");
	//echo $weekday_now;
	$weekdaynames_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	//echo $weekdaynames_et[$weekday_now - 1];
	$hours_now = date("H");
	//echo $hours_now, väike test;
	$part_of_day = "suvaline päeva osa";
	// < > >= == !=
	if($hours_now < 7 and $weekday_now <= 5){
		$part_of_day = "uneaeg";
	}
	if($hours_now == 7 and $weekday_now <= 5){
		$part_of_day = "kooli minemise aeg";
	}
	if($hours_now >= 8 and $hours_now < 18 and $weekday_now <= 5) {
		$part_of_day = "koolipäev";
	}
	if($hours_now >= 19 and $weekday_now <= 5) {
		$part_of_day = "magama mineku aeg";
	}
	if($hours_now <= 9 and $weekday_now >= 6) {
		$part_of_day = "uneaeg!";
	}
	if($hours_now > 9 and $weekday_now >= 6) {
		$part_of_day = "puhkepäev";
	}
	
	//uurime semitsri kestmist
	$semister_begin = new DateTime("2022-9-5");
	$semester_end = new DateTime("2022-12-18");
	$semester_duration = $semister_begin->diff($semester_end);
	$semester_duration_days = $semester_duration->format("%r%a");
	$from_semester_begin = $semister_begin->diff(new DateTime("now"));
	$from_semester_begin_days = $from_semester_begin->format("%r%a");

	$proverb_pick = rand(0, 4);
	$proverb = ["Iga algus on raske", "Tasa sõuad kaugele jõuad", "Mida varem, seda parem", "Parem hilja kui ei kunagi",  "Kes teisele augu kaevab see ise sinna kukub"];

	
	//echo $weekdaynames_et(mt_rand(0, count($weekdaynames_et) -1));
	
	//juhuslik foto
	$photo_dir = "images";
	//$all_files = scandir($photo_dir);
	//var_dump($all_files);
	$all_files = array_slice(scandir($photo_dir), 2);
	$allowed_photo_types = ["image/jpeg", "image/png"];
	//klassikaline tsükkel
	/*for($i = 0;$i < count($all_files); $i ++) {
		echo $all_files[$i];
	}*/
	$photo_files = [];
	foreach($all_files as $filename){
		//echo $filename;
		$file_info = getimagesize($photo_dir ."/" .$filename);
		//kas on lubatud tüüpide nimekirjas
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($photo_files, $filename);
			}
		}
	}
	
	//var_dump($all_files);
	// img scr="kataloog/fail" alt=tekst">
	$photo_html = '<img src="' .$photo_dir ."/" .$photo_files[mt_rand(0, count($photo_files) -1)] .'"';
	$photo_html .= ' alt="Tallinna pilt">';
	//echo $photo_html;
	
	//vaatame, mida vormis sisestatti
	echo $_POST["todays_ajective_input"];
	$todays_adjective = "Pole midagi sisestatud";
	if(isset($_POST["todays_ajective_input"]) and !empty($_POST["todays_ajective_input"])){
		$todays_adjective = $_POST["todays_ajective_input"];
		
	}
	//Loome ripmenüü valikud
		/*<option value="0">tln_77.JPG</option>
		<option value="1">tln_101.JPG</option>
		<option value="2">tln_120.JPG</option>
		<option value="3">tln_147.JPG</option>
		<option value="4">tln_158.JPG</option> */
	$select_html = '<option value="" selected disabled>Vali Pilt</options>';
	for($i = 0;$i < count($photo_files); $i ++){
		$select_html .= '<option value="' .$i .'">';
		$select_html .= $photo_files[$i];
		$select_html .= "</option>";
	}
	
	if(isset($_POST["photo_select"]) and $_POST["photo_select"] >= 0){
	$comment = $_POST["comment_input"];
	$grade = $_POST["grade_input"];
	
	//tahab saada kasutaja, server, parool, andmebaas
	$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
	//määran suhtlemiseks kasutatava tabeli
	$conn->set_charset("utf8");
	//valmistame ette andmete saatmise SQL käsu
	$stmt = conn->prepare("INSERT_INTO vp_daycomment (comment, grade) values(?,?)");
	echo $conn->error;
	//seome SQL käsu õigete andmetega
	//andmetüübid i - integer	d - decimal		s - string
	$stmt->bind_paran("si", $comment, $grade);
	$stmt->execute();
	//sulgeme käau
	$stmt->close();
	//andmebaasi ühenduse kinni
	$conn->close();
	}
?>
<!DOCTYPE html>
<html lang="et">

<head>
	<meta charset="utf-8">
	<title><?php echo $author_name;?> programmeerib veebi</title>
</head>

<body>
	<img src="https://greeny.cs.tlu.ee/~rinde/vp_2022/vp_banner_gs.png" alt="Lehekülje bänner">
	<h1>Ultimate lehekülg</h1>
	<p>See leht on loodud õppetöö raames ning ei sisalda tõsiselt võetavat sisu!</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee">Tallinna Ülikoolis</a></p>
	<p>Lehekülgje avamise hetk: <?php echo $weekdaynames_et[$weekday_now - 1] .", ". $full_time_now;?></p>
	<p>Praegu on <?php echo $part_of_day;?></p>
	<p>Semestri pikkus on <?php echo $semester_duration_days;?> päeva. See on kestnud juba <?php echo $from_semester_begin_days;?> päeva.</p>
	<p>Kena päeva alguseks on Sulle ka üks vanasõna: <?php echo $proverb[$proverb_pick];?></p>
	<img src="images/tlu_41.jpg" alt="Tallinna Ülikooli hoone">
	<p>Olen kogu oma elu elanud <strong>Tallinnas</strong>, kuid mul on suvekodu ka Hiiumaal. Arvutite kõrval meeldib mulle ka näitlemine.</p>
	<form method="POST">
		<input type="text" id="todays_ajective_input" name="todays_ajective_input" placeholder="Kirjuta siia omadussõna tänase päeva kohta">
		<input type="submit" id="todays_adjective_submit" name="todays_adjective_submit" value="Saada omadussõna!">
	</form>
	<p>Omadussõna tänase päeva kohta: <?php echo $todays_adjective; ?></p>
	<hr>
	<form method="POST">
		<select id="photo_select" name="photo_select" value="Määra foto">
			<?php echo $select_html; ?>
		</select>
		<input type="submit" id="photo_submit" name="photo_submit">
	</form>
	<?php echo $photo_html; ?>
	</hr>
</body>

</html>