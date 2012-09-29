<?php
$oldAddress = $em->find("Address", $_GET["id"]);
$em->remove($oldAddress);
$em->flush();
?>
