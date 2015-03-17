<?php include('include/menu.php'); ?>

<div id="container">
            <h1>Connexion à votre compte personnel</h1>
            <p class="center letterSpacing"><a href="inscription.php" class="lightColor">Pas de compte ?</a></p>
			<?php 
				if(isset($_GET['WrongPass']))
					echo('Erreur de connexion veuillez vérifier vos identifiants');

			?>
            <form id="formConnexion" method="post" action="Traitementconnexion.php">
                <input type="text" name="pseudo" placeholder="PSEUDO : prof" required />
                <input type="password" name="pass" placeholder="MOT DE PASSE : prof" required/>
                <input class = "submit" type="submit" value="Se Connecter" />
            </form>
</div>

<?php
include('include/footer.php');
?>