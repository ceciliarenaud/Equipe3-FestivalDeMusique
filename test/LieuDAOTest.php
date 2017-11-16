<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>LieuDAO : test</title>
    </head>

    <body>

        <?php

        use modele\dao\LieuDAO;
        use modele\dao\Bdd;
        use modele\metier\Lieu;

require_once __DIR__ . '/../includes/autoload.php';

        $id = '1';
        Bdd::connecter();

        echo "<h2>1- LieuDAO</h2>";

        // Test n°1
        echo "<h3>Test getOneById</h3>";
        try {
            $objet = LieuDAO::getOneById($id);
            var_dump($objet);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }

        // Test n°2
        echo "<h3>2- getAll</h3>";
        try {
            $lesObjets = LieuDAO::getAll();
            var_dump($lesObjets);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }

        // Test n°3
        echo "<h3>3- insert</h3>";
        try {
            $id = '5';
            $objet = new Lieu($id, 'LE GRAND REX', '35 rue de la Papouasie', '1500');
            $ok = LieuDAO::insert($objet);
            if ($ok) {
                echo "<h4>ooo réussite de l'insertion ooo</h4>";
                $objetLu = LieuDAO::getOneById($id);
                var_dump($objetLu);
            } else {
                echo "<h4>*** échec de l'insertion ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        // Test n°3-bis
        echo "<h3>3- insert déjà présent</h3>";
        try {
            $id = '5';
             $objet = new Lieu($id, 'LE GRAND REX2', '36 rue de la Papouasie', '1400');
            $ok = LieuDAO::insert($objet);
            if ($ok) {
                echo "<h4>*** échec du test : l'insertion ne devrait pas réussir  ***</h4>";
                $objetLu = Bdd::getOneById($id);
                var_dump($objetLu);
            } else {
                echo "<h4>ooo réussite du test : l'insertion a logiquement échoué ooo</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>ooo réussite du test : la requête d'insertion a logiquement échoué ooo</h4>" . $e->getMessage();
        }

        // Test n°4
        echo "<h3>4- update</h3>";
        try {
            $objet->setCapaciteAccueil('1900');
            $objet->setAdresseLieu('35 rue de la Villardière');
            $ok = LieuDAO::update($id, $objet);
            if ($ok) {
                echo "<h4>ooo réussite de la mise à jour ooo</h4>";
                $objetLu = LieutDAO::getOneById($id);
                var_dump($objetLu);
            } else {
                echo "<h4>*** échec de la mise à jour ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        // Test n°5
        echo "<h3>5- delete</h3>";
        try {
            $ok = LieuDAO::delete($id);
//            $ok = LieuDAO::delete("xxx");
            if ($ok) {
                echo "<h4>ooo réussite de la suppression ooo</h4>";
            } else {
                echo "<h4>*** échec de la suppression ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        // Test n°6
        echo "<h3>6- getAllOfferingRooms</h3>";
        try {
            $lesObjets = LieuDAO::getAllOfferingRooms();
            var_dump($lesObjets);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }

        // Test n°7
        echo "<h3>7- isAnExistingId</h3>";
        try {
            $id = "42";
            $ok = LieuDAO::isAnExistingId($id);
            $ok = $ok && !LieuDAO::isAnExistingId('AZERTY');
            if ($ok) {
                echo "<h4>ooo test réussi ooo</h4>";
            } else {
                echo "<h4>*** échec du test ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        // Test n°8
        echo "<h3>7- isAnExistingName</h3>";
        try {
            // id et nom d'un lieu existant
            $id = "6";
            $nomLieu = "Le T-Rex";
            $ok=true;
            // en mode modification (1er paramètre = false)
            $ok = LieuDAO::isAnExistingName(false, "0123456", $nomLieu);
            $ok = $ok && ! $objet = new Lieu($id, 'LE GRAND REX', '35 rue de la Papouasie', '1500');
            $ok = LieuDAO::isAnExistingName(false, $id, $nomLieu);
            // en mode création (1er paramètre = true)
            $ok = $ok && LieuDAO::isAnExistingName(true, "0123456", $nomLieu);
            $ok = $ok && !LieutDAO::isAnExistingName(true, "0123456", "Restaurant");
            if ($ok) {
                echo "<h4>ooo test réussi ooo</h4>";
            } else {
                echo "<h4>*** échec du test ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        Bdd::deconnecter();
        ?>


    </body>
</html>
