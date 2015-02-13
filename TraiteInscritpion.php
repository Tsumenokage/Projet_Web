<?php 
//se connecter à la base 
//requête avec un where pseudo = pseudo pour vérifier pseudo exist
// if pseudo exist alors header location...
$MaBase="projet_web"
$Server = "localhost";
$login="root";
$MDP="";
$Connexion = mysql_connect($Server,$login,$MDP);
mysql_select_db(projet_web);
$sql = SELECT Login FROM utilisateurs WHERE Login="'.$_POST['login']. '";
$sql2=SELECT mail FROM utilisateurs WHERE mail="'.$_POST['email'].'";
$res=mysql_query($sql,$Connexion) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
$res=mysql_query($sql2,$Connexion) or die('Erreur SQL !'.$sql2.'<br />'.mysql_error());

if(mysql_num_rows($res)!=0)
{
	header("location:inscription.php?LoginExist=1");
}
else if(mysql_num_rows($sql2)!=0)
{
	header("location:inscription.php?MailExist=1");
}
mysql_close();
 ?>