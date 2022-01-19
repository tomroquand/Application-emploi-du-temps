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
            
            $numg = $_POST['numg'];
            $numc = $_POST['numc'];
	
            // --> RECCUPERER TOUS LES COURS QUI N'ONT PAS DE SALLE ATTRIBUÉE (i.e. tous les créneaux ou les numc ne sont pas dans la classe creneau salle, et donc associés a aucune salle)
            $sql="select * from etudiant where nume in (select nume from groupe_etudiant natural join creneau natural join cours where numg = $numg and numc = $numc)";
            $resultat=pg_query($sql);

            //verification resultat
            if (!$resultat)
            { 
                echo "Aucun étudiant associé";
                exit;
            }
        
            //copie de la premiere ligne de resulat dans le tableau ligne
            $ligne=pg_fetch_array($resultat);

        ?>
        
        <table border = 1 align=left>
        <tr><th colspan = 4 align="center">LISTE DES ETUDIANTS DU COURS</th></tr>

        <tr>
        <th>Numero</th>
        <th>Nom</th>
        <th>Prenom</th>
        </tr>

        <?php 
        //tant que la ligne n'est pas vide..

        while ($ligne)
        {
        ?>
            <tr>
            <td><?php echo $ligne['nume']?></td>
            <td><?php echo $ligne['nome']?></td>
            <td><?php echo $ligne['prenome']?></td>
            </tr>
        <?php $ligne=pg_fetch_array($resultat);	
        }	
        
        echo "\n\n",'<a href="index.php" >Retour accueil</a>';
        ?>
        </form>    
    </body>
</html>
