<?php 
session_start();
include('include/menu.php');

	
$Connexion = mysql_connect($Server,$login,$MDP);
mysql_select_db($MaBase);
?>

<div id = 'container'>

<a href="CreationEvenement.php"><button class="submit">Créer un évènement</button></a>
<div id="searchIndex">
	<form action="rechercheEvenement.php" method="GET" onsubmit="return testSubmit(true);" >
						<input placeholder="Evenement..." name="nom" id ="inputNom" type="text"/>
						
						
                    <input type="image" value=" " id="submitImg" onclick="if (testSubmit()) return this.parentNode.submit();"/>

	</form>
</div>
<?php
if(isset($_SESSION['idUser']))
{
	
}

//Cette requête va récupérer les 10 évènements les plus populaires du site
	$query = "SELECT * FROM evenements WHERE IdEvenement IN ( SELECT IDEvenement FROM participe GROUP BY IDEvenement ORDER BY Count(*))
	AND IDEvenement NOT IN (SELECT IdEvenement FROM relier) AND EtatEvenement = 1 LIMIT 10;";
	$Res = mysql_query($query, $Connexion);
	echo("<h2>Top 10 Des évènements le plus populaires</h2>");
	echo "<div id='tableau'>";
	echo '<table>';
	echo "<th>Evènement</th>
		<th>Date</th>
		<th>Adresse</th>
		<th>Description</th>
		<th>Illustration</th>";
	while($row = mysql_fetch_assoc($Res))
	{
		echo "<tr>";
		echo "<td><a href='pageEvenement.php?Id=".$row['IdEvenement']."'>".$row['NomEvenement']."</a></td>";
		echo "<td>".$row['DateEvenement']."</td>";
		echo "<td>".$row['Adresse']." ".$row['CodePostal']." ".$row['Ville']."</td>";
		echo "<td>".$row['Description']."</td>";
		echo "<td><img src='".$row['UrlPhoto']."' height='100' width='100' /img></td>";
		echo "</tr>";
	}
	
	echo '</table>'; 	
	echo "</div>";

?>
</div>


<?php
include('include/footer.php');
?>      



<script type="text/javascript">
    function selectType(text, value) 
	{
		$('#select_type').attr('value', value);
        $('#type span').html(text);
    }
	
	function testSubmit(a) 
	{
        var elem = $('#inputNom');

        if (elem.val() != null && elem.val().trim().length > 0) {
            return true;
        } 
		else 
		{
            elem.addClass('inputEmpty');
            $("#errorMessage").remove();
            if (a) $("<p>").attr("id", "errorMessage").addClass("center").html("Veuillez saisir au moins une lettre de recherche.").appendTo("#content");
            return false;
        }
    }
</script>