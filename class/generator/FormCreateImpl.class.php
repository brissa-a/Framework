<?php

namespace Generator;
include_once "./FormCreate.class.php";

class FormCreateImpl extends FormCreate{

	protected function generateIntegerInput($inputElement) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] : "";
		$inputElement['type'] = "text";
	}

	protected function generateStringInput($inputElement) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] : "";
		$inputElement['type'] = "text";
	}

	protected function generateDateInput($inputElement) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] + " date" : "date";
		$inputElement['type'] = "text";
	}

	protected function generateDatetimeInput($inputElement) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] + " datetime" : "datetime";
		$inputElement['type'] = "text";
	}	
}

?>