<?php

namespace Generator;
include_once "./AbstractGenerator.class.php";

class ActionDelete extends AbstractGenerator {

	public function generateStartEntity($entity) {
		$this->open($this->getOutputFilename($entity));
		$this->write(
'<?php
$old' . $entity['name'] . ' = $em->find("' . $entity['name'] . '", $_GET["id"]);
$em->remove($old' . $entity['name'] . ');
$em->flush();
?>
');

	}

	public function generateStartField($entity, $field) {
	}

	public function generateEndEntity($entity) {
		$this->close();
	}

	public function getOutputFilename($entity) {
		return $this->outputdir . "/delete" . $entity['name'] . ".php";
	}

}
?>