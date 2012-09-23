<?php
$curdir = str_replace("\\", "/", dirname(__FILE__));
define('ROOT_DIR', $curdir . '/..');
define('LIB_DIR', ROOT_DIR . '/lib/');
define('ENT_DIR', ROOT_DIR . '/entities/');
define('CONF_DIR', ROOT_DIR . '/config/');

foreach (glob(ENT_DIR."*.php") as $filename) {
	include $filename;
}

use Doctrine\ORM\Tools\Setup;
require_once (LIB_DIR . 'Doctrine/ORM/Tools/Setup.php');
/* ---- AutoLoad Doctrine ----*/
Setup::registerAutoloadDirectory(LIB_DIR);
/* ---- Configure EntityManager ---- */
$isDevMode = true;
$mapConfig = Setup::createXMLMetadataConfiguration(array(ROOT_DIR . "/mapping"), $isDevMode);
$dbConfig = parse_ini_file("db_config.ini");
$em = \Doctrine\ORM\EntityManager::create($dbConfig, $mapConfig);

//Permet d'eviter les magic quote
if (get_magic_quotes_gpc()) {
	function stripslashes_gpc(&$value) {
		$value = stripslashes($value);
	}

	array_walk_recursive($_GET, 'stripslashes_gpc');
	array_walk_recursive($_POST, 'stripslashes_gpc');
	array_walk_recursive($_COOKIE, 'stripslashes_gpc');
	array_walk_recursive($_REQUEST, 'stripslashes_gpc');
}

/* --- Log4php --- */
include (LIB_DIR . 'log4php/Logger.php');
Logger::configure(CONF_DIR . 'log4php.xml');

include ROOT_DIR . "/class/webUtils.php";
include ROOT_DIR . "/class/controller/Controller.class.php";
?>