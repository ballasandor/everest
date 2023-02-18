<?php

	namespace Src\Engine;

	use Src\Container\ServiceContainer;

	/**
	 * @property Database $db
	 * @property Request $request
	 */

	class Model
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