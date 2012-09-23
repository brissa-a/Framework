<?php
	require_once ('config/global.php');
	
	global $em;
	$listTypeDeVoie = $em->getRepository("TypeVoie")->findBy(array());
	foreach ($listTypeDeVoie as $typeVoie) {
		// if (isset($member) && $member->getAddress()->getTypeVoie()->getId() == $typeVoie->getId()) {
			// echo "<option selected value='".($typeVoie->getId())."'>".($typeVoie->getLibelle())."</option>\n";
		// } else {
			echo "<option value='".($typeVoie->getId())."'>".($typeVoie->getLibelle())."</option>\n";
		//}
	}
?>