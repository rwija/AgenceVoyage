<?php
session_start();
 include('../functions/tools.php');
    include('../config/db.php');

       
    $table = protect($_GET['table']);

    // Test qu'aucun des champs n'est vide, sinon redirige vers le formulaire
    foreach($_POST as $key => $element)
    {
        
        if(empty($_POST[$key]))
        {
                        print_r($_POST[$key]);
            //header('location: ../?page=formAdd&table='.$table); 
        }
        else
        {
            $$key = $element;
        }
    }
//---------------------------------ajouter un voyage-------------------------------------//
  if($table=='voyage')
      {
       try
    {
           //----------upload des 2 images---------------    
           $uploads_directory = '../images/';
        $tmp_file = $_FILES['banniere']['tmp_name'];

        if(is_uploaded_file($tmp_file))
        {
            $type_file = $_FILES['banniere']['type'];

            if(strstr($type_file, 'jpg') or strstr($type_file, 'jpeg') or strstr($type_file, 'png') or strstr($type_file, 'gif'))
            {
                $basefilename = $_FILES['banniere']['name'];
                $searchinfilename = array('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_.]@');
                $replaceinfilename = array('e','a','i','u','o','c','_','');
                $finalfilename1 = uniqid().'-'.preg_replace($searchinfilename, $replaceinfilename, $basefilename);
                
                if(!move_uploaded_file($tmp_file, $uploads_directory . $finalfilename1))
                {
                    die('Impossible de copier le fichier dans '.$uploads_directory);
                } 
                
            }
        }
        
        $tmp_file = $_FILES['miniature']['tmp_name'];

        if(is_uploaded_file($tmp_file))
        {
            $type_file = $_FILES['miniature']['type'];

            if(strstr($type_file, 'jpg') or strstr($type_file, 'jpeg') or strstr($type_file, 'png') or strstr($type_file, 'gif'))
            {
                $basefilename = $_FILES['miniature']['name'];
                $searchinfilename = array('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_.]@');
                $replaceinfilename = array('e','a','i','u','o','c','_','');
                $finalfilename2 = uniqid().'-'.preg_replace($searchinfilename, $replaceinfilename, $basefilename);
                
                if(!move_uploaded_file($tmp_file, $uploads_directory . $finalfilename2))
                {
                    die('Impossible de copier le fichier dans '.$uploads_directory);
                } 
                
            }
        }
        //----------------------fin: upload--------------------
        
        //----------insertion dans la base de données---------------
    
        // Les erreurs doivent être renvoyées sous forme d'exception
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        // Ouverture de la connexion à la DB
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);

        // Préparation de la requête
        $query = $db->prepare('INSERT 
                 INTO voyage(name,localisation,idContinent,urlBanner,urlMiniature,DescriptionCourte,DescriptionLongue) 
                 VALUES(:name,:localisation,:Continent,:urlBanner,:miniature,:DescriptionCourte,:DescriptionLongue)');
        // Exécution de la requête
        $query->execute(array('name'=>$_POST['name'],
                              'localisation'=>$_POST['localisation'],
                              'Continent'=>$_POST['continent']['value'],
                              'urlBanner'=>$finalfilename1,
                              'miniature'=>$finalfilename2,
                              'DescriptionCourte'=>$_POST['DescriptionCourte'],
                               'DescriptionLongue'=>$_POST['DescriptionLongue']));

        // Redirection finale
        header('location: ../');
    }
    
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
    //-------------fin: insertion----------------------
   
      }
 //------------------------------------------fin: ajouter un voyage----------------------------
     

      
