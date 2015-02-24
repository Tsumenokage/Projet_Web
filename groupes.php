<?php include('include/menu.php'); ?>
<div id = "container">
	<h1>Création de groupe</h1>
	<form id="createCompte" method= 'post' action='TraitementGroupe.php'>
		<?php   

		if(isset($_GET['nomGroupeExist']))
        {   
         	echo('<p><em>Ce nom est déjà utilisé par un groupe existant.</em></p>');
            header("location:groupes.php?");
        }
        ?>
		<fieldset>
		<input type = "text" name = "nomGroupe" placeholder="Nom du Groupe:"/><br/>
        <textarea name="description" id="description" placeholder ="Description de votre groupe" rows="10" cols="50"/></textarea><br/>
        <input type = "text" name = "imageUrl" placeholder="Copiez l'URL de l'image"/><br/>
        <input class = "submit" type = "submit" value = "Valider">	

        </fieldset>
    </form>
</div>
<?php
   if(isset($_GET['nomGroupeExist']));
   {
   	echo('<p>Ce nom est déjà utilisé par un groupe existant.</p>');
    header("location:groupes.php?");

   }
   
 ?>
