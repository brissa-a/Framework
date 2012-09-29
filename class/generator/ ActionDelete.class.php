<?php

namespace Generator;
include_once "./AbstractGenerator.class.php";

class ActionCreateUpdate extends AbstractGenerator{
	
	protected $outputfile;
	protected $outputdir;

	public function __construct($outputdir) {
		$this->outputdir = $outputdir;
	}

	public function generateStartEntity($entity) {
		$this->outputfiled = fopen($this->outputdir . "/delete" . $entity['name'] . ".php", 'w+') or die("can't open file");
		fwrite($this->outputfile, "<?php\n");
		
		fwrite($this->outputfilec,
'$old'. $entity['name'] . ' = $em->find("'. $entity['name'] . '", $_GET["id"]);
$em->remove($old'. $entity['name'] . ');
$em->flush();
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
		fclose($this->outputfile);
	}

}
?>