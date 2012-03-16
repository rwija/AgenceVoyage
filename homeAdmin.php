<?php    
session_start();
    // Inclusion des fonctions et configurations
    include('./functions/tools.php');    
    include('./config/db.php');
//print_r($_SESSION);
    
    // Test si l'arrivée sur l'index est accompagnée d'un paramètre "page" (non vide), sinon renvoi vers index avec le paramètre page=home (via fonction)
    
    
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
<h1>LISTE DES VOYAGES DE NOTRE AGENCE</h1>
<?php

    try
    {
        
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);

        
        $query = $db->prepare('SELECT * FROM voyage ');
        
        $query->execute();

        
        echo '<table id="voyage">
                 <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>LOCALISATION</th>
                        <th>ID CONTINENT</th>
                        <th>BANNIERE</th>
                        <th>MINIATURE</th>
                        <th>DESCRIPTION LONGUE</th>
                        <th>DESCRIPTION COURTE</th>
                        <th></th>
                        <th></th>
                    </tr>
                  </thead>';
        echo '<tbody>';
 while($data = $query->fetch())
        {
      $t1=str_truncate($data['descriptionCourte'], 20);
      $t2=str_truncate($data['descriptionLongue'], 20);


     
            echo '<tr>';
                echo '<td>'.$data['id'].'</td>';
                echo '<td>'.$data['name'].'</td>';
                echo '<td>'.$data['localisation'].'</td>';
                echo '<td>'.$data['idContinent'].'</td>';
                echo '<td><img src="./images/'.$data['urlBanner'].'" width="130" height="100"/></td>';
                echo '<td><img src="./images/'.$data['urlMiniature'].'" width="130" height="100"/></td>';
                echo '<td>'.$t1.'...</td>';
                echo '<td>'.$t2.'...</td>';
                echo '<td><a href="./?page=form&id='.$data['id'].'&table=voyage">Edit</a></td>';
                echo '<td><a href="./process/delete.php?id='.$data['id'].'&table=voyage">Delete</a></td>';
                
            echo '</tr>';
            
        }
        echo '</tbody>';
        echo '</table>';
    echo '<a href="./?page=formAdd&table=soigneurs">Add</a>';
        
        $query->closeCursor();

    }
    catch(Exception $e)
    {
        die('ERROR : '.$e->getMessage());
    }
    
    //--------------tableau hotel----------------
    echo '<h1>Liste DES hôtels de notre agence</h1>';
?>
            </div>
                    <footer> &COPY; BOUHASSOUN RAJAE 2012</footer>
    </body>
</html>