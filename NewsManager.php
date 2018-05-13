<?php

abstract class NewsManager {

    /**
     * Méthode permettant l'ajout d'une News
     * @param News $pNews | News à ajouter
     * @return void
     */
    abstract public function add(News $pNews);

    /**
     * Méthode permettant la suppression d'une News
     * @param $pNewsName | l'ID ou le nom de la News à supprimer
     * @return void
     */
    abstract public function delete($pNewsName);

    /**
     * Méthode permettant l'édition d'une News
     * @param News $pNews | News à éditer
     * @return void
     */
    abstract public function edit(News $pNews);

    /**
     * Méthode permettant la sauvegarde d'une News
     * @param News $pNews | News à sauvegarder
     * @return void
     */
    abstract public function save(News $pNews);

    /**
     * Méthode renvoyant le nombre de News sauvegardées
     * @return int
     */
    abstract public function count();

    /**
     * Méthode permettant de récupérer une News à partir de son ID
     * @param $pId | l'identifiant de la News à récupérer
     * @return News
     */
    abstract public function get($pId);

    /**
     * Méthode permettant de récupérer une liste à partir de $pId renseigné, et d'une longueur $pNumber
     * @param $pNumber | la taille de la liste
     * @return array
     */
    abstract public function getList($pNumber);
}