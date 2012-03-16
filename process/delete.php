<?php
    include('../functions/tools.php');
    include('../config/db.php');

     $id = protect($_GET['id']);
    $table = protect($_GET['table']);
    try
    {
        // Les erreurs doivent être renvoyées sous forme d'exception
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        // Ouverture de la connexion à la DB
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);

        // Préparation de la requête de suppression (basée sur l'id de l'utilisateur à supprimé transmis via GET)
        $query = $db->prepare('DELETE FROM '.$table.' WHERE id = :id');
        // Exécution de la requête
        $query->execute(array('id'=> $id));

        // Redirection finale vers l'index du backend
        header('location: ../homeAdmin.php');
        
    }
    // Récupérer et afficher les éventuelles exceptions SQL
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
?>
