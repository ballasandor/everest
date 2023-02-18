<?php

	namespace Src\Container;

	class ServiceContainer
	{
		public $services = [];

		public function __construct($services)
		{
			foreach ($services as $key => $service){
				$this->set($key,$service);
			}
		}

		public function set($key,$service){
			$this->services[$key] = $service;
		}

		public function get($key){
			return $this->services[$key];
		}
	}