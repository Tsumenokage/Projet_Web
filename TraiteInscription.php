<?php 
//se connecter à la base 
//requête avec un where pseudo = pseudo pour vérifier pseudo exist
// if pseudo exist alors header location...
$MaBase="projet_web";
$Server = "localhost";
$login="root";
$MDP="";

$loginUser = $_POST["login"];
$mailUser = $_POST['email'];
$mdpUser=md5($_POST['mdp']);

$Connexion = mysql_connect($Server,$login,$MDP);
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
else
{
	$ReqBase = "INSERT INTO utilisateurs VALUES (null,'$loginUser','$mdpUser','$mailUser','tata','yoyo')";
	$Res3 = mysql_query($ReqBase,$Connexion) or die('Erreur SQL 1 !'.$ReqBase.'<br />'.mysql_error());
 
}
mysql_close();
 ?>