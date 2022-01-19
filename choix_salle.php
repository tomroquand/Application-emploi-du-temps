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
        $numequi=$_POST['numequi'];
        $date=$_POST['date'];
        $debut=$_POST['debut'];
        $fin= date('h:i:s A', strtotime($debut)+7200);
        
        
        
        ////////////////////////////VERIFICATION QUE LE CRÉNEAU NE SOIT PAS DEJA OCCUPE/////////////////////////////////
    
        //OBJECTIF : aucun des elèves du groupe concerné ne doit avoir cours
            
        // --> RECUPERER LES IDENTIFIANTS DES ETUDIANTS AYANT COURS SUR CETTE INTERVALLE DE TEMPS
        $sqlcours = "SELECT nume from etudiant where nume in (select nume from groupe_etudiant natural join groupe natural join creneau where date_c = '$date' 
                        AND (debut_c between '$debut' and '$fin') OR (fin_c between '$debut' and '$fin'))";
        $resultatcours=pg_query($sqlcours);
        if (!$resultatcours)
        { 
            echo "Aucun etudiant n'a cours sur cette plage horaire";
        } 
    
        // --> FAIRE UNE AUTRE REQUETE POUR AVOIR TOUS LES ETUDIANTS DU GROUPE CONCERNE PAR LE COURS QUE L'ON VEUT CREER
        $sqleleve = "SELECT nume from etudiant natural join groupe_etudiant natural join groupe where numg = $numg";        
        
        $resultateleve=pg_query($sqleleve);
        if (!$resultateleve)
        { 
            echo "Probleme lors du lancement de la requete";
            exit;
        } 
    
        // --> VERFIFIER QUE AUCUN ETUDIANT N'EST DANS LES DEUX LISTES EN MM TEMPS (I.E : AUCUN ETUDIANT A DEJA COURS)    
        $condition = true;
    
        $ligne_eleve=pg_fetch_array($resultateleve);
        $ligne_cours=pg_fetch_array($resultatcours);
    
        while($ligne_eleve && $condition==true)
        {
            while($ligne_cours && $condition==true)
            {
                if($ligne_eleve['nume'] == $ligne_cours['nume'])
                {
                    $condition = false;
                }
                $ligne_cours=pg_fetch_array($resultatcours);
            }
            $ligne_eleve=pg_fetch_array($resultateleve);
        }
        if ($condition==false){
            echo "Au moins un des etudiants a deja cours sur cette plage horaire";
            exit;
        }
        
    
        ///////////////////////////**FIN VERIFICATION///////////////////////////
    
        
        
        
        // --> RECCUPERER TOUTES LES SALLES QUI ONT UNE CAPACITÉ SUFFISANTE ET LE BON EQUIPEMENT
        $salle = "select * from salle where capacite > (select count(nume) from etudiant natural join groupe natural join creneau where numc = $numc)
                            and nums in (select nums from salle_equipement where numequi = $numequi)";
        $resultatsalle=pg_query($salle);

        //verification resultat
        if (!$resultatsalle)
        { 
            echo "Probleme lors du lancement de la requete (aucune salle compatible?)";
            exit;
        }
        
        $ligne=pg_fetch_array($resultatsalle);

        ?>

        <table border = 1>
        <form action = "select_salle.php" method = POST>
        <tr><th></th>
        <th>NOM</th>

        </tr>

        <?php 
        //tant que la ligne n'est pas vide..

        while ($ligne)
        {
        ?>
            <tr>
            <td><input type = "radio" name = "nums" value = "<?php echo $ligne['nums']?>"></td>
            <td><?php echo $ligne['noms']?></td>
            </tr>
        <?php $ligne=pg_fetch_array($resultatsalle);	
        }
        
        //ON MET LES DONNEES QUE L'ON CEUT UTILISER DANS SELECT_SALLE EN TYPE CACHE POUR LES RECUPERER APRES 
        
        ?>
    
            <tr><input type = "hidden" name = "numc" value = "<?php echo $numc?>"><tr>
            <tr><input type = "hidden" name = "date" value = "<?php echo $date?>"><tr>
            <tr><input type = "hidden" name = "debut" value = "<?php echo $debut?>"><tr>
            <tr><input type = "hidden" name = "fin" value = "<?php echo $fin?>"><tr>
            
        </table>

        <p>
            <input type="submit" value = "Valider">
            <input type ="reset" value = "Annuler">
        </p>
        
        <br/>
        <br/>
        <a href="index.php" >Retour accueil</a>

</body>
</html>    
