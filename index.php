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
    <title>POO PHP - TP3 - News</title>
    <meta charset="utf-8">
</head>

<br/><a href="admin.php">Accéder à l'espace d'administration</a>

<?
    if (isset($_GET['id'])) {
        $news = $manager->get($_GET['id']);

        echo '<p>Par <em'.$news->getAuteur().'</em> le '.($news->getDateajout())->format('d/m/Y à H:i:s').'</p>';
        echo '<h2>'.$news->getTitre().'</h2>';
        echo '<p>'.htmlspecialchars(nl2br($news->getContenu())).'</p>';
    }