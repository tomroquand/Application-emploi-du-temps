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
        
        $nums=$_POST['nums'];
        $numc=$_POST['numc']; 
         
        $sql="INSERT INTO creneau_salle(nums, numc) VALUES ($nums, $numc)";
        $resultat=pg_query($sql); 

        //(toujours)verifier que la requete a fonctionnÃ©
        if (!$resultat)
        { 
            echo "Probleme lors du lancement de la requete\n\n";
            echo '<a href="index.php" >Retour accueil</a>';
            exit;
        }
        else 
        {
            echo "La réservation de la salle a bien été prise en compte\n\n"; 
            echo '<a href="index.php" >Retour accueil</a>';
            exit;
        }
    ?>
</body>
</html>
