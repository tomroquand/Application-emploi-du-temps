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
        
        <form action = "select_dispo.php" method = POST>
        
            <tr><td>Date : </td>
                <td><input type = "date" name = "date"></tr></td>
            
            <tr><td>Heure : </td>
                <td><input type = "time" name = "heure" min="8:00" max="20:00"></tr></td>

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
