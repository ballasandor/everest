<?php

	namespace Src\Engine;

	use Src\Container\ServiceContainer;

	/**
	 * @property Request $request
	 * @property Response $response
	 * @property Model $model
	 * @property Loader $load
	 */

	class Controller
	{

		protected $container;


		public function __construct(ServiceContainer $container)
		{
			$this->container = $container;
		}

		public function __get(string $key)
		{
			return $this->container->get($key);
		}

	}