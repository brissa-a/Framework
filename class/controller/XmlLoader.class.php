<?php

libxml_use_internal_errors(true);

class XmlLoader {
	protected $logger;
	protected $xml;
	protected $filename;
	protected $xsdFilename;

	public function __construct($xmlFilename, $xsdFilename = null) {
		$this -> logger = Logger::getLogger(__CLASS__);
		if ($xsdFilename) {
			if (file_exists($xsdFilename)) {
				$doc_xml = new DOMDocument();
				$doc_xml -> load($xmlFilename);
				$isValid = $doc_xml -> schemaValidate($xsdFilename);
				if (!$isValid) {
					$this -> libxml_display_errors();
					throw new Exception("Error " . $xmlFilename . " is invalid", 1);
				}
			} else {
				throw new Exception("Error " . $xsdFilename . " not found", 1);
			}
		}
		$this -> xsdFilename = $xsdFilename;
		$this -> filename = $xmlFilename;
		$this -> xml = new SimpleXMLElement(file_get_contents($xmlFilename));
	}

	public function getFilename() {
		return $this->filename;
	}

	private function libxml_display_error($error) {
		$return = "<br/>\n";
		switch ($error->level) {
			case LIBXML_ERR_WARNING :
				$return .= "<b>Warning $error->code</b>: ";
				break;
			case LIBXML_ERR_ERROR :
				$return .= "<b>Error $error->code</b>: ";
				break;
			case LIBXML_ERR_FATAL :
				$return .= "<b>Fatal Error $error->code</b>: ";
				break;
		}
		$return .= trim($error -> message);
		if ($error -> file) {
			$return .= " in <b>$error->file</b>";
		}
		$return .= " on line <b>$error->line</b>\n";

		return $return;
	}

	private function libxml_display_errors() {
		$errors = libxml_get_errors();
		foreach ($errors as $error) {
			$this->logger->fatal($this -> libxml_display_error($error));
		}
		libxml_clear_errors();
	}

}
?>