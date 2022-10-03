<?php
	require_once "../config.php";
	
	//loome andmebaasiga ühenduse
	//tahab saada kasutaja, server, parool, andmebaas
	$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
	//määran suhtlemiseks kasutatava tabeli
	$conn->set_charset("utf8");

	//valmistame ette andmete saatmise SQL käsu
	$stmt = $conn->prepare("SELECT comment, grade, added FROM VP_daycomment");
	echo $conn->error;
	//seome saadavad andmed muutujatega
	$stmt->bind_result($comment_from_db, $grade_from_db, $added_from_db);
	$stmt->execute();
	// kui aaan ühe kirja $stmt->fetch();
	/*if(isset->fetch()){
		mis selle ühe kirjega teha
	}*/
	//kui tuleb teadmata arv kirjeid
	$comment_html = null;
	while($stmt->fetch()){
		//echo $comment_from_db;
		//<p>Kommentaar, hinne päevale 6, </p>
		$comment_html .= "<p>" .$comment_from_db .". hinne päevale " .$grade_from_db;
		$comment_html .= ". lisatud " .$added_from_db .".</p>";
	}
?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Märten Treieri programmeeritud veeb</title>
</head>
<body>
	<img src="https://greeny.cs.tlu.ee/~rinde/vp_2022/vp_banner_gs.png" alt="Lehekülje bänner">
</body>

<body>
<h1>Ultimate lehekülg</h1>
<p>See leht on loodud õppetöö raames ning ei sisalda tõsiselt võetavat sisu! Eks näe, mis siit välja kujuneb.</p>
<p>Õppetöö toimus <a href="https://www.tlu.ee">Tallinna Ülikoolis</a></p>
<p>Olen kogu oma elu elanud <strong>Tallinnas</strong>, kuid mul on suvekodu ka Hiiumaal. Arvutite kõrval meeldib mulle ka näitlemine, kuid üldiselt mul väga palju hobisid ei ole. Enamasti proovin jääda salapäraseks, kellest väga palju ei teata.</p>
	<p>Jätkan siit oma lehekülje arendamisega!</p>
<?php echo $comment_html ?>

</body>
</html>