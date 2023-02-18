<?php

	namespace Src\Factory;

	use Src\Engine\Response;

	class ResponseFactory {

		private $response;

		public function emit(Response $response){
			if (!($this->response = $response) instanceof Response){
				$this->response = new Response();
				$this->response->body = '';
			}

			$this->emitStatusLine($this->response->statusCode,$this->response->reasonPhrase);
			$this->emitHeaders($this->response->headers);
			$this->emitData($this->response->body);
		}

		/**
		 * Set status code
		 * @param int $statusCode
		 * @param string $reasonPhrase
		 */
		private function emitStatusLine(int $statusCode,string $reasonPhrase)
		{
			header(sprintf("HTTP/1.1 %d %s",$statusCode,$reasonPhrase),true,$statusCode);
		}

		/**
		 * Set response headers
		 *
		 * @param array $headers
		 */
		private function emitHeaders(array $headers)
		{
			foreach ($headers as $key => $value){
				header(sprintf("%s: %s",$key,$value));
			}
		}

		private function emitData(string $data){
			echo  $data;
		}
	}