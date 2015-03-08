<?php 
	session_start();
	include('include/menu.php');
	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
?>
<div id = "container">
	<h1>Création d'un évènement</h1>
	<form id="createCompte" method= 'post' action='CreateEvent.php'/>
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
</script>

</body>
</html>