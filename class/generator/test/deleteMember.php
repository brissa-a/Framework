<?php
$oldMember = $em->find("Member", $_GET["id"]);
$em->remove($oldMember);
$em->flush();
?>
