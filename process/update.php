<?php

   
    include('../functions/tools.php');
    include('../config/db.php');

    $id = protect($_GET['id']);
    $table = protect($_GET['table']);

   
    foreach($_POST as $key => $element)
    {
        if(empty($_POST[$key]))
        {           
            header('location: ../?page=form&id='.$id);
            die();
        }
        else
        {
            $$key = $element;
        }
    }
if($table=='voyage')
{
    try
    {
        
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);
    
        
          
        $query = $db->prepare('UPDATE voyage SET  name =:name,
                                                  localisation =:localisation,
                                                  idContinent =:idContinent,
                                         
                                                  DescriptionCourte =:DescriptionCourte,
                                                  DescriptionLongue =:DescriptionLongue                                                   
                                                   WHERE id = :id');
        $query->execute(array('name' =>$name,
                              'localisation' =>$localisation,
                               'idContinent' =>$idContinent,
                              
                               'DescriptionCourte' =>$DescriptionCourte,
                                'DescriptionLongue' =>$DescriptionLongue,                                                   
                              'id' => $id ));
        
        header('location: ../index.php');
    }
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
    
}
 elseif ($table='animaux')
 {
    try
    {
        
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);
    
        $query = $db->prepare('UPDATE animaux SET type = :type,
                                                   nom = :nom,
                                                   dateDeNaissance = :dateDeNaissance,
                                                   genre = :genre,
                                                   idSoignant = :idSoignant');
        $query->execute(array( 'type' => $type,
                              'nom'=>$nom,
                              'dateDeNaissance' => $dateDeNaissance,
                              'genre' => $genre,
                              'idSoignant' => $idSoignant));
        
        header('location: ../index.php');
    }
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
}

    
    
?>