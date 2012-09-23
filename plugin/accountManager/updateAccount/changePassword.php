<?php
	require_once ('config/global.php');
	
	global $em;
	
	$member = $_SESSION["member"];
	$passwordOK = $_POST['password'] == $_POST['passwordBis'] &&
				  md5($_POST['passwordOld']) == $member->getPassword();
	
	if($passwordOK) {
		$member->setPassword(md5($_POST['password']));
	$em->merge($member);
	$em->flush();
}
?>