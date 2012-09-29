<?php

namespace Generator;

include "./XmlUtils.class.php";

abstract class AbstractGenerator {

	private $out;
	protected $outputdir;
	protected $xmlUtils;

	public function __construct($outputdir) {
		$this->outputdir = $outputdir;
	}

	public function open($filename) {
		$this->out = fopen($filename, 'w+') or die("can't open file");
		$this->xmlUtils = new XmlUtils($this);
	}

	public function write($str) {
		fwrite($this->out, $str);
	}
	
	public function writeln($str) {
		fwrite($this->out, $this->str . "\n");
	}

	public function close() {
		fclose($this->out);
	}

	public static function formName($entity, $field) {
		return strtolower($entity["name"] . "_" . $field["name"]);
	}
	
	
	public function generateStartEntity($entity) {

	}

	public function generateField($entity, $field) {

	}

	public function generateEndEntity($entity) {

	}

}
?>