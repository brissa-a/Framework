<?php
include "../utils.php";
include "./HtmlGenerator.class.php";
include "./JsGenerator.class.php";

class FormGenerator {


	public static function generateFromDoctrine($inputfile, $outputdir) {
		$xml = simplexml_load_file($inputfile);
		$html = new HtmlGenerator($outputdir);
		$js = new JsGenerator($outputdir);
		foreach ($xml -> children() as $entity) {
			if ($entity->getName() == "entity") {// Pour chaque entite
				$html->generateStartEntity($entity);
				$js->generateStartEntity($entity);
				foreach ($entity -> children() as $field) {
					if ($field->getName() == "field") {// Pour chaque champ
						$html->generateStartField($entity, $field);
						$js->generateStartField($entity, $field);
					}
				}
				$html->generateEndEntity($entity);
				$js->generateEndEntity($entity);
			}
		}	}

}
?>