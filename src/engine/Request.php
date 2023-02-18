<?php

	namespace Src\Engine;

	class Request {

		private $get = [];
		private $post = [];
		private $cookie = [];
		private $server = [];

        public function __construct()
        {
            $this->server = $_SERVER;
			$this->get = $_GET;
			$this->post = $_POST;
			$this->cookie = $_COOKIE;
        }

        public function method(){
            return $this->server["REQUEST_METHOD"];
		}

		public function post($key = ''){
			if (!empty($key)){
				return isset($this->post[$key]) ? $this->post[$key] : null;
			}
			return $this->post;
		}

		public function get($key = ''){
			if (!empty($key)){
				return isset($this->get[$key]) ?? null;
			}
			return $this->get;
		}

		public function cookie($key = ''){
			if (!empty($key)){
				return isset($this->cookie[$key]) ?? null;
			}
			return $this->cookie;
		}

		public function uri(){
			$cleanedUri = explode('?',$this->server['REQUEST_URI']);
			return $cleanedUri[0];
		}

		public function isApi(){
			return !(strpos($this->uri(), '/api/') === false);
		}
	}