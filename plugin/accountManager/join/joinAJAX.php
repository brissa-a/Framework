<?php
	require_once ('config/global.php');
	global $em;
	if ($em->getRepository("Member")->findOneBy(array("login" => $_POST["login"])) == null) {
		echo "true";
	} else {
		echo "false";
	}
?>