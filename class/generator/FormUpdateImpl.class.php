<?php

namespace Generator;
include_once "./FormCreateImpl.class.php";

class FormUpdateImpl extends FormCreateImpl {

	public function getOutputFilename($entity) {
		return $this->outputdir . "/formUpdate" . $entity['name'] . ".php";
	}

	public function getCreateOrUpdate() {
		return "update";
	}

	protected function generateIntegerInput($inputElement, $entity, $field) {
		parent::generateIntegerInput($inputElement, $entity, $field);
		$inputElement['value'] = '<?php echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '(); ?>';
			}

	protected function generateStringInput($inputElement, $entity, $field) {
		parent::generateStringInput($inputElement, $entity, $field);
		$inputElement['value'] = '<?php echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '(); ?>';
	}

	protected function generateDateInput($inputElement, $entity, $field) {
		parent::generateDateInput($inputElement, $entity, $field);
		$inputElement['value'] = '<?php echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '()->format("d/m/Y"); ?>';
	}

	protected function generateDatetimeInput($inputElement, $entity, $field) {
		parent::generateDatetimeInput($inputElement, $entity, $field);
		$inputElement['value'] = '<?php echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '()->format("d/m/Y H:m"); ?>';
	}

}
?>