<html>
<head> 

</head>
    <body topmargin="50" leftmargin="100" rightmargin="100">
        <?php

            include("connexion.php");
            $con=connect();

            //verification connexion
            if (!$con)
            {
                echo "Probleme connexion a la base";
                exit;
            }
            
            $spe = $_POST['spe'];
            $debut = $_POST['debut'];
            $fin = $_POST['fin'];
            
	
            /////////////ON COMMENCE PAR CALCULER LE NOMBRE D'HEURES DE LA SPECIALITE///////////////
            $sql="select numc from creneau natural join groupe where nomg like '$spe%' and date_c between '$debut' and '$fin'";

            $resultat=pg_query($sql);

            //verification resultat
            if (!$resultat)
            { 
                echo "Aucune heure enregistrée";
                exit;
            }
        
            $ligne=pg_fetch_array($resultat);
            
            $nb_seances = 0;            
            while($ligne)
            {
                $nb_seances++;
                $ligne = pg_fetch_array($resultat);
            }
        
            $nb_seances = $nb_seances + $nb_seances; //un cours dure deux heures
        
            echo "Nombre d'heures des $spe entre le $debut et le $fin : ". $nb_seances.".\n\n";
            
            echo '<a href="index.php" >Retour accueil</a>';

        ?>
    </body>
</html>
