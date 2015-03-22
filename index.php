<?php
session_start();

include('include/menu.php');

?>

<div id='container'>    
    <div class="column">
        <h2>Services proposés</h2>
        <p class="lightColor">Vous trouverez sur notre site un service de gestion d'évènements.
        	Grâce à ce dernier il vous est possible de créer des évènements, mais égalements des groupes
        	pour lesquels vous pouvez y ratacher des évènements privés visible uniquement par les utilisateurs que vous aurez
        	accepté au sein de vos groupes.
    </div>

    <div class="column">
        <h2>A propos de nous</h2>
        <p class="lightColor">Réalisé dans le cadre de l'École Nationale Supérieure de Cognitique, nous avons réalisé 
        ce projet dont le but était de construire un site web de gestion des évènements 
        s'appuyant sur une base de données créée par nous même.
        <br/>
        En binôme, nous avons chacun participer à l'élaboration de ce mini-site, dont 
        les fonctionalités ont étées... <a href="about.php">lire la suite</a></p>
    </div>
</div>

<?php
include('include/footer.php');
?>