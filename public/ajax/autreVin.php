<?php 

// On récupère le nom du von aléatoire affiché
$nomVinActuel = $_GET["nomVinActuel"];

// On se connecte à la base de données
$bdd = mysqli_connect("localhost","alanotre","laNOtr3458","alanotre")

//Requête faite à la base de données 
$query = 'SELECT * FROM wine WHERE wine_name!="'.$nomVinActuel.'" ORDER BY RAND() LIMIT 1 '; 

// On récupère les informations sur le vin 
$results = $bdd->$query;

?>