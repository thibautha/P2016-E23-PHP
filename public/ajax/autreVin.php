<?php 

// On récupère le nom du von aléatoire affiché
$nomVinActuel = $_GET["nomVinActuel"];

// On se connecte à la base de données
$con = mysqli_connect("localhost","root","","alanotre");
//$bdd = new PDO('mysql:host=preprod.hetic.net;dbname=alanotre', 'alanotre', 'laNOtr3458');

//Requête faite à la base de données 
$query = 'SELECT * FROM userwine ';
// $query = 'SELECT * FROM wine WHERE wine_name!="'.$nomVinActuel.'" ORDER BY RAND() LIMIT 1';

// On récupère les informations sur le vin sous format json
//$results = json_encode($bdd->query($query));
$autreVin = $con->query($query);

echo json_encode($autreVin);

?>