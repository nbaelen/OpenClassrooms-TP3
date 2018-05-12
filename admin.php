<?php

//Fonction d'autoload
function autoload($classname) {
    require $classname.'.php';
}

spl_autoload_register('autoload');


//Création de PDO et de NewsManager
include('database.php');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$manager = new NewsManagerPDO($db);
?>


<!DOCTYPE html>
<html>
<head>
    <title>POO PHP - TP3 - News</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<br/><a href="index.php">Accéder à l'accueil du site</a>

<div id="whole-page">

<?php
    if (isset($_GET['modifier'])) {
        $newsSelect = $manager->get((int) $_GET['modifier']);
        ?>
        <form action="admin.php" method="post">
            <label for="auteur">Auteur :</label>
            <input type="text" id="auteur" name="auteur" value="<?= $newsSelect->getAuteur() ?>"/><br/>
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" value="<?= $newsSelect->getTitre() ?>"/><br/>
            <label for="contenu">Contenu :</label><br/>
            <textarea id="contenu" name="contenu" cols="60" rows="8">value="<?= $newsSelect->getContenu() ?></textarea><br/>
            <input type="submit" value="Modifier"/>
        </form>
        <?php
    } else {
        ?>
        <form action="admin.php" method="post">
            <label for="auteur">Auteur :</label>
            <input type="text" id="auteur" name="auteur"/><br/>
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre"/><br/>
            <label for="contenu">Contenu :</label><br/>
            <textarea id="contenu" name="contenu" cols="60" rows="8"></textarea><br/>
            <input type="submit" value="Ajouter"/>
        </form>
    <?php
    }
    ?>
    <br/><p>Il y a actuellement <?= $manager->count() ?> news. En voici la liste :</p>
    <table align="center">
        <thead>
            <tr>
                <th>Auteur</th>
                <th>Titre</th>
                <th>Date d'ajout</th>
                <th>Dernière modification</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $newsList = $manager->getList(5);

            foreach ($newsList as $news) {
                echo '<tr><td>' . $news->getAuteur() . '</td>';
                echo '<td>' . $news->getTitre() . '</td>';
                echo '<td>' . $news->getDateajout()->format('d/m/Y à H:i:s') . '</td>';
                echo '<td>' . ($news->getDatemodif() == $news->getDateajout() ? '-' : $news->getDatemodif()->format('d/m/Y à H:i:s')) . '</td>';
                echo '<td> <a href="admin.php?modifier=' . $news->getId() . '">Modifier</a> | <a href="admin.php?supprimer='. $news->getId() . '">Supprimer</a></td></tr>';
            }
        ?>
        </tbody>
    </table>
</div>
</body>
