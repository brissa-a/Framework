<?php

class PhpCrudGenerator {
	static private $map = array(
		"string" => "generateString",
		"date" => "generateDate",
		"datetime" => "generateDatetime"
	);
	
	private $outputfilec;
	private $outputfileu;
	private $outputfiled;
	private $outputdir;

	public function PhpCrudGenerator($outputdir) {
		$this->outputdir = $outputdir;
	}

	private function generateDate($entity, $field) {
		fwrite($this->outputfilec,
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '(DateTime::createFromFormat("d/m/Y", $_POST["' . $field["name"] . '"]));
');

	}

	private function generateDateTime($entity, $field) {
		fwrite($this->outputfilec,
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '(DateTime::createFromFormat("d/m/Y H:i", $_POST["' . $field["name"] . '"]));
');
	
	}

	private function generateString($entity, $field) {
		fwrite($this->outputfilec,
'$new' . $entity["name"] . '->set' . ucfirst($field["name"]) . '($_POST["' . $field["name"] . '"]);
');
	}

	public function generateStartEntity($entity) {
		$this->outputfilec = fopen($this->outputdir . "/create" . $entity['name'] . ".php", 'w+') or die("can't open file");
		$this->outputfileu = fopen($this->outputdir . "/update" . $entity['name'] . ".php", 'w+') or die("can't open file");
		$this->outputfiled = fopen($this->outputdir . "/delete" . $entity['name'] . ".php", 'w+') or die("can't open file");
		fwrite($this->outputfilec, "<?php\n");
		
		fwrite($this->outputfilec,
'if (isset($_POST["id"])) {
	//Update
	$new' . $entity["name"] . ' = $em -> getRepository("' . $entity["name"] . '") -> findOneBy(array("id" => $_POST["id"]));;		
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
			fwrite($this->outputfilec,"//No generation function for type " . $field["type"]);
		}
	}


	public function generateEndEntity($entity) {
		fwrite($this->outputfilec, '
$em -> merge($new' . $entity["name"] . ');
$em -> flush($new' . $entity["name"] . ');
?>
');
		fclose($this->outputfilec);
		fclose($this->outputfileu);
		fclose($this->outputfiled);
	}

}
?>