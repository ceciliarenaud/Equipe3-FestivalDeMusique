<?php
namespace modele\metier;
/**
 * Description of Etablissement
 * un établissement a des capacités d'hébergement à offrir au festival
 * @author prof
 */
class Representation {
    private $id;
    private $date;
    private $lieu;
    private $groupe;
    private $heure_debut;
    private $heure_fin;
    
    function __construct($id, $date, $lieu, $groupe, $heure_debut, $heure_fin) {
        $this->id=$id;
        $this->date = $date;
        $this->lieu = $lieu;
        $this->groupe = $groupe;
        $this->heure_debut = $heure_debut;
        $this->heure_fin = $heure_fin;
    }
    function getId() {
        return $this->id;
    }
    function getDate() {
        return $this->date;
    }
    function getLieu() {
        return $this->lieu;
    }
    function getGroupe() {
        return $this->groupe;
    }
    function getHeure_debut() {
        return $this->heure_debut;
    }
    function getHeure_fin() {
        return $this->heure_fin;
    }
    function setId($id) {
        $this->id = $id;
       }
    function setDate($date) {
        $this->date = $date;
    }
    function setLieu($lieu) {
        $this->lieu = $lieu;
    }
    function setGroupe($groupe) {
        $this->groupe = $groupe;
    }
    function setHeure_debut($heure_debut) {
        $this->heure_debut = $heure_debut;
    }
    function setHeure_fin($heure_fin) {
        $this->heure_fin = $heure_fin;
    }
}