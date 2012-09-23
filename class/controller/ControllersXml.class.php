<?php

include_once ("XmlLoader.class.php");

class ControllersXml extends XmlLoader {

	public function __construct($filename) {
		parent::__construct($filename, 'config/xsd/controllers.xsd');
	}

	public function getFilename() {
		return $filename;
	}

	public function getControllerData($controllerName) {
		$controllerData = $this -> xml -> xpath("//controller[@name='" . $controllerName . "']");
		if (count($controllerData) && $controllerData) {
			return $controllerData[0];
		}
		return null;
	}

}
?>