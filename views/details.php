
 <?php

      $id = protect($_GET['id']);
      $table = protect($_GET['table']);
      
     
    try
    {
        
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);

       
        $query = $db->prepare('SELECT * FROM '.$table.' WHERE id=:id');
        $query->execute(array('id'=>$id));
        $data = $query->fetch();
        echo '<h1>'.$data['name'].' </h1>';
        echo '<div class="englob">';
        
        echo '<img src="./images/'.$data['urlBanner'].'" class="banner" width="625px" height="150px"/>';
        echo '<p class="banner">'.$data['descriptionLongue'].'</p>';
        echo '<iframe></iframe>';
        if($_GET['table']=='voyage')
         {echo '<a href="./index.php?page=home&table=hotel&idVoyage='.$data['id'].'">voir tout les hôtels disponible pour ce voyage</a>';}
        
        $query->closeCursor();

    }
    
    catch(Exception $e)
    {
        die('ERROR : '.$e->getMessage());
    }?>
    
</div>


