<?php

$properties = parse_ini_file("connexion.properties");
$protocole = $properties["protocole"];
$serveur = $properties["serveur"];
$port = $properties["port"];
$user = $properties["user"];
$mdp = $properties["mdp"];
$bd = $properties["bd"];
try {
    $db = new PDO("$protocole:host=$serveur;" . "dbname=$bd;charset=utf8", $user, $mdp);
    $db->exec('SET NAMES utf8');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion au serveur.<BR>";
    echo "Site indisponible.<BR>";
    mail("m.riou@mdaparis.fr", "Erreur de connexion", "Erreur de connexion à la BD \n" . $_POST['email'] . "\n"
            . $_POST['nom'] . "\n" . $_POST['prenom'] . "\n" . $_POST['adresse1'] . "\n" . $_POST['adresse2']
            . "\n" . $_POST['code_postal'] . "\n" . $_POST['ville'], "From: admin@ventesclery.fr");
    die('Erreur : ' . $e->getMessage());
}