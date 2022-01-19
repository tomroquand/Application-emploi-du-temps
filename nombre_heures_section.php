<html>
    <body topmargin="50" leftmargin="100" rightmargin="100">

        <h1>Calcul temps d'enseignement d'une section/promo</h1>
        
        <form action = "select_heures_section.php" method = POST>
        
        Choix section : <select type = "string" name = "spe">
                        <option value='IS'>IS</option>
                        <option value='GC'>GC</option>
                        <option value='MECA'>MECA</option>
                        <option value='PROD'>PROD</option>
                        <option value='MAT'>MAT</option>
                        <option value='GBA'>GBA</option>
                        <option value='SE'>SE</option>
                        <option value='2GU'>2GU</option>
                        <option value='2IA'>2IA</option></select>
        
        -     Du <input type = "date" name = "debut"> au <input type = "date" name = "fin">
        
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
