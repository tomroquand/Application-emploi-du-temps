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
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $debut = $_POST['debut'];
        $fin = $_POST['fin'];

        /*$nb_seances = "select count(numc) from creneau natural join groupe natural join groupe_etudiant
                        where nume = (select nume from etudiant where nome = '$nom' and prenome = '$prenom')
                        and date_c between '$debut' and '$fin'";
    
        $resultat=pg_query($nb_seances);
        
        $ligne = pg_fetch_row($resultat);
        
        echo "Nombre de séances de $nom $prenom entre le $debut et le $fin : ", $ligne; 
        
        --> je n'arrive pas à afficher le count, je change de méthode mais je laisse celle-ci car je la trouvais plus intuitive*/
        $nb_seances  = 0;
        
        $seances = "select numc from creneau natural join groupe natural join groupe_etudiant
                   where nume = (select nume from etudiant where nome = '$nom' and prenome = '$prenom')
                   and date_c between '$debut' and '$fin'";
        $resultat=pg_query($seances);
        
        $ligne = pg_fetch_array($resultat);
        
        while($ligne)
        {
            $nb_seances++;
            $ligne = pg_fetch_array($resultat);
        }
        
        $nb_seances = $nb_seances + $nb_seances; //un cours dure deux heures
        
        echo "Nombre d'heures de $nom $prenom entre le $debut et le $fin : ". $nb_seances.".\n\n";
        
        echo '<a href="index.php" >Retour accueil</a>';

    ?>
</body>
</html>    
