<?php
namespace modele\metier;

/**
 * Description of Lieu
 * un établissement a des capacités d'hébergement à offrir au festival
 * @author prof
 */
class Lieu {
    /**
     * code  de 8 caractères alphanum.
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $nomLieu;
    /**
     * nom
     * @var string
     */
    private $adresseLieu;
    /**
     * adresse
     * @var string 
     */
    private $capaciteAccueil;
    
   
    function __construct($id, $nomLieu, $adresseLieu, $capaciteAccueil) {
        $this->id = $id;
        $this->nom = $nomLieu;
        $this->adresse = $adresseLieu;
        $this->cdp = $capaciteAccueil;
      
    }

    function getId() {
        return $this->id;
    }

    function getNomLieu() {
        return $this->nomLieu;
    }

    function getAdresseLieu() {
        return $this->adresseLieu;
    }

    function getCapaciteAccueil() {
        return $this->capaciteAccueil;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNomLieu($nomLieu) {
        $this->nomLieu = $nomLieu;
    }

    function setAdresseLieu($adresseLieu) {
        $this->adresseLieu = $adresseLieu;
    }

    function setCapaciteAccueil($capaciteAccueil) {
        $this->capaciteAccueil = $capaciteAccueil;
    }

}