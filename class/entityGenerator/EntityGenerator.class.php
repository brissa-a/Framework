<?php
include "../utils.php";
include "./HtmlGeneratorImpl.class.php";
include "./JsGenerator.class.php";
include "./PhpCrudGeneratorImpl.class.php";

class EntityGenerator {

	public static function generateFromDoctrine($inputfile, $outputdir) {
		$xml = simplexml_load_file($inputfile);
		$html = new HtmlGeneratorImpl($outputdir);
		$js = new JsGenerator($outputdir);
		$crud = new PhpCrudGeneratorImpl($outputdir);
		foreach ($xml -> children() as $entity) {
			if ($entity->getName() == "entity") {// Pour chaque entite
				$html->generateStartEntity($entity);
				$js->generateStartEntity($entity);
				$crud->generateStartEntity($entity);
				foreach ($entity -> children() as $field) {
					if ($field->getName() == "field") {// Pour chaque champ
						$html->generateStartField($entity, $field);
						$js->generateStartField($entity, $field);
						$crud->generateStartField($entity, $field);
					}
				}
				$html->generateEndEntity($entity);
				$js->generateEndEntity($entity);
				$crud->generateEndEntity($entity);
			}
		}	}

}
?>