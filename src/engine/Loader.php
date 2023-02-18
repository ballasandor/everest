<?php

	namespace Src\Engine;

	use Src\Container\ServiceContainer;

	class Loader
	{
		private $container;

		public function __construct(ServiceContainer $container)
		{
			$this->container = $container;
		}

	}