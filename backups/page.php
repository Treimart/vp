<?php
	$author_name = "Märten Treier";
	$full_time_now = date("d.m.Y H:i:s");
	$weekday_now = date("N");
	//echo $weekday_now;
	$weekdaynames_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	//echo $weekdaynames_et[$weekday_now - 1];
	$hours_now = date("H");
	//echo $hours_now;
	$part_of_day = "suvaline päeva osa";
	// < > >= == !=
	if($hours_now < 7){
		$part_of_day = "uneaeg";		
	}
	if($hours_now >= 8 and $hours_now < 18) {
		$part_of_day = "koolipäev";
	}
	
	//uurime semitsri kestmist
	$semister_begin = new DateTime("2022-9-5");
	$semester_end = new DateTime("2022-12-18");
	$semester_duration = $semister_begin->diff($semester_end);
	$semester_duration_days = $semester_duration->format("%r%a");
	$from_semester_begin = $semister_begin->diff(new DateTime("now"));
	$from_semester_begin_days = $from_semester_begin->format("%r%a");
	
	//echo $weekdaynames_et(mt_rand(0, count($weekdaynames_et) -1));
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
	<p>Lehekülgje avamise hetk: <?php echo $weekdaynames_et[$weekday_now - 1] .", ". $full_time_now;?></p>
	<p>Praegu on <?php echo $part_of_day;?></p>
	<p>Semestri pikkus on <?php echo $semester_duration_days;?> päeva. See on kestnud juba <?php echo $from_semester_begin_days;?> päeva.</p>
	<p>See leht on loodud õppetöö raames ning ei sisalda tõsiselt võetavat sisu! Eks näe, mis siit välja kujuneb.</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee">Tallinna Ülikoolis</a></p>
	<img src="images/tlu_41.jpg" alt="Tallinna Ülikooli hoone">
	<p>Olen kogu oma elu elanud <strong>Tallinnas</strong>, kuid mul on suvekodu ka Hiiumaal. Arvutite kõrval meeldib mulle ka näitlemine, kuid üldiselt mul väga palju hobisid ei ole. Enamasti proovin jääda salapäraseks, kellest väga palju ei teata.</p>
	<p>Jätkan siit oma lehekülje arendamisega!</p>
</body>

</html>