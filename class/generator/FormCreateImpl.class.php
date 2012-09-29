<?php

namespace Generator;
include_once "./FormCreate.class.php";

class FormCreateImpl extends FormCreate{

	protected function generateIntegerInput($attr, $entity, $field) {
		$attr['type'] = "text";
		$this->xmlUtils->all("input", $attr);
	}

	protected function generateStringInput($attr, $entity, $field) {
		$attr['type'] = "text";
		$this->xmlUtils->all("input", $attr);
	}

	protected function generateDateInput($attr, $entity, $field) {
		$attr['class'] = (isset($attr['class']) ? $attr['class'] : "") . " date";
		$attr['type'] = "text";
		$this->xmlUtils->all("input", $attr);
	}

	protected function generateDatetimeInput($attr, $entity, $field) {
		$attr['class'] = (isset($attr['class']) ? $attr['class'] : "") . " datetime";
		$attr['type'] = "text";
		$this->xmlUtils->all("input", $attr);
	}	
}

?>