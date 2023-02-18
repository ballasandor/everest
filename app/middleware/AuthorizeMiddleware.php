<?php

	namespace App\Middleware;

	use Src\Engine\Request;
	use Src\Engine\Response;
	use Src\Middleware\MiddlewareInterface;

	class AuthorizeMiddleware implements MiddlewareInterface
	{

		public function process(Request $request, Response $response, callable $next)
		{
			$auth = true;
			if (!$auth){
				return $response->view('common.login',['error' => 'Nincs jogosultságod az oldal megtekintéséhez']);
			}
			return $next($request,$response);
		}
	}