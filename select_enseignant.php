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
    
    //////////////////////////RECUPERATION DE TOUT CE DONT OPN A BESOIN POUR CREER UN ENSEIGNANT/////////////////////////////////////
    
    $nomens=$_POST['nom'];
    $prenomens=$_POST['prenom'];
    
    //On va chercher l'identifiant de creneau le plus grand pour l'incrémanter et éviter les doublons
    $sql0="SELECT max(numens) from enseignant";
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
    
    ////////////////////////////**TOUTES LES DONNEES SONT RECUPEREES//////////////////////////////////////

    
    ////////////////////////////CREATION DU NOUVEL ENSEIGNANT////////////////////////////////////
    
    //On crée le cours  
    $sql2 = "INSERT INTO enseignant (numens, nomens, prenomens) VALUES ($numerosuiv, '$nomens', '$prenomens')";
    $resultat2=pg_query($sql2); 
    
    //(toujours)verifier que la requete a fonctionnÃ©
    if (!$resultat2)
    { 
        echo "Probleme lors du lancement de la requete\n\n";
        echo '<a href="index.php" >Retour accueil</a>';
        exit;
    }
    else 
    {
        echo "Le nouvel enseignant a bien été enregistré\n\n"; 
        echo '<a href="index.php" >Retour accueil</a>';
        exit;
    }
        
    
    ////////////////////////////**LE NOUVEL ENSEIGNANT EST CREE/////////////////////////////////////
?>

</body>
</html>
        
