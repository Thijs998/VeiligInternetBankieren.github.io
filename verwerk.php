
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style2.css" type="text/css">
<title>Contact</title>
</head>
<div class="background1">
<div class="naam">
<header>
<h2>Hoe veilig is internetbankieren?</h2>
</header>
<div class="navbar">
<nav>
<ul>
<li><a href="index.html">Home</a></li>
<li><a href="2.html">Internetbankieren</a></li>
<li>Risico's
<ul>
<li><a href="9.html">Phishing</a></li>
<li><a href="10.html">Pharming</a></li>
<li><a href="11.html">Trojaanse paarden</a></li>
</ul>
<li><a href="5.html">Beveiliging banken</a></li>
<li>Problemen
<ul>
<li><a href="7.html">Storingen</a></li>
<li><a href="8.html">Laaggeletterden</a></li>
</ul>
<li><a href="4.html">Veilig bankieren</a></li>
<li><a href="form.html">Contact/Reactie</a></li>
<li><a href="reacties.php">Eerdere reacties</a></li>
</nav>
<div class="tekst6">
<h3> Contact <h3>
<h4> Wie ben ik? <h4>
<p> Ik ben Thijs Vries, ik woon in Zwolle en heb deze site gemaakt om mensen te informeren over (veilig) internetbankieren. <p>
<h4> Contact opnemen <h4>
<p> Mocht u contact met mij willen opnemen dat kunt u dat doen door een mail te sturen naar het volgende adres: <p> <h5> Thijs.vries123@gmail.com <h5> <p> Mocht u een reactie willen achterlaten dan kan dat hieronder: <p>
<body>
U vulde in:
<table>
<?php
//gaat er vanuit dat het formulier goed is ingevuld
$correct = true;

//Slaat de waarde van het veld naam op in een variabele
if(isset($_POST['naam']) && $_POST['naam'] != ''){
	$naam = filter_var($_POST['naam'], FILTER_SANITIZE_STRING);
	echo "<tr><td>Naam: </td><td>" . $naam  . "</td></tr>\n";
}else{
	echo "<tr><td>Naam: </td><td><em>Vul een naam in!</em></td></tr>\n";
	$correct = false; // Is toch niet goed ingevuld
}

//Slaat de waarde van het veld e-mail op in een variabele
if ( isset($_POST['email'])  && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
	$email = $_POST['email'];
	echo "<tr><td>E-mail: </td><td>" . $email . "</td></tr>\n";
}else{
	echo "<tr><td>E-mail: </td><td><em>Vul een geldig e-mailadres in!</em></td></tr>\n";
	$correct = false; //Toch een foute waarde
}

//Sla de waarde van het veld reactie op in een variabele
$reactie = $_POST['reactie'] ;
if(isset($_POST['reactie']) && $_POST['reactie'] != ''){
	$reactie = filter_var($_POST['reactie'], FILTER_SANITIZE_STRING);
	echo "<tr><td>Reactie: </td><td>" . $reactie . "</td></tr>\n";
}else{
	echo "<tr><td>Reactie: </td><td><em>Geef een reactie!</em></td></tr>\n";
	$correct = false; //Toch een foute waarde
}

?>
</table>
<?php
//Controleert of alles goed is in gevuld
if($correct){
	$db = new PDO('mysql:host=localhost;dbname=reacties', 'root', '');

	//kijkt of een persoon al bestaat
	$query = "SELECT id FROM personen WHERE naam = ? AND email = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array( $naam, $email));	
	
	if ($stmt->rowCount() > 0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$persoon_id	= $row['id'];
	} else { //voegt de naam en e-mail toe in de tabel personen
		$query = "INSERT INTO personen(naam, email) VALUES (?, ?)";
		$stmt = $db->prepare($query);
		$stmt->execute(array( $naam, $email));	
		
		//vraagt de id van de nieuwe persoon op
		$persoon_id = $db->lastInsertId();
	}

	// voegt de reactie toe in de tabel reacties. Gebruikt de id van de zojuist toegevoegde persoon
	$query = "INSERT INTO reacties(persoon_id, reactie, datum) VALUES (?, ?, ?)";
	$stmt = $db->prepare($query);
	$stmt->execute(array( $persoon_id, $reactie, date('Y-m-d H:i:s')));	

	echo "<br /><br />Bovenstaande informatie is opgeslagen!<br />\n";
	echo 'Zie hier de  <a href="reacties.php">reacties</a>.<br />';
} else {
	//ergens is een foute waarde ingevoerd, geeft de bezoeker de mogelijkheid om terug te gaan
	echo "<br /><br />Er is een foute waarde ingevoerd, <a href=\"javascript:history.back();\">ga terug</a>.<br />\n";
}
?>
</body>
</div>
<footer>
Thijs Vries &copy; 2018
</footer>
</div>

