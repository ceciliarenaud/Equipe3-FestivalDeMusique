<?php
namespace modele\metier;

/**
 * Description of Representation
 * un groupe musical se produisant au festival
 * @author prof
 */
class Representation {
    /**
     * identifiant de la représentation
     * @var string
     */
    private $id;
    /**
     * lieu de la représentation
     * @var string
     */
    private $leLieu;
    /**
     * nom du groupe 
     * @var string 
     */
    private $leGroupe;
    /**
     * date de la représentation
     * @var string
     */
    private $dateRepresentation;
    /**
     * heure de début
     * @var integer
     */
    private $heureDebut;
    /**
     * heure de fin
     * @var string 
     */
    private $heureFin;
   

    function __construct($id, $leLieu, $leGroupe, $dateRepresentation, $heureDebut, $heureFin) {
        $this->id = $id;
        $this->leLieu = $leLieu;
        $this->leGroupe = $leGroupe;
        $this->dateRepresentation = $dateRepresentation;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
    }

    function getId() {
        return $this->id;
    }

    function getLeLieu() {
        return $this->leLieu;
    }

    function getLeGroupe() {
        return $this->leGroupe;
    }

    function getDateRepresentation() {
        return $this->dateRepresentation;
    }

    function getHeureDebut() {
        return $this->heureDebut;
    }

    function getHeureFin() {
        return $this->heureFin;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLeLieu($leLieu) {
        $this->leLieu = $leLieu;
    }

    function setLeGroupe($leGroupe) {
        $this->leGroupe = $leGroupe;
    }

    function setDateRepresentation($dateRepresentation) {
        $this->dateRepresentation = $dateRepresentation;
    }

    function setHeureDebut($heureDebut) {
        $this->heureDebut = $heureDebut;
    }

    function setHeureFin($heureFin) {
        $this->heureFin = $heureFin;
    }

}
