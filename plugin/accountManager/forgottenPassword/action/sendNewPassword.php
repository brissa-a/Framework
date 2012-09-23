<?php

global $em;
$member = $em->getRepository("Member")->findOneBy(array("login" => $_POST["login"]));

if (count($member)) {
	error_log($member->getFirstName() . " " . $member->getFamilyName() . " Change password");
	$new_password = generatePassword();
	$member->setPassword(md5($new_password));
	$em->merge($member);
	$em->flush();
	mail($member->getContact()->getEmail(), "Atelier Patissier - Changement de mot de passe",
		"Bonjour,\n\n Voici votre demande de nouveau mot de passe temporaire. Vous pouvez ensuite le changer dans \"Modifier mon compte\".\n\n
		Mot de passe: ".$new_password."\n\n".
		"A bientot pour de nouvelles aventures culinaires !");
	$this->result = "mailSended";
} else {
	$this->result = "loginNotFound";
}

?>