//-----------------------ajouter un hôtel--------------------      
      if($table=='hotel')
      {
       try
    {
           //----------upload des 2 images---------------    
           $uploads_directory = '../images/';
        $tmp_file = $_FILES['banniere']['tmp_name'];

        if(is_uploaded_file($tmp_file))
        {
            $type_file = $_FILES['banniere']['type'];

            if(strstr($type_file, 'jpg') or strstr($type_file, 'jpeg') or strstr($type_file, 'png') or strstr($type_file, 'gif'))
            {
                $basefilename = $_FILES['banniere']['name'];
                $searchinfilename = array('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_.]@');
                $replaceinfilename = array('e','a','i','u','o','c','_','');
                $finalfilename1 = uniqid().'-'.preg_replace($searchinfilename, $replaceinfilename, $basefilename);
                
                if(!move_uploaded_file($tmp_file, $uploads_directory . $finalfilename1))
                {
                    die('Impossible de copier le fichier dans '.$uploads_directory);
                } 
                
            }
        }
        
        $tmp_file = $_FILES['miniature']['tmp_name'];

        if(is_uploaded_file($tmp_file))
        {
            $type_file = $_FILES['miniature']['type'];

            if(strstr($type_file, 'jpg') or strstr($type_file, 'jpeg') or strstr($type_file, 'png') or strstr($type_file, 'gif'))
            {
                $basefilename = $_FILES['miniature']['name'];
                $searchinfilename = array('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_.]@');
                $replaceinfilename = array('e','a','i','u','o','c','_','');
                $finalfilename2 = uniqid().'-'.preg_replace($searchinfilename, $replaceinfilename, $basefilename);
                
                if(!move_uploaded_file($tmp_file, $uploads_directory . $finalfilename2))
                {
                    die('Impossible de copier le fichier dans '.$uploads_directory);
                } 
                
            }
        }
        //----------------------fin: upload--------------------
        
        //----------insertion dans la base de données---------------
    
        // Les erreurs doivent être renvoyées sous forme d'exception
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        // Ouverture de la connexion à la DB
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);

        // Préparation de la requête
        $query = $db->prepare('INSERT 
                 INTO hotel(name,adresse,longitude,Latitude,urlBanner,urlMiniature,DescriptionCourte,DescriptionLongue,idVoyage,etoil,piscineCauffee,annimauxAdmis,annimationEnfant,internet,pensionComplete) 
                 VALUES(:name,:adresse,:longitude,:Latitude,:urlBanner,:miniature,:DescriptionCourte,:DescriptionLongue,:idVoyage,:etoil,:piscineCauffee,:annimauxAdmis,:annimationEnfant,:internet,:pensionComplete)');
        // Exécution de la requête
        $query->execute(array('name'=>$_POST['name'],
                              'adresse'=>$_POST['adresse'],
                              'longitude'=>$_POST['longitude'],
                               'Latitude'=>$_POST['Latitude'],
                              'urlBanner'=>$finalfilename1,
                              'miniature'=>$finalfilename2,
                            'DescriptionCourte'=>$_POST['DescriptionCourte'],
                            'DescriptionLongue'=>$_POST['DescriptionLongue'],
                            'idVoyage'=>$_POST['idVoyage'],
                              'etoil'=>$_POST['etoil'],
                               'piscineCauffee'=>$_POST['piscineCauffee'],
                                'annimauxAdmis'=>$_POST['annimauxAdmis'],
                                'annimationEnfant'=>$_POST['annimationEnfant'],
                                'internet'=>$_POST['internet'],
                                'pensionComplete'=>$_POST['pensionComplete']
                                ));

        // Redirection finale
        header('location: ../');
    }
    
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
    //-------------fin: insertion----------------------
   
      }
//-------------------------fin: ajouter un hotel---------------------------------------------

//------------------------ajouter un utilisateur----------------------------------------------           
           
               elseif($table=='user')
           { 
                   $isAdmin=0;
            try
    {
        // Les erreurs doivent être renvoyées sous forme d'exception
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        // Ouverture de la connexion à la DB
        $db = new PDO($configDb['dbdriver'].':host='.$configDb['dbhost'].';dbname='.$configDb['dbname'],$configDb['dbuser'],$configDb['dbpass'],$pdo_options);

        // Préparation de la requête
        $query = $db->prepare('INSERT 
                 INTO user(nom,prenom,login,password,isAdmin) 
                 VALUES(:nom,:prenom,:login,:password,:isAdmin)');
         
        $query->execute(array('nom' => $nom,
                              'prenom'=>$prenom,
                              'login' => $login,
                              'password' => $password,
                              'isAdmin' => $isAdmin));

        // Redirection finale
        header('location: ../');
    }
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
           }
//--------------------------fin: ajouter un utilisateur--------------------------------------           
   
    
    
    
?>