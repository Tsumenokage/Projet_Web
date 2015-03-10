<?php 
	session_start();
	include('include/menu.php');
	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
	
	
	$MaBase="projet_web";
	$Server = "localhost";
	$login="root";
	$MDP="";
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	
	$query : "SELECT "
?>
<div id = "container">
	<h1>Création d'un évènement</h1>
	<form id="createCompte" method= 'post' action='CreateEvent.php'/>
	   <p>
       Veuillez indiquer si il s'agit d'un évènement public ou privé :<br />
       <input type="radio" name="age" value="public" id="public" onclick="Evenement();"/> <label for="public">Evènement public</label><br />
       <input type="radio" name="age" value="privé" id="privé" onclick="Evenement();"/> <label for="privé">Evènement privé</label><br />
	   </p>
	   <p id="ListeGroupes">
	   </p>
		<?php 
			if(isset($_GET['NameExist']))
			{
				echo('<p> Erreur un événement porte déjà ce nom</p>');
			}
		?>
		
		<input type = "text" name = "nom" placeholder="Nom de l'évènement:">
		<input type = "date" name = "date" placeholder="Date : jj/mm/aaaa" id="datepicker">
		<input type = "text" name = "adresse" placeholder="Adresse de l'évènement)">
		<input type = "text" name = "CodePostal" placeholder="Code Postal">
		<input type = "text" name = "ville" placeholder="Ville">
		<input type = "url" name = "urlPhoto" placeholder="URL Photo">
		<textarea placeholder="Description de votre évènement" rows="10" cols="50" name="description"></textarea>
		<input class = "submit" type = "submit" value = "Valider">	
	</form>
</div>

<script>
var initDatepicker = function() {
    $('input[type=date]').each(function() {
        var $input = $(this);
        $input.datepicker({
            minDate: $input.attr('min'),
            maxDate: $input.attr('max'),
            dateFormat: 'yy-mm-dd'
        });
    });
};
 
if(!Modernizr.inputtypes.date){
    $(document).ready(initDatepicker);
};

function Evenement()
{
	if(document.getElementById('public').checked)
	{
		alert('test');
	}
	else
	{
		alert('test2');
		var select = document.createElement('select');
		document.getElementById('ListeGroupes').appendChild(select);
	}
	
}
</script>

</body>
</html>