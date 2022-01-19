<html>
<head> 

</head>
    <body topmargin="50" leftmargin="100" rightmargin="100">

    <!--////////////////////////////////////////////////////////////////////////////////
    //////////////////////PARTIE SELECTION COURS///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////-->
        <table border = 1 align=left>
        <tr><th colspan="7" align="center">SELECTIONNER LE COURS POUR LEQUEL VOUS VOULEZ RESERVER UNE SALLE</th></tr>
        <form action = "choix_horaire_equipement.php" method = POST>
        <?php

            include("connexion.php");
            $con=connect();

            //verification connexion
            if (!$con)
            {
                echo "Probleme connexion a la base";
                exit;
            }
	
            // --> RECCUPERER TOUS LES COURS QUI N'ONT PAS DE SALLE ATTRIBUÉE (i.e. tous les créneaux ou les numc ne sont pas dans la classe creneau salle, et donc associés a aucune salle)
            $sql="select * from groupe natural join creneau natural join cours natural join module where numc in 
                    (select numc from creneau except select numc from salle natural join creneau_salle)";
            $resultat=pg_query($sql);

            //verification resultat
            if (!$resultat)
            { 
                echo "Probleme lors du lancement de la requete";
                exit;
            }
        
            //copie de la premiere ligne de resulat dans le tableau ligne
            $ligne=pg_fetch_array($resultat);

        ?>

        <tr><th></th>
        <th>GROUPE</th>
        <th>TYPE</th>
        <th>MODULE</th>
        </tr>

        <?php 
        //tant que la ligne n'est pas vide..

        while ($ligne)
        {
        ?>
            <tr>
            <td><input type = "radio" name = "numc" value = "<?php echo $ligne['numc']?>"></td>
            <td><?php echo $ligne['nomg']?></td>
            <td><?php echo $ligne['nomcours']?></td>
            <td><?php echo $ligne['nomm']?></td>
            <td><input type="hidden" name="numg" value="<?php echo $ligne['numg']?>"></td>
            </tr>
        <?php $ligne=pg_fetch_array($resultat);	
        } // j'ai mis une ligne cachée pour avoir numg plus tard
	
        ?>

        <p>
            <input type="submit" value = "Valider">
            <input type ="reset" value = "Annuler">
        </p>

        </form>
        
        <br/>
        <br/>
        
        <a href="index.php" >Retour accueil</a>
        
    
    </body>
</html>
