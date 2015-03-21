<?php 
// créer les variables $nomUser...
// gérer le insert into


$loginUser = $_POST["login"];
$mailUser = $_POST['email'];
$mdp1User=md5($_POST['mdp1']);
$mdp2User=md5($_POST['mdp2']);
$nomUser=($_POST['nom']);
$prenomUser=($_POST['prenom']);

$Connexion = mysql_connect($Server,$LoginBD,$MDP);
mysql_select_db($MaBase);

$sql  = "SELECT Login FROM utilisateurs WHERE Login='$loginUser'";
$sql2 = "SELECT mail FROM utilisateurs WHERE mail='$mailUser'";

$res=mysql_query($sql,$Connexion) or die('Erreur SQL 1 !'.$sql.'<br />'.mysql_error());
$res2=mysql_query($sql2,$Connexion) or die('Erreur SQL 2!'.$sql2.'<br />'.mysql_error());

if(mysql_num_rows($res)!=0)
{
	header("location:inscription.php?LoginExist=1");
}
else if(mysql_num_rows($res2)!=0)
{
	header("location:inscription.php?MailExist=1");
}
else if($mdp1User != $mdp2User)
{
	echo('Désolé, les mots de passe entrés ne correspondent pas.');
	header("location:inscription.php");

}
else
{
	$ReqBase = "INSERT INTO utilisateurs VALUES (null,'$loginUser','$mdp1User','$mailUser','$nomUser','$prenomUser')";
	$Res3 = mysql_query($ReqBase,$Connexion) or die('Erreur SQL 1 !'.$ReqBase.'<br />'.mysql_error());
	header("Location:connexion.php");
 
}
mysql_close();
 ?>