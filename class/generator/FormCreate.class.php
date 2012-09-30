<?php

namespace Generator;

include_once "./AbstractGenerator.class.php";

abstract class FormCreate extends AbstractGenerator {
	static private $map = array(
		"string" => "generateStringInput",
		"date" => "generateDateInput",
		"datetime" => "generateDatetimeInput",
		"boolean" => "generateBooleanInput"
	);


	public function generateStartEntity($entity) {
		$this->open($this->getOutputFilename($entity));
		$this->write(
'<?php
require_once (\'config/global.php\');

global $em;

if (isset($_REQUEST["'. strtolower($entity['name']) .'_id"])) {
$'. strtolower($entity['name']) .' = $em -> getRepository("'. $entity['name'] . '") -> findOneBy(array("id" => $_REQUEST["'. strtolower($entity['name']) .'_id"]));
if ($'. strtolower($entity['name']) .' == null)
	unset($'. strtolower($entity['name']) .');
}
?>
');
		$this->xmlUtils->open("form", array(
		"id" => "form" . $entity["name"],
		"action" => "@create" . $entity["name"] . ".html",
		"method" => "post"
		));
		$this->write('
<?php if (isset($'. strtolower($entity['name']) .')): ?>
<input id="'. strtolower($entity['name']) .'_id" name="id" type="hidden" value="<?php echo $'. strtolower($entity['name']) .'->getId()?>"/>
<?php endif ?>
');
	}

	public function generateStartField($entity, $field) {
		if (array_key_exists((string)$field["type"], self::$map)) {
			$this->xmlUtils->open("p");
				$name = $this->formName($entity, $field);
				$label = isset($field['label']) ? $field['label'] : $name;
				$this->xmlUtils->all("label", array("for" => $name), $label);
				$function = (self::$map[(string)$field["type"]]);
				$attr['name'] = $name;
				$attr['id'] = $attr['name'];
				if (isset($field['gen_minlength'])) {
					$attr['minlength'] = $field['gen_minlength'];
				}
				if (isset($field['length'])) {
					$attr['maxlength'] = $field['length'];
				}
				if (isset($field['gen_required']) && $field['gen_required'] == 'true') {
					$attr['class'] = "required";
				}
				$this->$function($attr, $entity, $field);
			$this->xmlUtils->close("p");
		} else {
			$this->write("<p>"."No generation function for type " . $field["type"] . "</p>");
		}
	}

	public function generateEndEntity($entity) {
		$this->write('<input type="submit" value="Submit">');
		$this->xmlUtils->close("form");
		
		echo '
<result
	name="form' . $entity['name'] . '"
	path="' . $this->getOutputFilename($entity) . '"
	layout="main">
</result>
		';
		
		$this->close();
	}

	public function getOutputFilename($entity) {
		return $this->outputdir . "/form" . $entity['name'] . ".php";
	}

	abstract protected function generateIntegerInput($attr, $entity, $field);
	abstract protected function generateStringInput($attr, $entity, $field);
	abstract protected function generateDateInput($attr, $entity, $field);
	abstract protected function generateDatetimeInput($attr, $entity, $field);
	abstract protected function generateBooleanInput($attr, $entity, $field);

}
?>