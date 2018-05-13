<?php

class NewsManagerMySQLi extends NewsManager {

    protected $db;

    /**
     * Constructeur de la classe NewsManagerMySQLi
     * @param MySQLi $pDd | DAO de la BDD
     */
    public function __construct(MySQLi $pDd) {
        $this->db = $pDd;
    }

    /**
     * Méthode permettant l'ajout d'une News
     * @param News $pNews | News à ajouter
     * @return void
     */
    public function add(News $pNews) {
        $query = $this->db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif) VALUES (?, ?, ?, NOW(), NOW())');
        $query->bind_param('sss',$pNews->getAuteur(), $pNews->getTitre(), $pNews->getContenu());
        $query->execute();
    }

    /**
     * Méthode permettant la suppression d'une News
     * @param $pNewsName | l'ID ou le nom de la News à supprimer
     * @return void
     */
    public function delete($pNewsName) {
        if (is_numeric($pNewsName)) {
            $this->db->query('DELETE FROM news WHERE id = ' . (int) $pNewsName);
        }
    }

    /**
     * Méthode permettant l'édition d'une News
     * @param News $pNews | News à éditer
     * @return void
     */
    public function edit(News $pNews) {
        $query = $this->db->prepare('UPDATE news SET auteur = ?, titre = ?, contenu = ?, dateModif = NOW() WHERE id = ?');
        $query->bind_param('sssi',$pNews->getAuteur(), $pNews->getTitre(), $pNews->getContenu(), $pNews->getId());
        $query->execute();
    }

    /**
     * Méthode renvoyant le nombre de News sauvegardées
     * @return int
     */
    public function count() {
        $query = $this->db->query('SELECT id FROM news');
        $data = $query->num_rows;

        return $data;
    }

    /**
     * Méthode permettant de récupérer une News à partir de son ID
     * @param $pId | l'identifiant de la News à récupérer
     * @return News
     */
    public function get($pId) {
        $query = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE id = ?');
        $query->bind_param('i', $pId);
        $query->execute();

        $query->bind_result($id, $auteur, $titre, $contenu, $dateAjout, $dateModif);
        $query->fetch();

        return new News([
            'id' =>$id,
            'auteur' => $auteur,
            'titre' => $titre,
            'contenu' => $contenu,
            'dateajout' => new DateTime($dateAjout),
            'datemodif' => new DateTime($dateModif)
        ]);
    }

    /**
     * Méthode permettant de récupérer une liste à partir de $pId renseigné, et d'une longueur $pNumber
     * @param $pNumber | la taille de la liste
     * @return array
     */
    public function getList($pNumber) {
        $query = $this->db->query('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC LIMIT '.$pNumber);

        while ($news = $query->fetch_object('News'))
        {
            $news->setDateajout(new DateTime($news->getDateajout()));
            $news->setDatemodif(new DateTime($news->getDatemodif()));

            $newsList[] = $news;
        }
        return $newsList;
    }
}