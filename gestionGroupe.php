<?php
session_start();// VERIFIER LE FONCTIONNEMENT DE CETTE PAGE
include('include/menu.php');

$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe'];


$Connexion = mysql_connect($Server,$LoginBD,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase);

//Cette requ^te va vérifier si des utlisaurs ont fait une demande d'appartenance au groupe
$sql="select Etat from appartient where Etat=0 and IDgroupe = $IDgroupe	";
$monRS=mysql_query($sql,$Connexion)or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
$nbtuple=mysql_num_rows($monRS);

if($nbtuple!=0)
{
	echo("Vous avez $nbtuple demande d'appartenance au groupe.");
    echo('<div id = container>
    <a href="quitGroup.php"><button class="submit">Quitter le groupe</button></a></div>');
}
//Cette requete va récuperer les utilisateurs en attente d'acceptation d'apartenance au groupe
$grosseRequete="SELECT utilisateurs.IDutilisateur,Login,mail,nom,prenom,IDgroupe
                FROM appartient,utilisateurs
                WHERE appartient.IdUtilisateur=utilisateurs.IDutilisateur
                AND Etat=0
                AND IDgroupe = $IDgroupe;";
$pitiQuery=mysql_query($grosseRequete,$Connexion)or die ('erreur SQL !'.$grosseRequete.'<br/>'.mysql_error());

//Cette requête va récupérer tous les utilisateurs appartenant au groupe
$grosseRequete2="SELECT utilisateurs.IDutilisateur,Login,mail,nom,prenom,IDgroupe
                FROM appartient,utilisateurs
                WHERE appartient.IdUtilisateur=utilisateurs.IDutilisateur
                AND Etat=1
                AND IDgroupe = $IDgroupe;";
$pitiQuery2=mysql_query($grosseRequete2,$Connexion)or die ('erreur SQL !'.$grosseRequete2.'<br/>'.mysql_error());


$RequeteInfo = "SELECT * 
                FROM groupe
                WHERE IDgroupe = $IDgroupe";
$ResInfo=mysql_query($RequeteInfo,$Connexion)or die ('erreur SQL !'.$RequeteInfo.'<br/>'.mysql_error());
$ResInfo = mysql_fetch_array($ResInfo); 
  echo("<form id='createCompte' method= 'post' action='TraitementModifGroupe.php'>");
  echo("    
    <input type = 'text' name = 'nom' value='".$ResInfo['nomGroupe']."' readonly='true' class = 'disable' required>
    <input type = 'url' name = 'urlPhoto' value='".$ResInfo['imageUrl']."' required>
    <textarea placeholder='Description de votre évènement' rows='10' cols='70' name='description'>".$ResInfo['Description']."</textarea>
    <input type = 'text' name = 'IdEvenement' hidden value = '".$ResInfo['IDgroupe']."'>
    <input class = 'submit' type = 'submit' value = 'Valider Modification'> 
    </form>
  ");

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
	echo("<h2>Vous n'avez pas de demande d'appartenance à ce groupe pour l'instant.</h2>");
}

include('include/footer.php');

 ?>