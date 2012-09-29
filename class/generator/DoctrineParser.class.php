<?php
namespace Generator;

include "../utils.php";

class Doctrine {

	private $toGenerate;

	public function __construct() {
		$this->toGenerate = array();
	}

	public function add($generable) {
		array_push($this->toGenerate, $generable);
	}

	public function generate($xmlfile) {
		$xml = simplexml_load_file($xmlfile);

		foreach ($xml -> children() as $entity) {
			if ($entity->getName() == "entity") {// Pour chaque entite
				foreach ($this->toGenerate as $elem)
					$elem->generateStartEntity($entity);
				foreach ($entity -> children() as $field) {
					if ($field->getName() == "field") {// Pour chaque champ
						foreach ($this->toGenerate as $elem)
							$elem->generateStartField($entity, $field);
					}
				}
				foreach ($this->toGenerate as $elem)
					$elem->generateEndEntity($entity);
			}
		}	}

}
?>