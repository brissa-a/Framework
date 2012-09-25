<?php
include "../utils.php";

class FormGenerator {
	static private $map = array(
		"string" => "generateStringInput",
		"date" => "generateDateInput",
		"datetime" => "generateDatetimeInput"
	);

	public static function generateIntegerInput($inputElement) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] + " date" : "";
		$inputElement['type'] = "text";
	}

	public static function generateStringInput($inputElement) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] : "";
		$inputElement['type'] = "text";
	}

	public static function generateDateInput($inputElement) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] + " date" : "";
		$inputElement['type'] = "text";
	}

	public static function generateDatetimeInput($inputElement) {
		$inputElement['id'] = isset($inputElement['id']) ? $inputElement['id'] : $inputElement['name'];
		$inputElement['class'] = isset($inputElement['class']) ? $inputElement['class'] + " datetime" : "";
		$inputElement['type'] = "text";
	}

	public static function generateFromDoctrine($filename) {
		$xml = simplexml_load_file($filename);

		foreach ($xml -> children() as $entity) {
			if ($entity->getName() == "entity") {// Pour chaque entite

				$formElement = new SimpleXMLElement("<form></form>");
				$formElement->addAttribute("id", "form" . $entity["name"]);
				$formElement->addAttribute("action", "@update" . $entity["name"] . ".html");
				$formElement->addAttribute("method", "post");

				foreach ($entity -> children() as $field) {
					if ($field->getName() == "field") {// Pour chaque champ
						if (array_key_exists((string)$field["type"], self::$map)) {
							$fieldElement = $formElement->addChild("p");
							$name = $entity['name'] . "_" . $field['name'];
							$labelElement = $fieldElement->addChild("label", $name . ":");
							$inputElement = $fieldElement->addChild("input");
							$function = (self::$map[(string)$field["type"]]);
							unset($param);
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
							FormGenerator::$function($inputElement);
						} else {
							$fieldElement = $formElement->addChild("p", "No generation function for type " . $field["type"]);
						}
					}
				}
				$dom =   dom_import_simplexml($formElement)->ownerDocument;
				$dom->formatOutput = true;
				echo $dom->saveXML();
			}
		}	}

}
?>