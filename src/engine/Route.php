<?php

	namespace Src\Engine;

	class Route {
		private static $routes;

        /**
         * Add route GET Method
         * @param string $route
         * @param array $data
         * @return void
         */
		public static function get(string $route = '/',array $data = []){
			$pattern = str_replace(['{','}'],['(?<','>[\w]+)'],$route);
			$pattern = "%^$pattern$%";

			self::$routes['GET'][$pattern] = [
				'class' => $data[0],
				'method' => $data[1],
			];
		}

		public static function post(string $route = '/',array $data = []){
			$pattern = str_replace(['{','}'],['(?<','>[\w]+)'],$route);
			$pattern = "%^$pattern$%";

			self::$routes['POST'][$pattern] = [
				'class' => $data[0],
				'method' => $data[1],
			];
		}


        /**
         * Get all routes
         * @return array
         */
		public static function getRoutes()
        {
			return self::$routes[$_SERVER['REQUEST_METHOD']];
		}

	}