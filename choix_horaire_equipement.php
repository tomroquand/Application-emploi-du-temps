<html>
<body topmargin="50" leftmargin="100" rightmargin="100">

    <?php
        include("connexion.php");
        $con=connect();
        //verification connexion
        if(!$con)
        {
            echo "Probleme connexion a la base";
            exit;
        }
    
        $numc=$_POST['numc'];
        $numg=$_POST['numg'];
        
        // --> RECCUPERER TOUS LES EQUIPEMENTS POSSIBLES 
        $equi = "select * from equipement"; 
        $resultatequi=pg_query($equi);
        
        //verification resultat
        if (!$resultatequi)
        { 
            echo "Probleme lors du lancement de la requete";
            exit;
        }
        
        $ligne=pg_fetch_array($resultatequi);

        ?>

        <table>
        
        <form action = "choix_salle.php" method = POST>
        
            <tr><td>Date : </td>
                <td><input type = "date" name = "date"></tr></td>
                
            <tr><td>Heure début : </td>
                <td><select type = "time" name = "debut">
                        <option value='8:00'>8:00</option>
                        <option value='10:15'>10:15</option>
                        <option value='13:45'>13:45</option>
                        <option value='16:00'>16:00</option>
                        <option value='18:00'>18:00</option></tr></td>
                
            <tr><td>Equipement nécessaire : </td>
                <td><select name = "numequi">
                        <?php
                        while ($ligne)
                        {
                            ?>
                            <option value = "<?php echo $ligne['numequi']?>"><?php echo $ligne['nomequi']?></option>
                            <?php $ligne=pg_fetch_array($resultatequi);
                            }
                            ?>
                            
            <tr><input type = "hidden" name = "numc" value = "<?php echo $numc?>"><tr>       
            <tr><input type="hidden" name="numg" value="<?php echo $numg?>"></tr>
        </table>
        
        <p>
            <input type="submit" value = "Ajouter">
            <input type = "reset" value = "Annuler">
        </p>
        
        <br/>
        <br/>
        <a href="index.php" >Retour accueil</a>
        

</body>
</html>
