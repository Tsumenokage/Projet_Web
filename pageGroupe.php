<?php 

session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="root";

$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe'];

$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase); 
echo("<h1>Informations concernant le groupe</h1>");
$sql="select * from groupe where IDgroupe=$IDgroupe";
$query=mysql_query($sql,$Connexion) or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
$array=mysql_fetch_array($query);
echo("<p class='Informations'>");
echo("<fieldset>");
echo("<p class='Admin'><em>Administrateur du groupe:</em>".$idUser."</p><br/>");
echo("<p class='nomGroupe'><em>Nom du groupe:</em>    ".$array['nomGroupe'] ."</p><br/>");
echo("<p class='descritpion'><em>description:</em>    ".$array['description'] ."</p><br/>");
echo"<p class='image'><img src='".$array['imageUrl']."'/></p>";
echo("</fieldset>");
echo("</p>");
 //$requete="select * from appartient where IDutilisateur=$idUser";
 //$RES=mysql_query($requete,$Connexion);
 /*echo ($idUser);
 if(mysql_num_rows($RES)!=0)
 {
 	echo('<div id = container>
 	 	< a href="quitGroupe.php"><button class="submit">Quitter le groupe</button></a></div>');
        
 }
 else
 {
    echo('<div id = container>
          < a href="appartenirGroupe.php"><button class="submit">Appartenir au groupe</button></a></div>');
 }*/

 ?>

