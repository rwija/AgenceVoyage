<?php

session_start();

 include('../functions/tools.php');
    include('../config/db.php');

       


    // Test qu'aucun des champs n'est vide, sinon redirige vers le formulaire
    foreach($_POST as $key => $element)
    {
        if(empty($_POST[$key]))
        {
            header('location: ../?page=form&type=subscription'); 
        }
        else
        {
            $$key = $element;
        }
    }
    
     try
    {
        // Les erreurs doivent être renvoyées sous forme d'exception
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        // Ouverture de la connexion à la DB
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);

        // Préparation de la requête
        $query = $db->prepare('SELECT * FROM user WHERE login=:login AND password=:password ');
        // Exécution de la requête
        $query->execute(array('login'=>$login,'password'=>$password));
        $data = $query->fetch();
        
        if(isset($data['id']))
        {
        $_SESSION['isAdmin']=$data['isAdmin'];
        
        $_SESSION['login']=$data['login'];
        header('location: ../');
        }
        else
        {
            header('location: ../index.php?page=formlogg'); 
        }
    }
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
?>
