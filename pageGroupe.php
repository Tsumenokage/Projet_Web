<?php 

session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="";

$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase); 

$idUser = $_SESSION['idUser']; 
echo($idUser);
$IDgroupe=$_GET['IDgroupe'];
echo($IDgroupe);
$Etat=$_GET['Etat'];



$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase); 
echo("<h1>Informations concernant le groupe</h1>");
$sql="select * from groupe where IDgroupe=$IDgroupe";
$query=mysql_query($sql,$Connexion) or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
$array=mysql_fetch_array($query);
echo("<p class='Informations'>");
echo("<fieldset>");
echo("<p class='Admin'><em>Administrateur du groupe:</em>".$array['IdUtilisateur']."</p><br/>");
echo("<p class='nomGroupe'><em>Nom du groupe:</em>    ".$array['nomGroupe'] ."</p><br/>");
echo("<p class='descritpion'><em>description:</em>    ".$array['description'] ."</p><br/>");
echo"<p class='image'><img src='".$array['imageUrl']."'/></p>";
echo("</fieldset>");
echo("</p>");

 if($array['IdUtilisateur']==$idUser)
 {
 	
         echo('<div id = container>
        <a href="gestionGroupe.php"><button class="submit">Gestion du groupe</button></a></div>');
 }
else if($Etat==0)
{
	echo("Votre demande d'appartenance au groupe $IDgroupe a bien été prise en compte. En attente de traitement.");
	echo ('<div id = container>
        <a href="quitGroup.php?IdUtilisateur='.$idUser.'& IDgroupe='.$IDgroupe.'"><button class="submit">Annulez la demande</button></a></div>');
}
 else
 {
    echo('<div id = container>
 	 	<a href="appartenirGroupe.php?IDgroupe='.$IDgroupe.'"><button class="submit">Appartenir à ce groupe</button></a></div>');
   
 }


 ?>

