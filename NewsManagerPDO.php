<?php

class NewsManagerPDO extends NewsManager {

    /**
     * Méthode permettant l'ajout d'une News
     * @param News $pNews | News à ajouter
     * @return void
     */
    protected function add(News $pNews) {
        // TODO: Implement add() method.
    }

    /**
     * Méthode permettant la suppression d'une News
     * @param $pNewsName | l'ID ou le nom de la News à supprimer
     * @return void
     */
    protected function delete($pNewsName) {
        // TODO: Implement delete() method.
    }

    /**
     * Méthode permettant l'édition d'une News
     * @param News $pNews | News à éditer
     * @return void
     */
    protected function edit(News $pNews) {
        // TODO: Implement edit() method.
    }

    /**
     * Méthode permettant la sauvegarde d'une News
     * @param News $pNews | News à sauvegarder
     * @return void
     */
    public function save(News $pNews) {
        // TODO: Implement save() method.
    }

    /**
     * Méthode renvoyant le nombre de News sauvegardées
     * @return int
     */
    public function count() {
        // TODO: Implement count() method.
    }

    /**
     * Méthode permettant de récupérer une News à partir de son ID
     * @param $pId | l'identifiant de la News à récupérer
     * @return News
     */
    public function get($pId) {
        // TODO: Implement get() method.
    }

    /**
     * Méthode permettant de récupérer une liste à partir de $pId renseigné, et d'une longueur $pNumber
     * @param $pId | l'ID à partir duquel commence la liste
     * @param $pNumber | la taille de la liste
     * @return array
     */
    public function getList($pId, $pNumber) {
        // TODO: Implement getList() method.
    }
}