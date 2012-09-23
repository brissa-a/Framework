<?php

global $em;
$member = $em->getRepository("Member")->findOneBy(array("login" => $_POST["user"]));

if (count($member) && md5($_POST['password']) == $member->getPassword()) {
	echo "1";
} else {
	echo "0";
}
?>