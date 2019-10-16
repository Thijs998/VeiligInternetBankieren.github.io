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

<body>
<?php
// Controleert of we daadwerkelijk een geheel getal hebben binnen gekregen
if ( isset($_GET['reactie_id']) && filter_var($_GET['reactie_id'], FILTER_VALIDATE_INT )){
	$reactie_id = $_GET['reactie_id'];

	// maakt verbinding met de database
	$db = new PDO('mysql:host=localhost;dbname=reacties', 'root', '');
	//maakt verwijderen van reactie mogelijk
	$query = "DELETE FROM reacties WHERE id = ? ";
	$stmt = $db->prepare($query);
	$stmt->execute(array($reactie_id));
	echo '<h4>De reactie is verwijderd!<h4><br  />';
	//geeft mogelijkheid om terug te gaan
	echo 'Ga terug naar de <a href="reacties.php">reacties</a>.<br />';

} else {
	//als er niks verwijderd is
	echo "<h4>Ongeldige aanvraag<h4>";
	echo 'Ga terug naar de <a href="reacties.php">reacties</a>.<br />';
}
?>
</body>
</div>
<footer>
Thijs Vries &copy; 2018
</footer>
</div>

