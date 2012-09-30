<?php

namespace Generator;
include_once "./AbstractGenerator.class.php";

class ActionDelete extends AbstractGenerator {

	public function generateStartEntity($entity) {
		$this->open($this->getOutputFilename($entity));
		$this->write(
'<?php
require_once (\'config/global.php\');

global $em;

$old' . $entity['name'] . ' = $em->find("' . $entity['name'] . '", $_REQUEST["' . strtolower($entity['name']) . '_id"]);
$em->remove($old' . $entity['name'] . ');
$em->flush();
?>
');

	}

	public function generateStartField($entity, $field) {
	}

	public function generateEndEntity($entity) {
		echo '
<action
	name="delete' . $entity['name'] . '"
	path="' . $this->getOutputFilename($entity) . '" />
		';
		$this->close();
	}

	public function getOutputFilename($entity) {
		return $this->outputdir . "/delete" . $entity['name'] . ".php";
	}

}
?>