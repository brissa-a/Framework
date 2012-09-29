<?php

namespace Generator;
include_once "./AbstractGenerator.class.php";

class ActionDelete extends AbstractGenerator{
	
	protected $outputfile;
	protected $outputdir;

	public function __construct($outputdir) {
		$this->outputdir = $outputdir;
	}

	public function generateStartEntity($entity) {
		$this->outputfile = fopen($this->getOutputFilename($entity), 'w+') or die("can't open file");
		fwrite($this->outputfile, "<?php\n");
		
		fwrite($this->outputfile,
'$old'. $entity['name'] . ' = $em->find("'. $entity['name'] . '", $_GET["id"]);
$em->remove($old'. $entity['name'] . ');
$em->flush();
?>
');

	}

	public function generateStartField($entity, $field) {
	}


	public function generateEndEntity($entity) {
		fclose($this->outputfile);
	}

	public function getOutputFilename($entity) {
		return $this->outputdir . "/delete" . $entity['name'] . ".php";
	}

}
?>