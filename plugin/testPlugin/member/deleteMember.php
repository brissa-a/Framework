<?php
require_once ('config/global.php');

global $em;

$oldMember = $em->find("Member", $_REQUEST["member_id"]);
$em->remove($oldMember);
$em->flush();
?>
