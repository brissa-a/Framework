<div id="lightboxParam" data="{title:'Inscription',draggable:false,height:'auto',width:450,modal:true,resizable:false}"/>
<form id="formJoin" name="formJoin" action="@join.html" method="post">

	<fieldset>
		<legend>Informations d'authentification</legend>
		<p>
			<label for="login">Identifiant:</label>
			<input class="required" type="text" name="login" id="login" />
		</p>
		<p>
			<label for="password">Mot de passe:</label>
			<input class="required" type="password" name="password" />
		</p>
		<p>
			<label for="passwordBis">Confirmation mot de passe:</label>
			<input class="required" type="password" name="passwordBis" />
		</p>
	</fieldset>
	
	<fieldset>
		<legend>Informations personnelles</legend>
		<p>
			<label for="voie">Nom:</label>
			<input class="required" type="text" name="familyName" />
		</p>
		<p>
			<label for="firstName">Prenom:</label>
			<input class="required" type="text" name="firstName" />
		</p>
				<p>
			<label for="birthDate">Date de naissance:</label>
			<input id="birthDate" class="required date" type="text" name="birthDate" />
		</p>
		<p>
			<label for="eMail">e-mail:</label>
			<input class="required email" type="text" name="eMail" />
		</p>
		<p class="spliter">Téléphone:</p>
		<p>
			<label for="telFixe">fixe:</label>
			<input class="digits" type="text" name="telFixe" minlength="10" maxlength="10"/>
		</p>
		<p>
			<label for="telMobile">mobile:</label>
			<input class="digits" type="text" name="telMobile" minlength="10" maxlength="10"/>
		</p>
		<p class="spliter">Adresse</p>
		<p>
			<label for="numero">No</label>
			<input class="required digits" type="text" name="numero" size="1"/>
		</p>
		<p>
			<label for="repetitions">Répétition:</label>
			<select class="" name="repetitions">
				<option></option>
				<option>bis</option>
				<option>ter</option>
				<option>quater</option>
			</select>
		</p>
		<p>
			<label for="typeVoie">Voie:</label>
			<select class="required" name="typeVoie">
				<?php include "plugin/accountManager/common/typeDeVoie.php";?>
			</select>
		</p>
		<p>
			<label for="nomVoie">Nom voie:</label>
			<input class="required" type="text" name="nomVoie"/>
		</p>
		<p>
			<label for="codePostal">Code Postal:</label>
			<input class="required digits" type="text" name="codePostal" maxlength="5"/>
		</p>
		<p>
			<label for="ville">Ville:</label>
			<input class="required" type="text" name="ville"/>
		</p>
	</fieldset>
	<button type="submit">Valider</button>
</form>