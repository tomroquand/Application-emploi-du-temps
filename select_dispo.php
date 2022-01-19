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

        $date=$_POST['date'];
        $heure=$_POST['heure'];
        
    
        
        // --> RECCUPERER TOUTES LES SALLES QUI ONT LE BON EQUIPEMENT ET SONT DISPO
        $salle = "select * from salle where nums not in 
                    (select nums from salle natural join creneau_salle natural join creneau where date_c = '$date' and '$heure' between debut_c and fin_c)";
        $resultatsalle=pg_query($salle);

        //verification resultat
        if (!$resultatsalle)
        { 
            echo "Probleme lors du lancement de la requete (aucune salle compatible?)";
            exit;
        }
        
        $ligne=pg_fetch_array($resultatsalle);

        ?>

        <table>
        <th>SALLES DISPONIBLES à <?php echo $heure," le ",$date?></th>

        </tr>

        <?php 
        //tant que la ligne n'est pas vide..

        while ($ligne)
        {
            $numero = settype($ligne['nums'], "integer");
            $equi = "select * from equipement natural join salle_equipement where nums = $numero";
            $resultatequi = pg_query($equi);
            
            $equipement = pg_fetch_array($resultatequi);
        ?>
            <tr>
            <td><?php echo $ligne['noms']?></td>
            
            <?php
                while($equipement)
                {   
                    ?>
                    <td><?php echo $equipement['nomequi'], "  |"?></td>
                    <?php
                    
                    $equipement = pg_fetch_array($resultatequi);
                }
            ?>
            
            </tr>
            
            
        <?php $ligne=pg_fetch_array($resultatsalle);	
        }

            echo "\n\n",'<a href="index.php" >Retour accueil</a>';
        ?>
        </table>

</body>
</html>    
