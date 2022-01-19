<html>
  <body topmargin="50" leftmargin="100" rightmargin="100">

        <h1>Ajout d'un nouvel enseignant</h1>
        
        <form action = "select_enseignant.php" method = POST>
        
        <table>
        
            <tr><td>Nom : </td>
                <td><input type = "text" name = "nom"></tr></td>

            <tr><td>Prénom : </td>
                <td><input type = "text" name = "prenom"></tr></td>
        
        </table>
        
        <p>
            <input type="submit" value = "Ajouter">
            <input type = "reset" value = "Annuler">
        </p>
        </form>
        
        <br/>
        <br/>
        <a href="index.php" >Retour accueil</a>
        
        
    </body>
</html>
