<?php
function connect()
{
$con=pg_connect("host=serveur-etu.polytech-lille.fr user=troquand password=postgres dbname=edt") ;
return $con;
}
?>
