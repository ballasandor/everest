<?php

	namespace Src\Middleware;

	use Src\Container\ServiceContainer;
	use Src\Engine\Request;
	use Src\Engine\Response;
	use Src\Middleware;

	class MiddlewareStack
	{
		private  $middlewares = [];

		private  $container;

		public function __construct(ServiceContainer $container)
		{
			$this->container = $container;
			// Load Middlewares
			$middlewares = require CONFIG_PATH . 'middleware.php';

			foreach ($middlewares as $middleware){
				$this->middlewares[] = new $middleware();
			}
		}

		public function pipe(){
			$this->__invoke($this->container->get('request'),$this->container->get('response'));
		}


		public function __invoke(Request $request, Response $response)
		{
			$middleware = array_shift($this->middlewares);

			if ($middleware == null){
				return;
			}


			return $middleware->process($this->container->get('request'),$this->container->get('response'), $this);

		}

	}