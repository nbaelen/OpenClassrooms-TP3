<?php

class News {

    /* Déclaration des variables */
    private $_id,
            $_auteur,
            $_titre,
            $_contenu,
            $_dateAjout,
            $_dateModif;

    /* Constructeur de classe */
    public function __construct(array $pData) {
        $this->hydrate($pData);
    }

    /* Fonction d'hydratation de la classe */
    public function hydrate(array $pData) {
        foreach($pData as $key => $value) {

            $method = 'set' . ucfirst($key);
            if (method_exists($this,$method)) {
                $this->$method($value);
            }
        }
    }

    /* Déclaration des setters */
    public function setId($pId) {
        $this->_id = (int) $pId;
    }

    public function setAuteur($pAuteur) {
        if ($pAuteur != "") {
            $this->_auteur = $pAuteur;
        }
    }

    public function setTitre($pTitre) {
        if ($pTitre != "") {
            $this->_titre = $pTitre;
        }
    }

    public function setContenu($pContenu) {
        if ($pContenu != "") {
            $this->_contenu = $pContenu;
        }
    }

    public function setDateajout($pDateAjout) {

    }

    public function setDatemodif($pDateModif) {

    }

    /* Déclaration des getters */
    public function getId() {
        return $this->_id;
    }

    public function getAuteur() {
        return $this->_auteur;
    }

    public function getTitre() {
        return $this->_titre;
    }

    public function getContenu() {
        return $this->_contenu;
    }

    public function getDateajout() {
        return $this->_dateajout;
    }

    public function getDatemodif() {
        return $this->_dateModif;
    }
}