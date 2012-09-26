<?php
include "FormGenerator.class.php";

if (count($argv) == 3) {
	FormGenerator::generateFromDoctrine($argv[1], $argv[2]);
} else {
	echo "Usage: [inputfile] [outputdir]";
}

?>