<?php

namespace Generator;
include_once "./AbstractGenerator.class.php";

abstract class ActionCreateUpdate extends AbstractGenerator{
	static private $map = array(
		"string" => "generateString",
		"date" => "generateDate",
		"datetime" => "generateDatetime"
	);

	public function generateStartEntity($entity) {
		$this->open($this->getOutputFilename($entity));
		$this->write(
'<?php
if (isset($_POST["'. $entity['name'] . '_id"])) {
	//Update
	$new' . $entity["name"] . ' = $em -> getRepository("' . $entity["name"] . '") -> findOneBy(array("id" => $_POST["'. $entity['name'] . '_id"]));;		
} else {
	//Create
	$new' . $entity["name"] . ' = new ' . $entity["name"] . '();			
}
');

	}

	public function generateStartField($entity, $field) {
		if (array_key_exists((string)$field["type"], self::$map)) {
			$function = (self::$map[(string)$field["type"]]);
			$this->$function($entity, $field);
		} else {
			$this->write("//No generation function for type " . $field["type"] . "\n");
		}
	}


	public function generateEndEntity($entity) {
		$this->write('
$em -> merge($new' . $entity["name"] . ');
$em -> flush($new' . $entity["name"] . ');
?>
');
		$this->close();
	}

	public function getOutputFilename($entity) {
		return $this->outputdir . "/create" . $entity['name'] . ".php";
	}

	abstract protected function generateDate($entity, $field);
	abstract protected function generateDateTime($entity, $field);
	abstract protected function generateString($entity, $field);
}
?>