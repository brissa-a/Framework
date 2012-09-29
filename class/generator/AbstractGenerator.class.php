<?php

namespace Generator;

abstract class AbstractGenerator {
	
	public static function formName($entity, $field) {
		return strtolower($entity["name"] . "_" . $field["name"]);
	}
	
	public function generateStartEntity($entity) {
		
	}
	
	public function generateStartField($entity, $field){
		
	}
	
	public function generateEndEntity($entity) {
		
	}
}
?>