<?php

include_once "Exception/NotFoundException.class.php";
include_once "ControllersXml.class.php";
include_once "MappingXml.class.php";

class Controller {

	protected $logger;

	protected $internalError = "error.html";
	protected $notFound = "notFound.html";

	protected $resultParamName = 'p';
	protected $actionParamName = 'a';
	protected $controllerParamName = 'c';

	protected $controllerName;
	protected $actionName;
	protected $resultName;

	protected $controllersXml;
	protected $mappingXml;

	protected $defaultController = 'default_controller';
	protected $defaultResult = "home";

	public function Controller() {
		$this -> logger = Logger::getLogger(__CLASS__);
	}

	public function setHome($home) {
		$this -> home = $home;
	}

	public function setControllerParamName($name) {
		$this -> controllerParamName = $name;
	}

	public function setResultParamName($name) {
		$this -> resultParamName = $name;
	}

	public function setActionParamName($name) {
		$this -> actionParamName = $name;
	}

	public function includeAllAssosiatedFile($path) {
		$pathinfo = pathinfo($path, PATHINFO_DIRNAME) + pathinfo($path, PATHINFO_FILENAME);
		if (file_exists($pathinfo . ".css"))
			includeCSS($pathinfo . ".css");
		if (file_exists($pathinfo . ".js"))
			includeJS($pathinfo . ".js");
		include $path;
	}

	public function loadControllers() {
		if (file_exists(ROOT_DIR . "/config/controllers.xml")) {
			$this -> controllersXml = new ControllersXml(ROOT_DIR . "/config/controllers.xml");
		} else {
			throw new Exception("Missing /config/controllers.xml file", 1);
		}

	}

	public function loadController() {
		if (isset($_REQUEST[$this -> controllerParamName])) {
			$this -> controllerName = $_REQUEST[$this -> controllerParamName];
		} else {
			$this -> controllerName = $this -> defaultController;
		}
		if ($this -> controllerName == null) {
			throw new Exception("Default controller variable not properly setted", 1);
		}
		$controllerData = $this -> controllersXml -> getControllerData($this -> controllerName);
		$controller = $controllerData['path'];
		if ($controllerData != null) {
			if (file_exists($controllerData['path'])) {
				$this -> mappingXml = new MappingXml($controllerData['path']);
			} else {
				throw new Exception("controller file could not be find:" . $controller);
			}
		} else {
			throw new NotFoundException("Controller " . $this -> controllerName . " not defined");
		}
	}

	public function executeAction() {
		if (isset($_REQUEST[$this -> actionParamName])) {
			$this -> actionName = $_REQUEST[$this -> actionParamName];
		} else {
			$this -> actionName = null;
		}
		if (isset($this -> actionName)) {
			$actionData = $this -> mappingXml -> getActionData($this -> actionName);
			if ($actionData != null && file_exists($actionData['path'])) {
				include $actionData['path'];
			} else {
				if ($actionData == null)
					throw new NotFoundException("L'action " . $this -> actionName . " n'est pas defini dans le controller" . $this -> controllerName . ":" . $this -> mappingXml -> getFilename());
				if (!file_exists($actionData['path']))
					throw new Exception("Le fichier d'action " . $actionData['path'] . "est introuvable.");
			}
		}
	}

	private function printLayoutedPage($resultData) {
		if (!isset($resultData['layout'])) {
			include $resultData['path'];
		} else {
			$layoutData = $this -> mappingXml -> getLayoutData($resultData['layout']);
			if ($layoutData != null && file_exists($layoutData['path'])) {
				include ($layoutData['path']);
			} else {
				if ($layoutData == null)
					throw new NotFoundException("Le layout " . $resultData['layout'] . " n'est pas defini dans le controller" . $_REQUEST[$this -> controllerParamName] . ":" . $this -> mappingXml -> getFilename());
				if (!file_exists($layoutData['path']))
					throw new Exception("Le fichier de layout " . $layoutData['path'] . "est introuvable.");
			}
		}
	}

	public function printResultPage() {
		if (isset($_REQUEST[$this -> resultParamName])) {
			$this -> resultName = $_REQUEST[$this -> resultParamName];
		} else {
			$this -> resultName = $this -> defaultResult;
		}
		if (isset($this -> resultName)) {
			//Si l'action et le resultat sont définies
			$resultData = $this -> mappingXml -> getPageData($this -> resultName, $this -> actionName);
			if ($resultData != null && file_exists($resultData['path'])) {
				$this -> printLayoutedPage($resultData);
			} else {
				//Gestion Erreur
				if ($resultData == null)
					throw new NotFoundException("Le resultat " . $this -> resultName . " n'est pas defini dans le controller" . $_REQUEST[$this -> controllerParamName] . ":" . $this -> mappingXml -> getFilename() . (isset($this -> actionName)) ? " pour l'action " . $this -> actionName : "");
				if (!file_exists($resultData['path']))
					throw new Exception("Le fichier de resultat " . $resultData['path'] . "est introuvable.");
			}
		} else {
			throw new Exception("Default result variable not properly setted", 1);
		}
	}

	public function printNotFoundPage() {
		if (file_exists($this -> notFound)) {
			include $this -> notFound;
		} else {
			header("HTTP/1.1 404 Not Found");
			echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
						<html><head>
						<title>404 Not Found</title>
						</head><body>
						<h1>Not Found</h1>
						<p>The requested URL was not found on this server.</p>
						</body></html>';
		}
	}

	public function printErrorPage() {
		if (file_exists($this -> internalError)) {
			$this -> logger -> debug("Internal error");
			include $this -> internalError;
		} else {
			header("HTTP/1.1 500 Internal Server Error");
			echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
						<html><head>
						<title>500 Internal Server Error</title>
						</head><body>
						<h1>Internal Server Error</h1>
						<p>Something went wrong.</p>
						</body></html>';
		}
	}

	public function execute() {
		try {
			$this -> loadControllers();
			$this -> logger -> debug("Controllers loaded");
			$this -> loadController();
			$this -> logger -> debug("Controller loaded");
			$this -> executeAction();
			$this -> logger -> debug("Action executed");
			$this -> printResultPage();
			$this -> logger -> debug("Result printed");
		} catch (NotFoundException $e) {
			$this -> logger -> error($e -> getMessage());
			$this -> printNotFoundPage();
		} catch(exception $e) {
			$this -> logger -> error($e -> getMessage());
			$this -> printErrorPage();
		}
	}

}
?>