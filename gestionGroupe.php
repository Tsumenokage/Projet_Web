<?php
session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="";

$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe'];


$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase);

$sql="select Etat from appartient where Etat=0 and IDgroupe = $IDgroupe	";
$monRS=mysql_query($sql,$Connexion)or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
$nbtuple=mysql_num_rows($monRS);

if($nbtuple!=0)
{
	echo("Vous avez $nbtuple demande d'appartenance au groupe.");
    echo('<div id = container>
    <a href="quitGroup.php"><button class="submit">Quitter le groupe</button></a></div>');
}

$grosseRequete="SELECT utilisateurs.IDutilisateur,Login,mail,nom,prenom,IDgroupe
                FROM appartient,utilisateurs
                WHERE appartient.IdUtilisateur=utilisateurs.IDutilisateur
                AND Etat=0
                AND IDgroupe = $IDgroupe;";

$pitiQuery=mysql_query($grosseRequete,$Connexion)or die ('erreur SQL !'.$grosseRequete.'<br/>'.mysql_error());


echo("<div id='titre'><strong><h3>La ou les personnes suivantes souhaitent appartenir à ce groupe:</h3></strong>");
while($row=mysql_fetch_assoc($pitiQuery)) 
{

 echo("<fieldset>");
 echo("<p class='ID'><em>ID:</em>".$row['Login']."</p><br/>");
 echo("<p class='Nom'><em>Nom:</em>".$row['nom'] ."</p><br/>");
 echo("<p class='Prenom'><em>Prénom:</em>".$row['prenom'] ."</p><br/>");
 echo("<p class='mail'><em>Mail:</em>".$row['mail']."</p>");
 echo("</p>");
 echo('<div id = container>
    <a href="AccepterDemande.php?IDgroupe='.$IDgroupe.'&IdUser="'.$row['IdUtilisateur'].'><button class="submit">Accepter</button></a></div>');
echo("</fieldset>");

}













 ?>