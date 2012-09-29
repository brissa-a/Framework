<?php
include "./FormCreateImpl.class.php";
include "./Js.class.php";
include "./ActionCreateUpdateImpl.class.php";
include "./ActionDelete.class.php";
include "DoctrineParser.class.php";

if (count($argv) == 3) {
	
	$outputdir = $argv[2];
	$generator = new Generator\Doctrine();
	$generator->add(new Generator\FormCreateImpl($outputdir));
	$generator->add(new Generator\Js($outputdir));
	$generator->add(new Generator\ActionCreateUpdateImpl($outputdir));
	$generator->add(new Generator\ActionDelete($outputdir));
	$generator->generate($argv[1]);
} else {
	echo "Usage: [inputfile] [outputdir]";
}
?>