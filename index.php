<?php    
session_start();
    // Inclusion des fonctions et configurations
    include('./functions/tools.php');    
    include('./config/db.php');
//print_r($_SESSION);
    
    // Test si l'arrivée sur l'index est accompagnée d'un paramètre "page" (non vide), sinon renvoi vers index avec le paramètre page=home (via fonction)
    testEmptyHome(protect($_GET['page']),'home');
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Projet agence de voyage</title>
        <link rel="stylesheet" type="text/css" href="./css/reset.css" />
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <script type="text/javascript" src="./js/modernizr-2.0.6.js"></script>
        <script type="text/javascript" src="./js/jquery-1.6.4.min.js"></script>
        
    </head>
    <body>
        <div id="container">
            <nav>
                <ul>
                    <a href="./index.php?page=home"> <li>Accueil</li></a>
                    <a href="./index.php?page=formLogg"><li>Connexion</li></a>
                    <a href="./index.php?page=formAdd&table=user"><li>Inscription</li></a>
                    <div class="clearfix"></div>
                </ul>
            </nav>
            <div id="banner">
                <img src="./images/agence_voyage_banner2.jpg"  width="900px"/>
            </div>
            <div id="content">
            <div id="left">
                <div id="bloc1">
                    <?php
try
    {
        
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);
         $db->query("SET NAMES 'utf8'");

        $query = $db->prepare('SELECT * FROM continent ');
        
        $query->execute();

        echo '<ul>';
 while($data = $query->fetch())
        {
                echo '<li><a href="./index.php?page=home&id='.$data['id'].'">'.$data['name'].'</a></li>';

        }
        echo '</ul>';
        
        $query->closeCursor();

    }
    catch(Exception $e)
    {
        die('ERROR : '.$e->getMessage());
    }
?>
                </div>
                <div id="bloc2">
                    <h2>Top Destinations</h2>
                </div>
            </div>
            <div id="right">
                <?php
          // Récupération du paramètre GET "page"
                    $page = protect($_GET['page']);
                    // Inclusion de la page déterminée par la variable $page définie ci-dessus
                    include('./views/'.$page.'.php');
        ?> 
            </div>
            <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <?php
            
              if(!empty($_SESSION['isAdmin'])&&($_SESSION['isAdmin']==1))
              {
                  echo'<div id="admin">
                      <ul>
                    <a href="./homeAdmin.php"> <li>Accueil</li></a>
                    <a href="./index.php?page=formAdd&table=voyage"> <li>Ajouter un voyage</li></a>
                    <a href="./index.php?page=formAdd&table=hotel"> <li>Ajouter un hôtel</li></a>
                    <ul>
                  </div>';
              
              }
            ?>
            
       
            </div>
        <footer> &COPY; BOUHASSOUN RAJAE 2012</footer>
    </body>
</html>
