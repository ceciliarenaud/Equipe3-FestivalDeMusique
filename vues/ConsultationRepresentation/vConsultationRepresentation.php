<?php
use modele\dao\RepresentationDAO;
use modele\dao\Bdd;
require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();
include("includes/_debut.inc.php");
// CONSULTER LES OFFRES DE TOUS LES ÉTABLISSEMENTS
// IL FAUT QU'IL Y AIT AU MOINS UN ÉTABLISSEMENT ET UN TYPE CHAMBRE POUR QUE 
// L'AFFICHAGE SOIT EFFECTUÉ
$lesRepresentation = RepresentationDAO::getAll();
$dateprec = -1;
$x=-1;
    foreach ($lesRepresentation as $uneRepresentation) {
        $date = $uneRepresentation->getDate();
        // AFFICHAGE DU NOM DE L'ÉTABLISSEMENT ET D'UN LIEN VERS LE FORMULAIRE DE
        // MODIFICATION
        if($x==-1){
            $dateprec=$date;
            $x=$x+1;
            echo "<strong>$date</strong><br>
   
            <table width='45%' cellspacing='0' cellpadding='0' class='tabQuadrille'>";
            echo "
            <tr class='enTeteTabQuad'>
               <td width='30%'>Lieu</td>
               <td width='30%'>Groupe</td>
               <td width='20%'>Heure Début</td> 
               <td width='20%'>Heure Fin</td>
            </tr>";
        }
        
        if($dateprec!=$date){
            $dateprec=$date;
            echo "</table><br>";
            echo "<strong>$date</strong><br>
            
            <table width='45%' cellspacing='0' cellpadding='0' class='tabQuadrille'>";
            echo "
            <tr class='enTeteTabQuad'>
               <td width='30%'>Lieu</td>
               <td width='30%'>Groupe</td>
               <td width='20%'>Heure Début</td> 
               <td width='20%'>Heure Fin</td>
            </tr>";
        }
        
        // AFFICHAGE DE LA LIGNE D'EN-TÊTE
        
            echo " 
            <tr class='ligneTabQuad'>
               <td>".$uneRepresentation->getLieu()."</td>
               <td>".$uneRepresentation->getGroupe()."</td>
               <td>".$uneRepresentation->getHeure_debut()."</td>
               <td>".$uneRepresentation->getHeure_fin()."</td>";
            // On récupère le nombre de chambres offertes pour l'établissement 
            // et le type de chambre actuellement traités
//            $nbOffre = obtenirNbOffre($connexion, $idEtab, $unTypeChambre->getId());
            
            echo "
               
            </tr>";
        }
        echo "
      </table><br>";
    
include("includes/_fin.inc.php");