<?php

require ('autoload.php');

//Création du NewsManager
$manager = new NewsManagerMySQLi(DBFactory::getDBConnexionMySQLi());
?>


<!DOCTYPE html>
<html>
<head>
    <title>POO PHP - TP3 - News</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css"/>
</head>

<br/><a href="admin.php">Accéder à l'espace d'administration</a>

<?php
    if (isset($_GET['id'])) {
        $news = $manager->get($_GET['id']);

        echo '<p>Par <em>' . htmlspecialchars($news->getAuteur()) . '</em> le ' . ($news->getDateajout())->format('d/m/Y à H:i:s') . '</p>';
        echo '<h2>' . htmlspecialchars($news->getTitre()) . '</h2>';
        echo '<p>' . htmlspecialchars(nl2br($news->getContenu())) . '</p>';
    } else {
        ?>
        <h1 id="main-title"> Liste des 5 dernières news </h1>
        <?php
        $newsList = $manager->getList(5);

        foreach ($newsList as $news) {
            echo '<div id="'.$news->getId().'"><a href="?id=' . $news->getId().'">' . htmlspecialchars($news->getTitre()) . '</a><p>';

            if (strlen($news->getContenu()) >= 200) {
                echo nl2br(htmlspecialchars(substr($news->getContenu(), 0,200))) . ' [...]';
            } else {
                echo nl2br(htmlspecialchars($news->getContenu()));
            }

            echo '</p></div>';
        }
    }
?>