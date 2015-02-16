<?php 
	session_start();
	include('include/menu.php'); 
?>
<div id = "container">
	<h1>Création d'un évènement</h1>
	<form id="createCompte" method= 'post' action='CreateEvent.php'/>
		<input type = "text" name = "nom" placeholder="Nom de l'évènement:">
		<input type = "date" name = "date" placeholder="Date : jj/mm/aaaa">
		<input type = "text" name = "adresse" placeholder="Adresse de l'évènement)">
		<input type = "text" name = "CodePostal" placeholder="Code Postal">
		<input type = "text" name = "ville" placeholder="Ville">
		<input type = "url" name = "urlPhoto" placeholder="URL Photo">
		<input class = "submit" type = "submit" value = "Valider">	
	</form>
</div>
</body>
</html>