<?php 
	session_start();
	include('include/menu.php');
	$IdEvenement = $_GET['Id'];
	$IdUser = $_SESSION['idUser'];	

	
	$Connexion = mysql_connect($Server,$LoginBD,$MDP);
	mysql_select_db($MaBase);
	
	//Requete pour récupérer les informations de l'évènement
	$query = "SELECT * FROM Evenements WHERE IdEvenement = $IdEvenement";
	$Res = mysql_query($query,$Connexion) or die('Erreur SQL 1 !'.$query.'<br />'.mysql_error());
	$Res = mysql_fetch_array($Res);
	$IdUserCreator = $Res['IdUtilisateur'];
	$IdEvenement = $Res['IdEvenement'];

	//Requete pour vérifier si l'évènement est lié à un groupe
	$queryPrive  = "SELECT * FROM relier WHERE relier.IdEvenement = $IdEvenement";
	$ResPrive = mysql_query($queryPrive,$Connexion);

	//Si il s'agit d'un évènement privé, on vérifie que l'utilisateur appartient au groupe corrspondant
	if(mysql_num_rows($ResPrive) != 0)
	{
		$ArrayPrive = mysql_fetch_array($ResPrive);
		$IdGroupe = $ArrayPrive['IDGroupe'];
		$queryVerif = "SELECT * FROM appartient WHERE IDutilisateur = $IdUser AND IDgroupe = $IdGroupe";
		$ResVerif = mysql_query($queryVerif,$Connexion) or die('Erreur SQL 1 !'.$queryVerif.'<br />'.mysql_error());
		if(mysql_num_rows($ResVerif) == 0)
		{
			echo('Cet évènement est privé, vous ne pouvez y accéder.');
			include('include/footer.php');
			die();
		}

	}
	
	//Reque pour récupérer les informations de l'utilisateurs courant
	$query2 = "SELECT * FROM utilisateurs WHERE IdUtilisateur = '$IdUser'";
	$Res2 = mysql_query($query2,$Connexion) or die('Erreur SQL 1 !'.$query2.'<br />'.mysql_error());
	$Res2 = mysql_fetch_array($Res2);


	echo ("<h2>".$Res['NomEvenement']."</h2>");
	echo("<img src='".$Res['UrlPhoto']."' alt='Photo de évènement'/>");
	echo("<p> Créateur de l'évènement : ".$Res2['Login']."</p>");
	echo("<p> Description de l'évènement : ".$Res['Description']."</p>");
	echo("<p> Début de l'évènement : ".$Res['DateEvenement']."</p>");
	echo("<p> Fin de l'évènement : ".$Res['DateFinEvenement']."</p>");
	echo("<p> Prix de l'évènement : ".$Res['Prix']."€</p>");
	echo("<p> Lieu de l'évènement : ".$Res['Adresse']." ".$Res['CodePostal'].", ".$Res['Ville']."</p>");

	//Récupère la liste des participants à l'évènement
	$queryUser = "SELECT * FROM Utilisateurs NATURAL JOIN participe WHERE participe.IdEvenement = $IdEvenement";
	$Res3 = mysql_query($queryUser, $Connexion) or die('Erreur SQL 1 !'.$queryUser.'<br />'.mysql_error());
?>


<div id="Participants">
<h3>Participants</h3>
<?php
	while ($row = mysql_fetch_assoc($Res3)) {
		$mailGrav = md5($row['mail']);
		echo('<img id="imageprofil" src="http://www.gravatar.com/avatar/'.$mailGrav.'?s=50" alt="Image de profil"/>');
		echo("<a href='pagePerso.php?User=".$row['Login']."'>".$row['Login']."</a>");
		echo("</br>");
	}
