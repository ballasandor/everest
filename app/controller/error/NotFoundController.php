<?php

	namespace App\Controller\Error;

	use Src\Engine\Controller;

	class NotFoundController  extends Controller {
		public function index(){
			return  $this->response->status(404)->view('error.404',['error' => 'Page Not found']);
		}
	}