<?php
	require_once "../../config.php";
	
	//loome andmebaasiga ühenduse
	//tahab saada server, kasutaja, parool, andmebaas
	$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
	//määran suhtlemiseks kasutatava tabeli
	$conn->set_charset("utf8");

	//valmistame ette andmete saatmise SQL käsu
	$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
	echo $conn->error;
	//seome saadavad andmed muutujatega
	$stmt->bind_result($pealkiri_from_db, $aasta_from_db, $kestus_from_db, $zanr_from_db, $tootja_from_db, $lavastaja_from_db);
	$stmt->execute();
	// kui saan ühe kirja $stmt->fetch();
	/*if(isset->fetch()){
		mis selle ühe kirjega teha
	}*/
	//kui tuleb teadmata arv kirjeid
	$film_html = null;
	while($stmt->fetch()){
		//echo $pealkiri_from_db;
		//<p>aasta, kestus, zanr, tootja, lavastaja </p>
		$film_html .= "<h3>" .$pealkiri_from_db ."</h3>". "<ul>". "<li>" ." Valmimisaasta: " .$aasta_from_db . "</li>". "<li>" ." Kestus: " .$kestus_from_db . " minutit". "</li>". "<li>" ." Žanr: " .$zanr_from_db . "</li>". "<li>" ." Tootja: " .$tootja_from_db . "</li>". "<li>" ." Lavastaja: " .$lavastaja_from_db . "</li>". "</ul>";
	}

	//<h3> $pealkiri_from db ""
?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Filmide nimekiri</title>
</head>

<body>
	<?php echo $film_html ?>

</body>
</html>