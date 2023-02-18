<?php

	namespace Src\Middleware;

	use Src\Engine\Request;
	use Src\Engine\Response;

	interface MiddlewareInterface
	{
		public function process(Request $request, Response $response, callable $next);
	}