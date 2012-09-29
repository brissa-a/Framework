<?php
if (isset($_POST["Member_id"])) {
	//Update
	$newMember = $em -> getRepository("Member") -> findOneBy(array("id" => $_POST["Member_id"]));;		
} else {
	//Create
	$newMember = new Member();			
}
$newMember->setLogin($_POST["member_login"]);
$newMember->setPassword($_POST["member_password"]);
$newMember->setFirstName($_POST["member_firstname"]);
$newMember->setFamilyName($_POST["member_familyname"]);
$newMember->setBirthDate(DateTime::createFromFormat("d/m/Y", $_POST["member_birthdate"]));
$newMember->setSubscribeDate(DateTime::createFromFormat("d/m/Y H:i", $_POST["member_subscribedate"]));
$newMember->setLastConnection(DateTime::createFromFormat("d/m/Y H:i", $_POST["member_lastconnection"]));
//No generation function for type boolean

$em -> merge($newMember);
$em -> flush($newMember);
?>
