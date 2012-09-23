<div id="lightboxParam" data="{title:'Mot de passe oublié',draggable:false,height:'auto',width:450,modal:true,resizable:false}"/>
<form id="forgottenPassword" name="forgottenPassword" action="@sendNewPassword.html" method="post">
	<p>
		<label for="password">Entrez votre login</label>
		<input class="required" type="text" name="login" />
	</p>
	<p align="center">Vous recevrez un mail avec un nouveau mot de passe temporaire.</p>
	<button type="submit">Valider</button>
</form>