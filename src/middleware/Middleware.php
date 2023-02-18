<?php

	namespace Src\Middleware;

	class Middleware
	{
		protected $middlewares = [];

		public function __construct()
		{
			$this->middlewares = require CONFIG_PATH . 'middleware.php';
		}

	}