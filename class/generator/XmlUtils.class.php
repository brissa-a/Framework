<?php

namespace Generator;

class XmlUtils {

	private $writer;

	public function __construct($writer) {
		$this->writer = $writer;
	}

	public function attr($attr) {
		foreach ($attr as $key => $value) {
			$this->writer->write("$key=\"$value\"");
		}
	}
	
	public function open($name, $attr = array()) {
		$this->writer->write("<$name ");
		$this->attr($attr);
		$this->writer->write(">");
	}
	
	public function close($name) {
		$this->writer->write("</$name>");
	}
	
	public function all($name, $attr = array(), $data = null) {
		$this->writer->write("<$name ");
		$this->attr($attr);
		if ($data) {
			$this->writer->write(">");
			$this->writer->write($data);
			$this->writer->write("</$name>");
		} else {
			$this->writer->write("/>");
		}
	}
	
}
?>