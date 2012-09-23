<?php
require_once ('config/global.php');
$member = $_SESSION["member"];
?>
<div id="lightboxParam" data="{title:'Modification compte',draggable: false,height:'auto',width:450,modal:true,resizable:false}"/>
<div id="formUpdate">
	<form name="formUpdateAuth" id="formUpdateAuth" action="@updatePassword.html" method="post">
		<fieldset>
			<legend>
				Informations d'authentification
			</legend>
			<p>
				<label for="user">Identifiant:</label>
				<input type="text" name="user" id="user" readonly="true"
				value='<?php echo $member -> getLogin(); ?>'/>
			</p>
			<p>
				<label for="passwordOld">Ancien mot de passe:</label>
				<input type="password" name="passwordOld"/>
			</p>
			<p>
				<label for="password">Nouveau mot de passe:</label>
				<input type="password" name="password"/>
			</p>
			<p>
				<label>Confirmation nouveau mot de passe:</label>
				<input type="password" name="passwordBis" />
			</p>
			<button type="submit">
				Changer de mot de passe
			</button>
		</fieldset>
	</form>

	<form name="formUpdatePerso" id="formUpdatePerso" action="@update.html" method="post">
		<fieldset>
			<legend>
				Informations personnelles
			</legend>
			<p>
				<label for="familyName"> Nom: </label>
				<input class="required" type="text" name="familyName"
				value='<?php echo $member -> getFamilyName(); ?>'/>
			</p>
			<p>
				<label for="firstName">Prenom:</label>
				<input class="required" type="text" name="firstName"
				value='<?php echo $member -> getFirstName(); ?>'/>
			</p>
			<p>
				<label for="birthDate">Date de naissance:</label>
				<input id="birthDate" class="required date" type="text" name="birthDate"
				value='<?php echo $member -> getBirthDate() -> format("d/m/Y"); ?>'/>
			</p>
			<p>
				<label for="eMail">e-mail:</label>
				<input class="required email" type="text" name="eMail"
				value='<?php echo $member -> getContact() -> getEmail(); ?>'/>
			</p>

			<p class="spliter">
				Téléphone:
			</p>
			<p>
				<label for="telFixe">fixe:</label>
				<input class="digits" type="text" name="telFixe" minlength="10" maxlength="10"
				value='<?php echo $member -> getContact() -> getTelFixe(); ?>'/>
			</p>
			<p>
				<label for="telMobile">mobile:</label>
				<input class="digits" type="text" name="telMobile" minlength="10" maxlength="10"
				value='<?php echo $member -> getContact() -> getTelMobile(); ?>'/>
			</p>

			<p class="spliter">
				Adresse
			</p>
			<?php $address = $member -> getAddress();?>
			<p>
				<label for="numero">No</label>
				<input class="required digits" type="text" name="numero" size="1" value='<?php echo $address -> getNumero(); ?>'/>
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
					<?php
					include "plugin/accountManager/common/typeDeVoie.php";
					?>
				</select>
			</p>
			<p>
				<label for="nomVoie" >Nom voie:</label>
				<input class="required" type="text" name="nomVoie" value='<?php echo $address -> getNomVoie(); ?>'/>
			</p>
			<p>
				<label for="codePostal">Code Postal:</label>
				<input class="required digits" type="text" name="codePostal" value='<?php echo $address -> getCodePostal(); ?>' maxlength="5"/>
			</p>
			<p>
				<label for="ville">Ville:</label>
				<input class="required" type="text" name="ville" value='<?php echo $address -> getVille(); ?>'/>
			</p>
			<button type="submit">
				Valider
			</button>
		</fieldset>
	</form>
</div>