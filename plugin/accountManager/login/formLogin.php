<div id="lightboxParam" data="{title:'Connection',draggable: false,height:'auto',width:350,modal:true,resizable:false}"/>
<form id="formLogin" name="formLogin" action="@login.html" method="post">
	<p>Identifiant: <input type="text" name="login" /></p>
	<p>Mot de passe: <input type="password" name="password" /></p>
	<p id="wrongPassword" class="ui-state-error" align="center" style="display: none">
		<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
		Vous avez saisie un mot de passe ou un identifiant incorrecte.
	</p>
	<p>Pas encore inscrit ? C'est par ici: <a class="formLink openLightbox" href="?p=formJoin">S'inscrire</a>.</p>
	<p><a class="formLink openLightbox" href="?p=forgottenPassword">Mot de passe oublié</a></p>
	<button type="submit">Connection !</button>
</form>