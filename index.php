<?php

//Fonction d'autoload
function autoload($classname) {
    require $classname.'.php';
}

spl_autoload_register('autoload');


//Création du PDO et du PersonnageManager
include('database.php');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$manager = new NewsManagerPDO($db);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Mini jeu de combat</title>
    <meta charset="utf-8">
</head>

<?
    if (isset($_GET['id'])) {
        $news = $manager->get($_GET['id']);
        echo var_dump($news);
        $news->getAuteur();

        echo '<p>Par '.$news->getAuteur().' le </p>';
        echo '<h2>'.$news->getTitre().'</h2>';
    }