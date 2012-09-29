<?php
if (isset($_POST["Member_id"])) {
	//Update
	$newMember = $em -> getRepository("Member") -> findOneBy(array("id" => $_POST["Member_id"]));;		
} else {
	//Create
	$newMember = new Member();			
}
