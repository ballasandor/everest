<?php

namespace Src;

use Src\Container\ServiceContainer;
use Src\Engine\Dispatcher;
use Src\Factory\ResponseFactory;
use Src\Middleware\MiddlewareStack;

class Application{
	public function start(){

		$services = include CONFIG_PATH . 'services.php';

		$container = new ServiceContainer($services);

		//// Middleware
		(new MiddlewareStack($container))->pipe();

		$response = (new Dispatcher($container))->dispatch();

		(new ResponseFactory())->emit($response);
	}
}

