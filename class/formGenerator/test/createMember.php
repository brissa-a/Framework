<?php
if (isset($_POST["id"])) {
	//Update
	$newMember = $em -> getRepository("Member") -> findOneBy(array("id" => $_POST["id"]));;		
} else {
	//Create
	$newMember = new Member();			
}
$newMember->setLogin($_POST["login"]);
$newMember->setPassword($_POST["password"]);
$newMember->setFirstName($_POST["firstName"]);
$newMember->setFamilyName($_POST["familyName"]);
$newMember->setBirthDate(DateTime::createFromFormat("d/m/Y H:i", $_POST["birthDate"]));
$newMember->setSubscribeDate(DateTime::createFromFormat("d/m/Y H:i", $_POST["subscribeDate"]));
$newMember->setLastConnection(DateTime::createFromFormat("d/m/Y H:i", $_POST["lastConnection"]));
//No generation function for type boolean
$em -> merge($newMember);
$em -> flush($newMember);
?>
