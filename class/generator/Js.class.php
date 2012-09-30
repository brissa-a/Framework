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

	public function generateStartEntity($entity) {
		$this->open($this->getOutputFilename($entity));
		$this->write("
jQuery(document).ready(function(){
	jQuery('#form" . $entity['name'] . "').validate();
	jQuery('#form" . $entity['name'] . " .date').datepicker({
		dateFormat: 'dd/mm/yy',
		changeYear: true,
		changeMonth: true,
		yearRange: '1900:2100'
	});
	jQuery('#form" . $entity['name'] . " .date').datepicker($.datepicker.regional['fr']);
		
	jQuery('#form" . $entity['name'] . " .datetime').datetimepicker({
		dateFormat: 'dd/mm/yy',
		timeFormat: 'hh:mm',
		changeYear: true,
		changeMonth: true,
		yearRange: '1900:2100',
		timeText: 'Heure',
		hourText: 'Heures',
		minuteText: 'Minutes',
		currentText: 'Maintenant',
		closeText: 'Valider'
	});
	
	jQuery('#form" . $entity['name'] . " .time').timepicker({
		dateFormat: 'dd/mm/yy',
		timeFormat: 'hh:mm',
		changeYear: true,
		changeMonth: true,
		yearRange: '1900:2100',
		timeOnlyTitle: 'Choisissez une heure',
		timeText: 'Heure',
		hourText: 'Heures',
		minuteText: 'Minutes',
		currentText: 'Maintenant',
		closeText: 'Valider'
	});
});
");
	}

	public function generateStartField($entity, $field) {

	}

	public function generateEndEntity($entity) {
		$this->close();
	}
	
	public function getOutputFilename($entity) {
		return $this->outputdir . "/form" . $entity['name'].".js";
	}

}
?>