<?php
	require_once ('config/global.php');
	
	global $em;
	
	$member = $_SESSION["member"];
	$member->setFirstName($_POST["firstName"]);
	$member->setFamilyName($_POST["familyName"]);
	$member->setBirthDate(dateFrToDateTime($_POST["birthDate"]));
	
	$contact = $member->getContact();
	$contact->setEmail($_POST["eMail"]);
	$contact->setTelFixe($_POST["telFixe"]);
	$contact->setTelMobile($_POST["telMobile"]);
	
	$address = $member->getAddress();
	$address->setNumero($_POST["numero"]);
	$address->setRepetition($_POST["repetitions"]);
	$typeVoie = $em->getRepository("TypeVoie")->find((int)$_POST["typeVoie"]);
	$address->setTypeVoie($typeVoie);
	$address->setNomVoie($_POST["nomVoie"]);
	$address->setCodePostal($_POST["codePostal"]);
	$address->setVille($_POST["ville"]);
	$em->merge($member);
	$em->flush();
?>
