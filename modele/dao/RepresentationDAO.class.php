<?php
namespace modele\dao;
use modele\metier\Representation;
use PDOStatement;
use PDO;
/**
 * Description of EtablissementDAO
 * Classe métier : Etablissement
 * @author prof
 * @version 2017
 */
class RepresentationDAO {
    /**
     * Instancier un objet de la classe Etablissement à partir d'un enregistrement de la table ETABLISSEMENT
     * @param array $enreg
     * @return Etablissement
     */
    
     protected static function enregVersMetier(array $enreg) {
        $id=$enreg['ID'];
        $date = $enreg['DATE'];
        $lieu = $enreg['LIEU'];
        $groupe = $enreg['GROUPE'];
        $heure_debut = $enreg['HEUREDEBUT'];
        $heure_fin = $enreg['HEUREFIN'];
        $uneRepres = new Representation($id,$date, $lieu, $groupe, $heure_debut, $heure_fin);
        return $uneRepres;
    }
    /**
     * Valorise les paramètres d'une requête préparée avec l'état d'un objet Etablissement
     * @param type $objetMetier un Etablissement
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg(Representation $objetMetier, PDOStatement $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        // Note : bindParam requiert une référence de variable en paramètre n°2 ; 
        // avec bindParam, la valeur affectée à la requête évoluerait avec celle de la variable sans
        // qu'il soit besoin de refaire un appel explicite à bindParam
        $stmt->bindValue(':date', $objetMetier->getDate());
        $stmt->bindValue(':lieu', $objetMetier->getLieu());
        $stmt->bindValue(':groupe', $objetMetier->getGroupe());
        $stmt->bindValue(':heure_debut', $objetMetier->getHeure_debut());
        $stmt->bindValue(':heure_fin', $objetMetier->getHeure_fin());
    }
    /**
     * Retourne la liste de tous les Etablissements
     * @return array tableau d'objets de type Etablissement
     */
    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT  r.id,date, l.nom AS Lieu, g.nom AS Groupe, heuredebut, heurefin FROM Representation r
INNER JOIN Groupe g ON r.Groupe = g.id
INNER JOIN Lieu l ON r.Lieu = l.id ORDER BY date";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            // Pour chaque enregisterement
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // instancier un Etablissement et l'ajouter au tableau
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }
}