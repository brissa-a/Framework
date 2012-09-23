<?php
include "../utils.php";

class FormGenerator {
	static private $map = array("string" => "generateStringField", "date" => "generateDateField", "datetime" => "generateDatetimeField");

	public static function generateField($param) {
		println("<p>");
		println("	<label for=\"" . $param['name'] . "\">" . $param['name'] . ":</label>");
		echo "	<input";
		foreach ($param as $key => $value) {
			echo " $key=\"$value\" ";
		}
		println("/>");
		println("</p>");
	}

	public static function generateStringField($param) {
		if (isset($param['name'])) {
			$param['id'] = isset($param['id']) ? $param['id'] : $param['name'];
			$param['class'] = isset($param['class']) ? $param['class'] : "";
			$param['type'] = "text";
			FormGenerator::generateField($param);
		} else {
			echo "Parametre obligatoire \"name\" non sette.";
		}
	}

	public static function generateDateField($param) {
		if (isset($param['name'])) {
			$param['id'] = isset($param['id']) ? $param['id'] : $param['name'];
			$param['class'] = isset($param['class']) ? $param['class'] + " date" : "";
			$param['type'] = "text";
			FormGenerator::generateField($param);
		} else {
			echo "Parametre obligatoire \"name\" non sette.";
		}
	}

	public static function generateDatetimeField($param) {
		if (isset($param['name'])) {
			$param['id'] = isset($param['id']) ? $param['id'] : $param['name'];
			$param['class'] = isset($param['class']) ? $param['class'] + " datetime" : "";
			$param['type'] = "text";
			FormGenerator::generateField($param);
		} else {
			echo "Parametre obligatoire \"name\" non sette.";
		}
	}

	public static function generateFromDoctrine($filename) {
		$xml = simplexml_load_file($filename);

		// foreach(self::$map as $key => $value) {
		// echo $key . "=>" . $value . "\n";
		// }
		foreach ($xml -> children() as $entity) {
			if ($entity -> getName() == "entity") {
				foreach ($entity -> children() as $field) {
					if ($field -> getName() == "field") {
						if (array_key_exists((string)$field["type"], self::$map)) {
							$function = (self::$map[(string)$field["type"]]);
							unset($param);
							$param['name'] = $entity['name'] . "_" . $field['name'];
							if (isset($field['length'])) {
								$param['maxlength'] = $field['length'];
							}
							if (isset($field['gen_required']) && $field['gen_required'] == 'true') {
								$param['class'] = "required";
							}
							if (isset($field['gen_minlength'])) {
								$param['minlength'] = $field['gen_minlength'];
							}
							
							FormGenerator::$function($param);
						} else {
							echo "No generation function for type " . $field["type"] . ".\n";
						}
					}
				}
			}
		}	}
}
?>