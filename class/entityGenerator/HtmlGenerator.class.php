<?php

include_once "./Generator.class.php";

abstract class HtmlGenerator extends Generator {
	static private $map = array(
		"string" => "generateStringInput",
		"date" => "generateDateInput",
		"datetime" => "generateDatetimeInput"
	);

	private $formElement;
	private $outputdir;

	public function HtmlGenerator($outputdir) {
		$this->outputdir = $outputdir;
	}

	public function generateStartEntity($entity) {
		$this->formElement = new SimpleXMLElement("<form></form>");
		$this->formElement->addAttribute("id", "form" . $entity["name"]);
		$this->formElement->addAttribute("action", "@update" . $entity["name"] . ".html");
		$this->formElement->addAttribute("method", "post");
	}

	public function generateStartField($entity, $field) {
		if (array_key_exists((string)$field["type"], self::$map)) {
			$fieldElement = $this->formElement->addChild("p");
			$name = $this->formName($entity, $field);
			$label = isset($field['label']) ? $field['label'] : $name;
			$labelElement = $fieldElement->addChild("label", $label . ":");
			$inputElement = $fieldElement->addChild("input");
			$function = (self::$map[(string)$field["type"]]);
			$inputElement['name'] = $name;
			if (isset($field['gen_minlength'])) {
				$inputElement['minlength'] = $field['gen_minlength'];
			}
			if (isset($field['length'])) {
				$inputElement['maxlength'] = $field['length'];
			}
			if (isset($field['gen_required']) && $field['gen_required'] == 'true') {
				$inputElement['class'] = "required";
			}
			$this->$function($inputElement);
		} else {
			$fieldElement = $this->formElement->addChild("p", "No generation function for type " . $field["type"]);
		}
	}

	public function generateEndEntity($entity) {
		$dom =  dom_import_simplexml($this->formElement)->ownerDocument;
		$dom->formatOutput = true;
		$dom->save($this->outputdir . "/form" . $entity['name'] . ".html");
	}

	abstract protected function generateIntegerInput($inputElement);
	abstract protected function generateStringInput($inputElement);
	abstract protected function generateDateInput($inputElement);
	abstract protected function generateDatetimeInput($inputElement);

}
?>