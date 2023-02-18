<?php

	namespace App\Middleware;

	use Src\Engine\Request;
	use Src\Engine\Response;
	use Src\Middleware\MiddlewareInterface;

	class AuthMiddleware implements MiddlewareInterface
	{

		public function process(Request $request, Response $response, callable $next)
		{
			$auth = true;
			if (!$auth){
				return $response->view('common.login',['error' => 'Be kell jelentkezned']);
			}
			return $next($request,$response);
		}
	}