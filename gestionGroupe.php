<?php
session_start();// VERIFIER LE FONCTIONNEMENT DE CETTE PAGE
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

$grosseRequete2="SELECT utilisateurs.IDutilisateur,Login,mail,nom,prenom,IDgroupe
                FROM appartient,utilisateurs
                WHERE appartient.IdUtilisateur=utilisateurs.IDutilisateur
                AND Etat=1
                AND IDgroupe = $IDgroupe;";
$pitiQuery2=mysql_query($grosseRequete2,$Connexion)or die ('erreur SQL !'.$grosseRequete2.'<br/>'.mysql_error());

echo("lalalalala");
if(mysql_num_rows($monRS)!=0)
{
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
}
else if(mysql_num_rows($monRS)==0)
{
	echo("<h2>Vous n'avez pas de demande d'appartenance à ce groupe pour l'instant.</h2>")
	echo("<h3>Personnes appartenant à votre groupe:</h3>")
	 while($row2=mysql_fetch_assoc($pitiQuery2)) 
    {

       echo("<fieldset>");
       echo("<p class='ID'><em>ID:</em>".$row2['Login']."</p><br/>");
       echo("<p class='Nom'><em>Nom:</em>".$row2['nom'] ."</p><br/>");
       echo("<p class='Prenom'><em>Prénom:</em>".$row2['prenom'] ."</p><br/>");
       echo("<p class='mail'><em>Mail:</em>".$row2['mail']."</p>");
       echo("</p>");
       echo('<div id = container>
       <a href="AccepterDemande.php?IDgroupe='.$IDgroupe.'&IdUser="'.$row2['IdUtilisateur'].'><button class="submit">Accepter</button></a></div>');
       echo("</fieldset>");

    }

}
else
{
	echo("Personne n'appartient à votre groupe.");

}


 ?>