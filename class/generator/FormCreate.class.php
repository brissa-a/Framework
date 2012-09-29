<?php

namespace Generator;

include_once "./AbstractGenerator.class.php";

abstract class FormCreate extends AbstractGenerator {
	static private $map = array(
		"string" => "generateStringInput",
		"date" => "generateDateInput",
		"datetime" => "generateDatetimeInput"
	);


	public function generateStartEntity($entity) {
		$this->open($this->getOutputFilename($entity));
		if ($this->getCreateOrUpdate() == "update") {
			$this->write(
'<?php
global $em;

$atelier = $em -> getRepository("Atelier") -> findOneBy(array("id" => $_GET["id"]));

if ($atelier == null)
	unset($atelier);
?>'
);
		}
		$this->xmlUtils->open("form", array(
		"id" => "form" . $entity["name"],
		"action" => "@create" . $entity["name"] . ".php",
		"method" => "post"
		));
	}

	public function generateStartField($entity, $field) {
		if (array_key_exists((string)$field["type"], self::$map)) {
			$this->xmlUtils->open("p");
				$name = $this->formName($entity, $field);
				$label = isset($field['label']) ? $field['label'] : $name;
				$this->xmlUtils->all("label", array("for" => $name), $label);
				$function = (self::$map[(string)$field["type"]]);
				$attr['name'] = $name;
				$attr['id'] = $attr['name'];
				if (isset($field['gen_minlength'])) {
					$attr['minlength'] = $field['gen_minlength'];
				}
				if (isset($field['length'])) {
					$attr['maxlength'] = $field['length'];
				}
				if (isset($field['gen_required']) && $field['gen_required'] == 'true') {
					$attr['class'] = "required";
				}
				$this->$function($attr, $entity, $field);
			$this->xmlUtils->close("p");
		} else {
			$this->write("<p>"."No generation function for type " . $field["type"] . "</p>");
		}
	}

	public function generateEndEntity($entity) {
		$this->xmlUtils->close("form");
		$this->close();
	}

	public function getOutputFilename($entity) {
		return $this->outputdir . "/form" . $entity['name'] . ".php";
	}

	public function getCreateOrUpdate() {
		return "create";
	}

	abstract protected function generateIntegerInput($inputElement, $entity, $field);
	abstract protected function generateStringInput($inputElement, $entity, $field);
	abstract protected function generateDateInput($inputElement, $entity, $field);
	abstract protected function generateDatetimeInput($inputElement, $entity, $field);

}
?>