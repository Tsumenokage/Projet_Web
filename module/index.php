<?php
include('phpscripts/functions.php');
$db = db_connect();
?>
<div id="chat">
	<h1>Mon super chat</h1>
    <?php
    // permettra de créer l'utilisateur lors de la validation du formulaire
    
    /* Si l'utilisateur n'est pas connecté, 
    d'où le ! devant la fonction, alors on affiche le formulaire */

 
    ?>		
	<table class="status">
		<tr>
    		<td>
    			<span id="statusResponse"></span>
    			<select name="status" id="status" style="width:200px;" onchange="setStatus(this)">
    				<option value="0">Absent</option>
    				<option value="1">Occup&eacute;</option>
    				<option value="2" selected>En ligne</option>
    			</select>
    		</td>
	   </tr>
	</table>
    <table class="chat"><tr>        
    <!-- zone des messages -->
    <td valign="top" id="text-td">
                <div id="annonce"></div>
        <div id="text">
            <div id="loading">
                <center>
                <span class="info" id="info">Chargement du chat en cours...</span><br />
                <img src="module/ajax-loader.gif" alt="patientez...">
                </center>
            </div>
        </div>
    </td>
            
    <!-- colonne avec les membres connectés au chat -->
    <td valign="top" id="users-td"><div id="users">Chargement</div></td>
</tr></table>
<!-- Zone de texte //////////////////////////////////////////////////////// -->
        <a name="post"></a>
    <table class="post_message"><tr>
        <td>
        <form action="" method="" onsubmit="postMessage(); return false;">
            <input type="text" id="message" maxlength="255" />
            <input type="button" onclick="postMessage()" value="Envoyer" id="post" />
        </form>
                <div id="responsePost" style="display:none"></div>
        </td>
    </tr></table>
</div>
    <?php
?>