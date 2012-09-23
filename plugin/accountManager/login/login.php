<?php

global $em;
$member = $em->getRepository("Member")->findOneBy(array("login" => $_POST["login"]));

if (count($member) && md5($_POST['password']) == $member->getPassword()) {
	$admins = parse_ini_file("config/admin.ini");
	if (isset($admins[$_POST["login"]]) && $admins[$_POST["login"]] == md5($_POST['password'])) {
		$_SESSION["isAdmin"] = true;
	}
	$member->setLastConnection(new DateTime());
	$em->merge($member);
	$em->flush();
	$_SESSION["member"] = $member;
}
?>