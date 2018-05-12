<?php

class NewsManagerPDO extends NewsManager {

    /**
     * DAO de la BDD
     * @var PDO
     */
    protected $db;

    /**
     * Constructeur de la classe NewsManagerPDO
     * @param PDO $pDb | DAO de la BDD
     */
    public function __construct(PDO $pDb) {
        $this->db = $pDb;
    }

    /**
     * Méthode permettant l'ajout d'une News
     * @param News $pNews | News à ajouter
     * @return void
     */
    protected function add(News $pNews) {
        $query = $this->db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif) VALUES (?, ?, ?, NOW(), NOW())');
        $query->execute([
            $pNews->getAuteur(),
            $pNews->getTitre(),
            $pNews->getContenu()
        ]);
    }

    /**
     * Méthode permettant la suppression d'une News
     * @param $pNewsName | l'ID de la News à supprimer
     * @return void
     */
    protected function delete($pNewsName) {
        if (is_numeric($pNewsName)) {
            $query = $this->db->query('DELETE FROM news WHERE id = '.(int) $pNewsName);
        }

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
    }

    /**
     * Méthode renvoyant le nombre de News sauvegardées
     * @return int
     */
    public function count() {
        $query = $this->db->query('SELECT COUNT(*) as count FROM news');
        $data = $query->fetch();

        return $data['count'];
    }

    /**
     * Méthode permettant de récupérer une News à partir de son ID
     * @param $pId | l'identifiant de la News à récupérer
     * @return News
     */
    public function get($pId) {
        $query = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE id = ?');
        $query->execute([
            $pId
        ]);
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $news = $query->fetch();
        $news->setDateajout(new DateTime($news->getDateajout()));
        $news->setDatemodif(new DateTime($news->getDatemodif()));

        return $news;
    }



    /**
     * Méthode permettant de récupérer une liste à partir de $pId renseigné, et d'une longueur $pNumber
     * @param $pNumber | la taille de la liste
     * @return array
     */
    public function getList($pNumber) {
        $query = $this->db->query('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC LIMIT '.$pNumber);
        /*$query = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC LIMIT :limit');
        $query->execute([
            ':limit' => $pNumber
        ]);*/
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $newsList = $query->fetchAll();
        foreach ($newsList as $news) {
            $news->setDateajout(new DateTime($news->getDateajout()));
            $news->setDatemodif(new DateTime($news->getDatemodif()));
        }

        $query->closeCursor();

        return $newsList;
    }
}