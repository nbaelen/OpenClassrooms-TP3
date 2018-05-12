<?php

class News {

    /* Déclaration des variables */
    private $id,
            $auteur,
            $titre,
            $contenu,
            $dateAjout,
            $dateModif;

    /* Constructeur de classe */
    public function __construct($pData = []) {
        if (!empty($pData)) {
            $this->hydrate($pData);
        }
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
        $this->id = (int) $pId;
    }

    public function setAuteur($pAuteur) {
        if ($pAuteur != "") {
            $this->auteur = $pAuteur;
        }
    }

    public function setTitre($pTitre) {
        if ($pTitre != "") {
            $this->titre = $pTitre;
        }
    }

    public function setContenu($pContenu) {
        if ($pContenu != "") {
            $this->contenu = $pContenu;
        }
    }

    public function setDateajout($pDateAjout) {
        $this->dateAjout = $pDateAjout;
    }

    public function setDatemodif($pDateModif) {
        $this->dateModif = $pDateModif;
    }

    /* Déclaration des getters */
    public function getId() {
        return $this->id;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getDateajout() {
        return $this->dateAjout;
    }

    public function getDatemodif() {
        return $this->dateModif;
    }
}