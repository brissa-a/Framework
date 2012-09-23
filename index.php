<?php
	require_once ('config/global.php');
	session_start();
	$controller = new Controller();
	$controller->execute();
?>