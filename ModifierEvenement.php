<?php 
	session_start();
	include('include/menu.php');
	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
	$IdEvenement = $_GET['IdEvenement'];	

	$Connexion = mysql_connect($Server,$LoginBD,$MDP);
	mysql_select_db($MaBase);
	
	$query = "Select * FROM evenements WHERE IdEvenement = $IdEvenement";
	$Res = mysql_query($query,$Connexion);
	$Res = mysql_fetch_array($Res);
	
	
	if($Res['IdUtilisateur'] != $_SESSION['idUser'])
	{
		echo("<h1>Vous ne disposez pas des autorisations necessaires pour modifier cet évènement");
		die();
	}

	echo("<form id='createCompte' method= 'post' action='TraitementModifEvent.php'>");
	echo("		
		<input type = 'text' name = 'nom' value='".$Res['NomEvenement']."' readonly='true' class = 'disable' required>
		<input id = 'datepickerDebut' type = 'date' name = 'date' value='".$Res['DateEvenement']."' required>
		<input id = 'datepickerFin' 	type = 'date' name = 'dateFin' value='".$Res['DateFinEvenement']."' required>
		<input type = 'date' name = 'prix' value='".$Res['Prix']."' required>		
		<input type = 'text' name = 'adresse' value='".$Res['Adresse']."'>
		<input type = 'text' name = 'CodePostal' value='".$Res['CodePostal']."' required>
		<input type = 'text' name = 'ville' value='".$Res['Ville']."' required>
		<input type = 'url' name = 'urlPhoto' value='".$Res['UrlPhoto']."'>
 		<textarea placeholder='Description de votre évènement' rows='10' cols='70' name='description'>".$Res['Description']."</textarea>
		<input type = 'text' name = 'IdEvenement' hidden value = '".$Res['IdEvenement']."'required>
		<input class = 'submit' type = 'submit' value = 'Valider Modification'required>		
	");
	
	echo("</form>
		<form id='createCompte' method= 'post' action='SuppressionEvenement.php'>
		<input type = 'text' name = 'IdEvenement' hidden value = '".$Res['IdEvenement']."'>
		<input class = 'submit' type = 'submit' value = 'Supprimer Evènement'>	
		</form>
		");
	?>

<script>
var initDatepicker = function() {
    $('#datepickerDebut').each(function() {
        var $input = $(this);
        var min = new Date();
        $input.datepicker({
            minDate : new Date(min.getFullYear(),min.getMonth(),min.getDate()),
            //minDate: $input.attr('min'),
            maxDate: $input.attr('max'),
            dateFormat: 'yy-mm-dd',
            onClose : function(selectedDate)
            {
            	if(selectedDate != "")
            	{
            		$('#datepickerFin').datepicker("option","minDate", selectedDate);
            	}
            }
        });
    });

    $('#datepickerFin').each(function() {
		var $input = $(this);
        var min = new Date();
        $input.datepicker({
            minDate : $('#datepickerDebut').datepicker('getDate'),
            //minDate: $input.attr('min'),
            maxDate: $input.attr('max'),
            dateFormat: 'yy-mm-dd'
        });
    });
};
 
if(!Modernizr.inputtypes.date){
    $(document).ready(initDatepicker);
};
</script>
<?php
include('include/footer.php');
?>
	