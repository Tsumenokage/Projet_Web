<?php 
	session_start();
	include('include/menu.php');
	
	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
	$IdUser = $_SESSION['idUser'];
	
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	
	$sql ="SELECT DISTINCT nomGroupe FROM GROUPE INNER JOIN appartient WHERE appartient.IDutilisateur = $IdUser";
	$res=mysql_query($sql,$Connexion)or die('Erreur SQL 1 !'.$sql.'<br/>'.mysql_error());


	
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
		
		<input type = "text" name = "nom" placeholder="Nom de l'évènement:" required>
		<input type = "date" name = "date" placeholder="Date : jj/mm/aaaa" id="datepicker" required>
		<input type = "text" name = "adresse" placeholder="Adresse de l'évènement)" required>
		<input type = "text" name = "CodePostal" placeholder="Code Postal" required>
		<input type = "text" name = "ville" placeholder="Ville" required>
		<input type = "url" name = "urlPhoto" placeholder="URL Photo" required>
		<textarea placeholder="Description de votre évènement" rows="10" cols="70" name="description"></textarea>
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
		document.getElementById('ListeGroupes').innerHTML = "";
	}
	else
	{
		document.getElementById('ListeGroupes').innerHTML = "";
		var select = document.createElement('select');
		select.setAttribute('name','groupe');
		select.setAttribute('id','selectGroup');
		document.getElementById('ListeGroupes').appendChild(select);
		var arrayGroupe = {};
		<?php
		
		$i = 1;
		
		while($row = mysql_fetch_assoc($res))
		{
			echo"arrayGroupe[".$i."]='".$row['nomGroupe']."';";
			$i++;
		}
		
		?>
		console.info(arrayGroupe);
		
		for(var index in arrayGroupe)
		{
			    var opt = document.createElement('option');
				opt.value = arrayGroupe[index];
				opt.innerHTML = arrayGroupe[index];
				select.appendChild(opt);
		}
	}
	
}
</script>

<?php
include('include/footer.php');
?>