<?php 
	session_start();
	include('include/menu.php');
	$IdEvenement = $_GET['IdEvenement'];
	
	$MaBase="projet_web";
	$Server = "localhost";
	$login="root";
	$MDP="";
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$query = "Select * FROM evenements WHERE IdEvenement = $IdEvenement";
	$Res = mysql_query($query,$Connexion);
	$Res = mysql_fetch_array($Res);

	print_r($Res);
	
	
	if($Res['IdUtilisateur'] != $_SESSION['idUser'])
	{
		echo("<h1>Vous ne disposez pas des autorisations necessaires pour modifier cet évènement");
		die();
	}

	echo("<form id='createCompte' method= 'post' action='TraitementModifEvent.php'>");
	echo("		
		<input type = 'text' name = 'nom' value='".$Res['NomEvenement']."' readonly='true' class = 'disable'>
		<input type = 'date' name = 'date' value='".$Res['DateEvenement']."'>
		<input type = 'text' name = 'adresse' value='".$Res['Adresse']."'>
		<input type = 'text' name = 'CodePostal' value='".$Res['CodePostal']."'>
		<input type = 'text' name = 'ville' value='".$Res['Ville']."'>
		<input type = 'url' name = 'urlPhoto' value='".$Res['UrlPhoto']."'>
		<textarea placeholder='Description de votre évènement' rows='10' cols='50' name='description'>".$Res['Description']."</textarea>
		<input type = 'text' name = 'IdEvenement' hidden value = '".$Res['IdEvenement']."'>
		<input class = 'submit' type = 'submit' value = 'Valider Modification'>	
	
	");
	echo("</form>");
	?>
	
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
	