<?php
include "EntityGenerator.class.php";

if (count($argv) == 3) {
	EntityGenerator::generateFromDoctrine($argv[1], $argv[2]);
} else {
	echo "Usage: [inputfile] [outputdir]";
}

?>