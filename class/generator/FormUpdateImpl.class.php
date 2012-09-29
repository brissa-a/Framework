<?php

namespace Generator;
include_once "./FormCreateImpl.class.php";

class FormUpdateImpl extends FormCreateImpl {

	public function getOutputFilename($entity) {
		return $this->outputdir . "/formUpdate" . $entity['name'] . ".php";
	}

	protected function generateIntegerInput($inputElement, $entity, $field) {
		parent::generateIntegerInput($inputElement, $entity, $field);
		$inputElement['value'] = '<?php echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '() ?>';
			}

	protected function generateStringInput($inputElement, $entity, $field) {
		parent::generateStringInput($inputElement, $entity, $field);
		$inputElement['value'] = '<?php echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '() ?>';
	}

	protected function generateDateInput($inputElement, $entity, $field) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] + " date" : "date";
		$inputElement['type'] = "text";
	}

	protected function generateDatetimeInput($inputElement, $entity, $field) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] + " datetime" : "datetime";
		$inputElement['type'] = "text";
	}

}
?>