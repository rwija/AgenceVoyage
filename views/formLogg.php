<?php
echo
        '
        <form method="POST" action="./process/loguer.php">
            <fieldset>
             <legend>::CONNEXION::</legend>
                <label>login</label> <input type="text" name="login" value="" /><br />
                <label>mot de pass</label> <input type="password" name="password" value="" /><br />
                '; 
        echo
        '
                <input type="submit" value="go" />
            </fieldset>
        </form>
        ';

       
?>
