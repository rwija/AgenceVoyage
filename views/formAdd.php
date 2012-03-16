
<?php

   
    $table = protect($_GET['table']);

 //-------------form add voyage------------
        if($table=='voyage')
        {
            echo
        '
        <form method="POST" action="./process/Add.php?table='.$table.'" enctype="multipart/form-data">
            <fieldset>
                <label>Nom</label> <input type="text" name="name" value="" /><br />
                <label>Localisation</label> <input type="text" name="localisation" value="" /><br />';
            
  
    $query = $db->prepare('SELECT*FROM continent');
    $query->execute();
  
         
              echo' <label>Continent</label> <select name="continent"/>';
                While($data=$query->fetch())
                    {
              echo ' <option value="'.$data['id'].'">'.$data['name'].'</option>';
              
              }
              echo '<br />
                <label>bannière</label> <input type="file" name="banniere" value="" /><br />
                <label>miniature</label> <input type="file" name="miniature" value="" /><br />
                <label>Description courte</label> <input type="text" name="DescriptionCourte" value="" /><br />
                <label>Description longue</label> <input type="text" name="DescriptionLongue" value="" /><br />
                ';
                 }
//-------------form add hotel-------------------------        
        elseif($table=='hotel')
        {
          
                   echo
        '<form method="POST" action="./process/Add.php?table='.$table.'" enctype="multipart/form-data">
            <fieldset>
                <label>Nom</label> <input type="text" name="name" value="" /><br />
                <label>Adresse</label> <input type="text" name="adresse" value="" /><br />
                <label>Longitude</label> <input type="text" name="longitude" value="" /><br />
                <label>Latitude</label> <input type="text" name="Latitude" value="" /><br />
                <label>bannière</label> <input type="file" name="banniere" value="" /><br />
                <label>miniature</label> <input type="file" name="miniature" value="" /><br />
                <label>Description courte</label> <input type="text" name="DescriptionCourte" value="" /><br />
                <label>Description longue</label> <input type="text" name="DescriptionLongue" value="" /><br />
                 <label>étoil</label> <select name="etoil">';
               for($i=1;$i<=5;$i++)
               {
                    echo ' <option value="'.$i.'">'.$i.'</option>';
               }
               echo'</select>
                <br />
                <label>piscine chauffée</label>
                <input type="radio" name="piscineCauffee" value="oui" />oui
                <input type="radio" name="piscineCauffee" value="non" />non<br />
                <label>animaux admis</label> 
                <input type="radio" name="annimauxAdmis" value="oui" />oui
                <input type="radio" name="annimauxAdmis" value="non" />non<br />
                <label>animation enfant</label>
                <input type="radio" name="annimationEnfant" value="oui" />oui
                <input type="radio" name="annimationEnfant" value="non" />non<br />
                <label>internet</label>
                <input type="radio" name="internet" value="oui" />oui
                <input type="radio" name="internet" value="non" />non<br />
                <label>pension complete</label>
                <input type="radio" name="pensionComplete" value="oui" />oui
                <input type="radio" name="pensionComplete" value="non" />non<br />
                ';
                
 $query = $db->prepare('SELECT*FROM voyage');
    $query->execute();
                echo' <label>voyage</label> <select name="idVoyage"/>';
                While($data=$query->fetch())
                    {
                        echo ' <option value="'.$data['id'].'">'.$data['name'].'</option>';
              
                   }
                
         
        }
          

//----------------------form add user-------------------------          
             elseif($table=='user')
        {
               echo
        '
        <form method="POST" action="./process/Add.php?table='.$table.'">
            <fieldset>
             <legend>::INSCRIPTION::</legend>
                <label>Nom</label> <input type="text" name="nom" value="" /><br />
                <label>Prénom</label> <input type="text" name="prenom" value="" /><br />
                <label>login</label> <input type="text" name="login" value="" /><br />
                <label>mot de pass</label> <input type="password" name="password" value="" /><br />
                '; 
              
          }

  

        echo
        '
                <input type="submit" value="ajouter" />
            </fieldset>
        </form>
        ';
   

?>