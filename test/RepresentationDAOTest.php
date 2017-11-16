<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>RepresentationDAO : test</title>
    </head>

    <body>

        <?php
        use modele\dao\RepresentationDAO;
        use modele\dao\Bdd;
        use modele\metier\Representation;
require_once __DIR__ . '/../includes/autoload.php';
      
        Bdd::connecter();
        echo "<h2>1- RepresentationDAO</h2>";
        // Test n°1
        
        echo "<h3>1- getAll</h3>";
        try {
            $lesObjets = RepresentationDAO::getAll();
            var_dump($lesObjets);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }
        
        Bdd::deconnecter();
        ?>


    </body>
</html>