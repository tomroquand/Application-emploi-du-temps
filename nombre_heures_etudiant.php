<html>
    <body topmargin="50" leftmargin="100" rightmargin="100">

        <h1>Calcul temps d'enseignement d'un étudiant</h1>
        
        <form action = "select_heures_etudiants.php" method = POST>
        
        <table>
        
            <tr><td>Nom : </td>
                <td><input type = "text" name = "nom"></tr></td>
                
            <tr><td>Prénom : </td>
                <td><input type = "text" name = "prenom"></tr></td>
                
            <tr><td>Du</td><td><input type = "date" name = "debut"></td><td> au <input type = "date" name = "fin"></td></tr>
        
        </table>
        
        <p>
            <input type="submit" value = "Valider">
            <input type = "reset" value = "Annuler">
        </p>
        </form>
        
        <br/>
        <br/>
        <a href="index.php" >Retour accueil</a>
        
        
    </body>
</html>
