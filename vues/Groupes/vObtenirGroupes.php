<?php
use modele\dao\GroupesDAO;
use modele\dao\AttributionDAO;
use modele\dao\Bdd;
require_once __DIR__.'/../../includes/autoload.php';
Bdd::connecter();

include("includes/attributionDAO.class.php");

// AFFICHER L'ENSEMBLE DES Groupes
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// Groupes

echo "
<br>
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong>Groupes</strong></td>
   </tr>";

$lesEtablissements = GroupeDAO::getAll();
// BOUCLE SUR LES ÉTABLISSEMENTS
foreach ($lesGroupes as $unGroupe) {
    $id = $unGroupe->getId();
    $nom = $unGroupe->getNom();
    echo "
		<tr class='ligneTabNonQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'> 
         <a href='cGestionGroupes.php?action=detailEtab&id=$id'>
         Voir détail</a></td>
         
         <td width='16%' align='center'> 
         <a href='cGestionGroupes.php?action=demanderModifierEtab&id=$id'>
         Modifier</a></td>";

    // S'il existe déjà des attributions pour l'établissement, il faudra
    // d'abord les supprimer avant de pouvoir supprimer l'établissement
//    if (!existeAttributionsEtab($connexion, $id)) {
    $lesAttributionsDeCeGroupe = AttributionDAO::getAllByIdEtab($id);
    if (count($lesAttributionsDeCeGroupe)==0) {
        echo "
            <td width='16%' align='center'> 
            <a href='cGestionGroupes.php?action=demanderSupprimerGroupes&id=$id'>
            Supprimer</a></td>";
    } else {
        echo "
            <td width='16%'>&nbsp; </td>";
    }
    echo "
      </tr>";
}
echo "
</table>
<br>
<a href='cGestionGroupes.php?action=demanderCreerGroupes'>
Création d'un Groupe</a >";

include("includes/_fin.inc.php");



