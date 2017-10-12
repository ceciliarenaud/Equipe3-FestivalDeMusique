<?php
/**
 * Contrôleur : gestion des établissements
 */
use modele\dao\GroupeDAO;
use modele\metier\Groupe;
use modele\dao\Bdd;
require_once __DIR__.'/includes/autoload.php';
Bdd::connecter();

include("includes/_gestionErreurs.inc.php");
//include("includes/gestionDonnees/_connexion.inc.php");
//include("includes/gestionDonnees/_gestionBaseFonctionsCommunes.inc.php");

// 1ère étape (donc pas d'action choisie) : affichage du tableau des 
// établissements 
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

// Aiguillage selon l'étape
switch ($action) {
    case 'initial' :
        include("vues/Groupes/vObtenirGroupes.php");
        break;

    case 'detailGroupe':
        $id = $_REQUEST['id'];
        include("vues/Groupes/vObtenirDetailGroupe.php");
        break;

    case 'demanderSupprimerGroupe':
        $id = $_REQUEST['id'];
        include("vues/Groupes/vSupprimerGroupe.php");
        break;

    case 'demanderCreerGroupe':
        include("vues/Groupes/vCreerModifierGroupe.php");
        break;

    case 'demanderModifierGroupe':
        $id = $_REQUEST['id'];
        include("vues/Groupes/vCreerModifierGroupe.php");
        break;

    case 'validerSupprimerGroupe':
        $id = $_REQUEST['id'];
        GroupeDAO::delete($id);
        include("vues/Groupes/vObtenirGroupe.php");
        break;

    case 'validerCreerGroupe':case 'validerModifierGroupe':
        $id = $_REQUEST['id'];
        $nom = $_REQUEST['nom'];
        $adresseRue = $_REQUEST['adresseRue'];
        $codePostal = $_REQUEST['codePostal'];
        $ville = $_REQUEST['ville'];
        $tel = $_REQUEST['tel'];
        $adresseElectronique = $_REQUEST['adresseElectronique'];
        $type = $_REQUEST['type'];
        $civiliteResponsable = $_REQUEST['civiliteResponsable'];
        $nomResponsable = $_REQUEST['nomResponsable'];
        $prenomResponsable = $_REQUEST['prenomResponsable'];

        if ($action == 'validerCreerGroupe') {
            verifierDonneesGroupeC($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $nomResponsable);
            if (nbErreurs() == 0) {
                $unGroupe = new Groupe($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $type, $civiliteResponsable, $nomResponsable, $prenomResponsable);
                GroupeDAO::insert($unGroupe);
                include("vues/Groupes/vObtenirGroupe.php");
            } else {
                include("vues/Groupes/vCreerModifierGroupe.php");
            }
        } else {
            verifierDonneesGroupeM($id, $nom, $adresseRue, $codePostal, $ville, $tel,$adresseElectronique, $nomResponsable);
            if (nbErreurs() == 0) {
                $unGroupe = new Groupe($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $type, $civiliteResponsable, $nomResponsable, $prenomResponsable);
                GroupeDAO::update($id, $unGroupe);
                include("vues/Groupes/vObtenirGroupe.php");
            } else {
                include("vues/Groupes/vCreerModifierGroupe.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesGroupeC($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $nomResponsable) {
    if ($id == "" || $nom == "" || $adresseRue == "" || $codePostal == "" ||
            $ville == "" || $tel == "" || $nomResponsable == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($id != "") {
        // Si l'id est constitué d'autres caractères que de lettres non accentuées 
        // et de chiffres, une erreur est générée
        if (!estChiffresOuEtLettres($id)) {
            ajouterErreur
                    ("L'identifiant doit comporter uniquement des lettres non accentuées et des chiffres");
        } 
        else if (!estChiffresEtLettres($nom)) {
            ajouterErreur
        ("Le nom doit comporter uniquement des lettres non accentuées et des chiffres");
        }    
        else {
            if (GroupeDAO::isAnExistingId($id)) {
                ajouterErreur("Le Groupe $id existe déjà");
            }
        }
    }
    if ($nom != "" && GroupeDAO::isAnExistingName(true, $id, $nom)) {
        ajouterErreur("L'établissement $nom existe déjà");
    }
    if ($codePostal != "" && !estUnCp($codePostal)) {
        ajouterErreur('Le code postal doit comporter 5 chiffres');
    }
    if ($adresseElectronique != "" && !estUneAe($adresseElectronique)) {
        ajouterErreur("Le format de l'email n'est pas conforme");
    }
}

function verifierDonneesGroupeM($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $nomResponsable) {
    if ($nom == "" || $adresseRue == "" || $codePostal == "" || $ville == "" ||
            $tel == "" || $nomResponsable == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($nom != "" && GroupeDAO::isAnExistingName(false, $id, $nom)) {
        ajouterErreur("L'établissement $nom existe déjà");
    }
    if ($codePostal != "" && !estUnCp($codePostal)) {
        ajouterErreur('Le code postal doit comporter 5 chiffres');
    }
       if ($adresseElectronique != "" && !estUneAe($adresseElectronique)) {
        ajouterErreur("Le format de l'email n'est pas conforme");
    }
}

function estUnCp($codePostal) {
    // Le code postal doit comporter 5 chiffres
    return strlen($codePostal) == 5 && estEntier($codePostal);
}

function estUneAe($adresseElectronique) {
    // Le code postal doit comporter 5 chiffres
    return preg_match('/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $adresseElectronique);
}