?>
</div>
<?php
	
	if($_SESSION['idUser'] == $IdUser)
		echo ('<a href="ModifierEvenement.php?IdEvenement='.$IdEvenement.'"><button class="submit">Modifier cet évènement</button></a>');
	else
	{
		$queryIdUser = "Select IdUtilisateur From Utilisateurs NATURAL JOIN participe WHERE participe.IdEvenement = $IdEvenement";
		$Res4 = mysql_query($queryIdUser, $Connexion) or die('Erreur SQL 1 !'.$queryIdUser.'<br />'.mysql_error());
		$i = 0;
		while($row = mysql_fetch_assoc($Res4))
		{
			$TabIdParticipants[$i] = $row['IdUtilisateur'];
			$i++;
		}
		
		if(in_array($_SESSION['idUser'],$TabIdParticipants))
			echo ('<a href="SeRetirer.php?IdEvenement='.$IdEvenement.'"><button class="submit">Ne plus participer à l\'évènement</button></a>');
		else
			echo ('<a href="ParticiperEvenement.php?IdEvenement='.$IdEvenement.'"><button class="submit">Participer à cet évènement</button></a>');
			
	}
	
?>
<div id="map"><div id="popup"></div></div>

<?php 
include('include/footer.php');
?>
<script>
function loadJSON()
{
	var adresse = encodeURI("<?php echo $Res['Adresse']." ".$Res['CodePostal']." ".$Res['Ville']?>");
   var data_file = "http://nominatim.openstreetmap.org/search?q="+adresse+"&format=json";
   var http_request = new XMLHttpRequest();
   try{
      // Opera 8.0+, Firefox, Chrome, Safari
      http_request = new XMLHttpRequest();
   }catch (e){
      // Internet Explorer Browsers
      try{
         http_request = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            http_request = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   http_request.onreadystatechange  = function(){
      if (http_request.readyState == 4  )
      {
		var txt = http_request.responseText.substring(1,http_request.responseText.length-1);
		var jsonObj = JSON.parse(txt);
		var longi = parseFloat(jsonObj.lon)
		var lati  = parseFloat(jsonObj.lat);
		console.log(longi);
		AfficherMap(longi, lati);
		
      }
   }
   http_request.open("GET", data_file, true);
   http_request.send();
}


function AfficherMap(longitude,latitude)
{
	console.info(latitude);
	console.info(longitude);
	
	var iconFeature = new ol.Feature({
		geometry: new ol.geom.Point(ol.proj.transform([longitude, latitude], 'EPSG:4326', 'EPSG:900913')),
		name: '<?php echo $Res['NomEvenement']; ?>',
	});
	var iconStyle = new ol.style.Style({
		image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
			anchor: [0.5, 46],
			anchorXUnits: 'fraction',
			anchorYUnits: 'pixels',
			opacity: 0.75,
			src: 'img/icon.png'
		}))
	});
	
	iconFeature.setStyle(iconStyle);
	
	var vectorSource = new ol.source.Vector({
	  features: [iconFeature]
	});

	var vectorLayer = new ol.layer.Vector({
	  source: vectorSource
	});

	
	var map = new ol.Map({
		view: new ol.View({
			center: ol.proj.transform([longitude, latitude], 'EPSG:4326', 'EPSG:900913'),
			zoom: 17
		}),
		layers: [
			new ol.layer.Tile({
				source: new ol.source.MapQuest({layer: 'osm'})
			}),
			vectorLayer
		],
		target: 'map'
	});
	
	var element = document.getElementById('popup');
	
	var popup = new ol.Overlay({
	  element: element,
	  positioning: 'bottom-center',
	  stopEvent: false
	});
	map.addOverlay(popup);
	
	
	// display popup on click
	map.on('click', function(evt) {
	  var feature = map.forEachFeatureAtPixel(evt.pixel,
		  function(feature, layer) {
			return feature;
		  });
	  if (feature) {
		var geometry = feature.getGeometry();
		var coord = geometry.getCoordinates();
		popup.setPosition(coord);
		$(element).popover({
		  'placement': 'top',
		  'html': true,
		  'content': feature.get('name')
		});
		$(element).popover('show');
	  } else {
		$(element).popover('destroy');
	  }
	});

	// change mouse cursor when over marker
	map.on('pointermove', function(e) {
	  if (e.dragging) {
		$(element).popover('destroy');
		return;
	  }
	  var pixel = map.getEventPixel(e.originalEvent);
	  var hit = map.hasFeatureAtPixel(pixel);
	  //map.getTarget().style.cursor = hit ? 'pointer' : '';
	});
}
</script>

