<?php
if (isset($_POST["Address_id"])) {
	//Update
	$newAddress = $em -> getRepository("Address") -> findOneBy(array("id" => $_POST["Address_id"]));;		
} else {
	//Create
	$newAddress = new Address();			
}
//No generation function for type integer
$newAddress->setRepetition($_POST["address_repetition"]);
$newAddress->setNomVoie($_POST["address_nomvoie"]);
$newAddress->setCodePostal($_POST["address_codepostal"]);
$newAddress->setVille($_POST["address_ville"]);

$em -> merge($newAddress);
$em -> flush($newAddress);
?>
