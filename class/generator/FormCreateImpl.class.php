<?php

namespace Generator;
include_once "./FormCreate.class.php";

//TODO Les values soit vide lorsque c'est un nouvelle objet

class FormCreateImpl extends FormCreate{

	protected function generateIntegerInput($attr, $entity, $field) {
		$attr['type'] = "text";
		$attr['value'] = '<?php if (isset($' . strtolower($entity['name']) . ')){ echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '(); }?>';
		$this->xmlUtils->all("input", $attr);
	}

	protected function generateStringInput($attr, $entity, $field) {
		$attr['type'] = "text";
		$attr['value'] = '<?php if (isset($' . strtolower($entity['name']) . ')){ echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '();} ?>';
		$this->xmlUtils->all("input", $attr);
	}

	protected function generateDateInput($attr, $entity, $field) {
		$attr['class'] = (isset($attr['class']) ? $attr['class'] : "") . " date";
		$attr['type'] = "text";
		$attr['value'] = '<?php if (isset($' . strtolower($entity['name']) . ')){ echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '()->format("d/m/Y");} ?>';
		$this->xmlUtils->all("input", $attr);
	}

	protected function generateDatetimeInput($attr, $entity, $field) {
		$attr['class'] = (isset($attr['class']) ? $attr['class'] : "") . " datetime";
		$attr['type'] = "text";
		$attr['value'] = '<?php if (isset($' . strtolower($entity['name']) . ')){ echo $' . strtolower($entity['name']) . '->get' . ucfirst($field['name']) . '()->format("d/m/Y H:m");} ?>';
		$this->xmlUtils->all("input", $attr);
	}	
}

?>