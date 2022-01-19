<html>

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
        
            $promo = $_POST['promo'];
            $debut = $_POST['debut'];
            $fin = $_POST['fin'];
            
            $sql="select numc from creneau natural join groupe where nomg like '$promo%' and date_c between '$debut' and '$fin'";

            $resultat=pg_query($sql);

            //verification resultat
            if (!$resultat)
            { 
                echo "Aucune heure enregistrée";
                exit;
            }
        
            $ligne=pg_fetch_array($resultat);
            
            $nb_seances1 = 0;
            
            while($ligne)
            {
                $nb_seances1++;
                $ligne = pg_fetch_array($resultat);
            }
        
            $nb_seances1 = $nb_seances1 + $nb_seances1; //un cours dure deux heures
        
            echo "Nombre de séances des $promo entre le $debut et le $fin : " ,$nb_seances1,".\n\n";

            echo '<a href="index.php" >Retour accueil</a>';
        ?>


    </body>
</html>
