<?php
include "FormGenerator.class.php";

if (count($argv) == 2) {
	FormGenerator::generateFromDoctrine($argv[1]);	
} else {
	echo "Usage: [filename]";
}


?>