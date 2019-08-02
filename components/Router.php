<?php

class Router {
	private $routes;

	public function __construct() {
		$routesPath = 'config/routes.php';
		$this->routes = include($routesPath);
	}

	private function getURI() {
		if (!empty($_SERVER["REQUEST_URI"])) {
			return trim($_SERVER["REQUEST_URI"],'/');
		}
	}

	public function run() {
		$uri = $this->getURI();
		//echo "uri:$uri<br>";
		if ( ( strpos($uri, 'nsurance') ) && ( strpos($uri, 'fbclid') ) ) {
			$uri = 'insurance' ;
			//echo "uri:$uri<br>";
		}
		elseif(strpos($uri, 'fbclid')) $uri = '' ;
		foreach ($this->routes as $uriPattern => $path) {
			if (preg_match("`$uriPattern`", $uri)) {
				$internalRoute = preg_replace("`$uriPattern`", $path, $uri);
				//echo "internalRoute:$internalRoute<br>";
				$segments = explode("/", $internalRoute);
				//ім'я сконтролера
				$controllerName = array_shift($segments)."Controller";
				$controllerName = ucfirst($controllerName);
				// action
				$actionName = "action".ucfirst(array_shift($segments));
				
				// параметри
				$parametrs = $segments;
				$ControllerFile = "controllers/".$controllerName.".php";
				//echo "actionName:$actionName   ControllerFile:$ControllerFile";
				if (file_exists($ControllerFile)) {
					include_once ($ControllerFile);
					$controllerObject = new $controllerName;
					$result = call_user_func_array(array($controllerObject,$actionName), $parametrs);
					if ($result != NULL) break;
					//include_once ("models/Auxiliary.php");
					//$res = Auxiliary::addErr($uri,'errTable');
				}
			}
		}
		
	}
}
?>