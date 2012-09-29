<?php

namespace Generator;
include_once "./ActionCreateUpdate.class.php";

class ActionCreateUpdateImpl extends ActionCreateUpdate{

	protected function generateDate($entity, $field) {
		$fieldName = $this->formName($entity, $field);
		$this->write(
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '(DateTime::createFromFormat("d/m/Y", $_POST["' . $fieldName . '"]));
');

	}

	protected function generateDateTime($entity, $field) {
		$fieldName = $this->formName($entity, $field);
		$this->write(
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '(DateTime::createFromFormat("d/m/Y H:i", $_POST["' . $fieldName . '"]));
');
	
	}

	protected function generateString($entity, $field) {
		$fieldName = $this->formName($entity, $field);
		$this->write(
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '($_POST["' . $fieldName . '"]);
');
	}

}
?>