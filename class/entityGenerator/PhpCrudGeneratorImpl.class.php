<?php

include_once "./PhpCrudGenerator.class.php";

class PhpCrudGeneratorImpl extends PhpCrudGenerator{

	protected function generateDate($entity, $field) {
		$fieldName = $this->formName($entity, $field);
		fwrite($this->outputfilec,
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '(DateTime::createFromFormat("d/m/Y", $_POST["' . $fieldName . '"]));
');

	}

	protected function generateDateTime($entity, $field) {
		$fieldName = $this->formName($entity, $field);
		fwrite($this->outputfilec,
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '(DateTime::createFromFormat("d/m/Y H:i", $_POST["' . $fieldName . '"]));
');
	
	}

	protected function generateString($entity, $field) {
		$fieldName = $this->formName($entity, $field);
		fwrite($this->outputfilec,
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '($_POST["' . $fieldName . '"]);
');
	}

}
?>