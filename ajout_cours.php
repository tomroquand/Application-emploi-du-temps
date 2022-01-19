<html>
    <body topmargin="50" leftmargin="100" rightmargin="100">

        <h1>Ajout d'un nouveau cours</h1>
        
        <form action = "select_cours.php" method = POST>
        
        <table>
        
            <tr><td>Module concerné : </td>
                <td><input type = "text" name = "module" required></tr></td>
                
            <tr><td>Type séance : </td>
                <td><select name = "nomcours">
                        <option value="CM">CM</option>
                        <option value="TD">TD</option>
                        <option value="TP">TP</option>
                        <option value="projet">projet</option></tr></td>
                
            <tr><td>Groupe (ex : IS3-TD1): </td>
                <td><input type = "text" name = "groupe" required></tr></td>
        
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
