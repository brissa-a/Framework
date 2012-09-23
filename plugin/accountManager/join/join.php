<?php
require_once ('config/global.php');

global $em;
$samePassword = $_POST["password"] == $_POST["passwordBis"];
$dontAlreadyExist = $em -> getRepository("Member") -> findOneBy(array("login" => $_POST["login"])) == null;

if ($samePassword && $dontAlreadyExist) {
	$newMember = new Member();
	$newMember -> setLogin($_POST["login"]);
	$newMember -> setPassword(md5($_POST["password"]));
	$newMember -> setFirstName($_POST["firstName"]);
	$newMember -> setFamilyName($_POST["familyName"]);
	$newMember -> setBirthDate(dateFrToDateTime($_POST["birthDate"]));
	$newMember -> setSubscribeDate(new DateTime());
	$newMember -> setIsActive(true);
	$newMember -> setLastConnection(new DateTime());
	$newContact = new Contact();
	$newContact -> setEmail($_POST["eMail"]);
	$newContact -> setTelFixe($_POST["telFixe"]);
	$newContact -> setTelMobile($_POST["telMobile"]);
	$newMember -> setContact($newContact);

	$newAddress = new Address();
	$newAddress -> setNumero($_POST["numero"]);
	$newAddress -> setRepetition($_POST["repetitions"]);
	$typeVoie = $em -> getRepository("TypeVoie") -> find((int)$_POST["typeVoie"]);
	$newAddress -> setTypeVoie($typeVoie);
	$newAddress -> setNomVoie($_POST["nomVoie"]);
	$newAddress -> setCodePostal($_POST["codePostal"]);
	$newAddress -> setVille($_POST["ville"]);
	$newMember -> setAddress($newAddress);

	$em -> persist($newMember);
	$em -> flush();
	$_SESSION["member"] = $newMember;
} else {
	error_log("Try to join with existing login");
}
?>
