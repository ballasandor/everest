<?php

	namespace Src\Engine;

	use App\Controller\Error\NotFoundController;
	use Src\Container\ServiceContainer;


	/**
	 * @property Request $request
	 */

	class Dispatcher{
		private $container;
		private $request;
		private $routes = [];

		public function __construct(ServiceContainer $container)
		{
			$this->container = $container;
			$this->request = $this->container->get('request');
			$this->routes = Route::getRoutes();
		}

		public function dispatch(){

			$action = $this->request->uri();

			foreach ($this->routes as $pattern => $callable){
				if (preg_match($pattern, $action, $matches))
                {
					return	$this->invoke($callable,$matches);
				}
			}

			$NotFound = [
				'class' => NotFoundController::class,
				'method' => 'index'
			];
			return	$this->invoke($NotFound);
		}

		private function invoke(array $callable,array $matches = [])
        {
			$class = str_replace('/','\\' ,$callable['class']);

			$controller = new $class($this->container);

			if (isset($matches[1])){
				return $controller->{$callable['method']}($matches[1]);
			}
			return $controller->{$callable['method']}();
		}

	}