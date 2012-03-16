
<?php

    $id = protect($_GET['id']);
    $table = protect($_GET['table']);

    try
    {
        // Les erreurs doivent être renvoyées sous forme d'exception
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        // Ouverture de la connexion à la DB
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);

        //Préparation de la requête où je souhaite sélectionner tous les utilisateurs et les ordonnées par date d'inscription descendante
        $query = $db->prepare('SELECT * FROM '.$table.' WHERE id = :id');
        // Exécution de la requête
        $query->execute(array('id'=>$id));

        // Placement des données récupérées sous forme de ressources dans une variable exploitable (array)
        $data = $query->fetch();
        if($table=='voyage')
        {
            $idContinent=$data['idContinent'];
            echo
        '
        <form method="POST" action="./process/update.php?id='.$id.'&table='.$table.'">
         <fieldset>
         
          <label>Nom</label> <input type="text" name="name" value="'.$data['name'].'" /><br />
          <label>Localisation</label> <input type="text" name="localisation" value="'.$data['localisation'].'" /><br />
          <label>Continent</label> <select name="idContinent"/>';
          $query->closeCursor();
          $query2 = $db->prepare('SELECT*FROM continent WHERE id = :id');
          $query2->execute(array('id'=>$idContinent));
          $data = $query2->fetch();
          echo'
          <option value="'.$data['id'].'">'.$data['name'].'</option>';
          
           $query2->closeCursor();
           
         $query3 = $db->prepare('SELECT*FROM continent WHERE id != :id');
          $query3->execute(array('id'=>$idContinent));
           While($data=$query3->fetch())
              {
           echo ' 
               <option value="'.$data['id'].'">'.$data['name'].'</option>';
              
              };
           echo '</select><br />';
           $query3->closeCursor();
           
           $query4= $db->prepare('SELECT * FROM voyage WHERE id = :id');
          $query4->execute(array('id'=>$id));
          $data = $query4->fetch();
            echo '
           
            <label>Description courte</label> <textarea name="DescriptionCourte" rows="5" cols="40">'.$data['descriptionCourte'].'</textarea><br />
            <label>Description longue</label> <textarea name="DescriptionLongue" rows="5" cols="40">'.$data['descriptionLongue'].'</textarea><br />
            <div class="clearfix"></div>
               
                
        ';
            $query4->closeCursor();  
        }
        

       
        elseif($table=='hotel')
        {
               echo
        '
        <form method="POST" action="./process/update.php?id='.$id.'&table='.$table.'">
            <fieldset>
                <label>Type</label> <input type="text" name="type" value="'.$data['type'].'" /><br />
                <label>Nom</label> <input type="text" name="nom" value="'.$data['nom'].'" /><br />
                <label>Date De Naissance</label> <input type="text" name="dateDeNaissance" value="'.$data['dateDeNaissance'].'" /><br />
                <label>Genre</label> <input type="text" name="genre" value="'.$data['genre'].'" /><br />
                <label>Soignant</label> <input type="text" name="idSoignant" value="'.$data['idSoignant'].'" /><br />
              
                
               
                
        '; 
        }

        echo
        '
                <input type="submit" value="Modifier" />
            </fieldset>
        </form>
        ';

       
        $query->closeCursor();

    }
    
    catch(Exception $e)
    {
        die('ERROR : '.$e->getMessage());
    }

?>