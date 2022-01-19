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
    
    //////////////////////////RECUPERATION DE TOUT CE DONT OPN A BESOIN POUR CREER LE COUR/////////////////////////////////////
    
    $nomm=$_POST['module'];
    $cours=$_POST['nomcours'];
    $nomgroupe=$_POST['groupe'];
    
    //On va chercher l'identifiant de creneau le plus grand pour l'incrémanter et éviter les doublons
    $sql0="SELECT max(numc) from creneau";
    $resultat0=pg_query($sql0);
    if (!$resultat0)
    { 
        echo "Probleme lors du lancement de la requete max cours";
        exit;
    } 
    else
    {
        $numero = pg_fetch_row($resultat0);
        $numerosuiv = $numero[0] + 1;
    }
    
    //On recherche le numéro du groupe demandé
    $sql1 = "SELECT numg from groupe where nomg = '$nomgroupe'";
    $resultatg=pg_query($sql1);
    if (!$resultatg)
    { 
        echo "Probleme lors du lancement de la requete";
        exit;
    }
    else
    {
        $g = pg_fetch_row($resultatg);
        $numg = $g[0]; 
    }
    
    //On cherche le cours qui va correspondre en fonction du module et du type de cours (par exemple module : mathématiques et cours : td)
    $sql3="SELECT numcours from cours natural join module where nomm ='$nomm' and nomcours='$cours'";
    $resultatc=pg_query($sql3);
    if (!$resultatc)
    { 
        echo "Probleme lors du lancement de la requete";
        exit;
    } 
    else
    {
        $c = pg_fetch_row($resultatc);
        $numc = $c[0];
    }
    
    ////////////////////////////**TOUTES LES DONNEES SONT RECUPEREES//////////////////////////////////////

    
    ////////////////////////////CREATION DU COURS////////////////////////////////////
    
    //On crée le cours  
    $sql2 = "INSERT INTO creneau (numc, date_c, debut_c, fin_c, numg, numcours) VALUES ($numerosuiv, NULL, NULL, NULL, $numg, $numc)";
    $resultat2=pg_query($sql2); 
    
    //(toujours)verifier que la requete a fonctionnÃ©
    if (!$resultat2)
    { 
        echo "Probleme lors du lancement de la requete, aucun groupe selectionné\n\n";
        echo '<a href="index.php" >Retour accueil</a>';
        exit;
    }
    else 
    {
        echo "Le cours a bien été enregistré\n\n"; 
        echo '<a href="index.php" >Retour accueil</a>';
        exit;
    }
        

    ////////////////////////////**LE COURS EST CREE/////////////////////////////////////
?>


</body>
</html>
        
