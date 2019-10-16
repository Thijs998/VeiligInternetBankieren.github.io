
<html>
<head>
<link rel="stylesheet" href="style2.css" type="text/css">
<title>Contact</title>
</head>
<div class="background4">
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
<li><a href=".html">Contact/Reactie</a></li>
<li><a href="reacties.php">Eerdere reacties</a></li>
</nav>
<div class="tekst4">
<body>
<table>
<?php

	$db = new PDO('mysql:host=localhost;dbname=reacties', 'root', '');
	
	//selecteert alle reacties met naam en e-mailadres van de auteur
	$query = 	"SELECT reacties.id, personen.naam, personen.email, reacties.reactie, reacties.datum 
				FROM personen, reacties 
				WHERE reacties.persoon_id = personen.id 
				ORDER BY reacties.datum";
	$result = $db->query($query);
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td><h5>Van: <h5><a href='mailto:" . $row["email"] . "'>" . $row["naam"] . "</a></td>
			  <td><h5>Op:<h5> " . $row["datum"]  . "</td></tr>\n";
		echo "<h4><tr><td colspan='2'><h4>" . $row["reactie"]  . "</td></tr>\n";
		echo "<tr><td colspan='2'>&nbsp;</td></tr>\n";   
		echo "<tr><td colspan='2'><a href='verwijder.php?reactie_id=" . $row["id"]  . "'>
        <h5>Verwijder<h5></a></td></tr>\n";
	}
?>
</table>
</body>
</div>
<footer>
Thijs Vries &copy; 2018
</footer>
</div>


