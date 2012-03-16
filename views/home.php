   <?php

    if(isset($_GET['id']))
    {
      $id = protect($_GET['id']);   
       
    }
  if(isset($_GET['table']))
    {
   $table = protect($_GET['table']);
    }
    else
    {
        $table = 'voyage';
    }
    if(isset($_GET['idVoyage']))
    {
    $idvoyage=protect($_GET['idVoyage']);  
    }
    echo '<h1>Derniers '.$table.'s ajoutés </h1>';
echo '<div class="englob">';
 
    try
    {
        
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);
        $db->query("SET NAMES 'utf8'");


        if(!isset($_GET['id']))
        {
            if(!isset($_GET['idVoyage']))
          {
        $query = $db->prepare('SELECT * FROM '.$table.' ORDER BY id DESC LIMIT 0,6');
        $query->execute();
           }
          else
          {
            $query = $db->prepare('SELECT * FROM '.$table.' WHERE idVoyage=:idvoyage ');
        $query->execute(array('idvoyage'=>$idvoyage)); 
          }
        
        }
        else
         {
         $query = $db->prepare('SELECT * FROM voyage WHERE idContinent =:id  ORDER BY id DESC LIMIT 0,6');
         $query->execute(array('id'=>$id));
          }
        
 
     
 while($data = $query->fetch())
        {

            echo '<div class="content2">';
            echo ' <div class="miniature"><img src="./images/'.$data['urlMiniature'].'" width="130" height="100"/></div>';
            echo ' <div class="text"><h3>'.$data['name'].'<a href="./index.php?page=details&table='.$table.'&id='.$data['id'].'">(en savoir plus)</a></h3>';
            echo '<p>'.$data['descriptionCourte'].'</p></div>';
            echo '<div class="clearfix"></div>
                  </div>';
        }
        
        $query->closeCursor();

    }
    catch(Exception $e)
    {
        die('ERROR : '.$e->getMessage());
    }?>

    
    </div>

