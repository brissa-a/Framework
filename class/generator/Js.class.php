<?php

namespace Generator;
include_once "./AbstractGenerator.class.php";

class Js extends AbstractGenerator{
	static private $map = array(
		"string" => "generateStringInput",
		"date" => "generateDateInput",
		"datetime" => "generateDatetimeInput"
	);

	private $formElement;
	private $outputfile;

	public function generateStartEntity($entity) {
		$this->outputfile = fopen($this->getOutputFilename($entity), 'w+') or die("can't open file");
		fwrite($this->outputfile, "
		jQuery(document).ready(function(){
			jQuery('#form" . $entity['name'] . "').validate();
			jQuery('#form" . $entity['name'] . " .date').datepicker({
				dateFormat: 'dd/mm/yy',
				changeYear: true,
				changeMonth: true,
				yearRange: '1900:2100'
			});
			jQuery('#form" . $entity['name'] . " .date').datepicker($.datepicker.regional['fr']);
		});
		");
	}

	public function generateStartField($entity, $field) {

	}

	public function generateEndEntity($entity) {
		fclose($this->outputfile);
	}
	
	public function getOutputFilename($entity) {
		return $this->outputdir . "/form" . $entity['name'].".js";
	}

}
?>