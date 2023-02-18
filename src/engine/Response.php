<?php
	namespace Src\Engine;

	use Src\Factory\ResponseFactory;

	class Response {
		public  $body = '';
		public  $headers = [];
		public  $statusCode = 200;
		public  $reasonPhrase = 'OK';

		/**
		 * Set response header
		 * @param string $key
		 * @param string $value
		 * @return $this
		 */
		public function header(string $key,string $value)
		{
			$this->headers[$key] = $value;
			return $this;
		}

		public function reasonPharse(string $reasonPhrase)
		{
			$this->reasonPhrase = $reasonPhrase;
			return $this;
		}

		public function status(int $status)
		{
			$this->statusCode = $status;
			return $this;
		}

		public function redirect(string $route)
		{
			$this->body = '';
			$this->headers = ['Location' => $route];
			$this->reasonPhrase = 'Found';
			return $this;
		}

		public function view(string $view = '', array $data = [])
		{
			$this->body = empty($view) ? '' : View::render($view,$data);
			return $this;
		}

		public function json(array $data)
		{
			$this->body = json_encode($data,JSON_UNESCAPED_UNICODE);
			return $this;
		}

	}