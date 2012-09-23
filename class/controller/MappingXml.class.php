<?php

include_once ("XmlLoader.class.php");

class MappingXml extends XmlLoader {

	public function __construct($filename) {
		parent::__construct($filename, 'config/xsd/mapping.xsd');
	}

	public function getLayoutData($layoutName) {
		$layoutData = $this -> xml -> xpath("//layout[@name='" . $layoutName . "']");
		if (count($layoutData) && $layoutData) {
			return $layoutData[0];
		}
		return null;
	}

	public function getActionData($actionName) {
		$actionData = $this -> xml -> xpath("//action[@name='" . $actionName . "']");
		if (count($actionData) && $actionData) {
			return $actionData[0];
		}
		return null;
	}

	public function getPageData($resultName, $actionName = null) {
		if ($actionName != null) {
			$resultPrivate = $this -> xml -> xpath("//action[@name='" . $actionName . "']" . "/result[@name='" . $resultName . "']");
			if (count($resultPrivate) && $resultPrivate) {
				return $resultPrivate[0];
			}
			$resultGroup = $this -> xml -> xpath("//action[@name='" . $actionName . "']/../../action-group/result[@name='" . $resultName . "']");
			if (count($resultGroup) && $resultGroup) {
				return $resultGroup[0];
			}
		}
		$resultGlobal = $this -> xml -> xpath("result[@name='" . $resultName . "']");
		if (count($resultGlobal) && $resultGlobal) {
			return $resultGlobal[0];
		}
		return null;
	}

}
?>