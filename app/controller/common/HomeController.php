<?php

	namespace App\Controller\Common;

	use App\Model\Robot;
	use Src\Container\ServiceContainer;
	use Src\Engine\Controller;

	class HomeController extends Controller
	{

		private $error = [];
		private $robo_model;
		private $types;

		/**
		 * @param ServiceContainer $container
		 */
		public function __construct(ServiceContainer $container)
		{
			parent::__construct($container);

			$this->robo_model = new Robot($container);

			$this->types = [
				'brawler',
				'rouge',
				'assault',
				'super hero'
			];
		}

		/**
		 * Show robots
		 * @return \Src\Engine\Response
		 * @throws \Exception
		 */
		public function index()
		{
			$data = [];

			$data['title'] = 'RoboFight';

			$data['robots'] = $this->robo_model->getRobots();

			return $this->response->view('common.robot_list', $data);
		}

		/**
		 * Add robot
		 * @return \Src\Engine\Response
		 */
		public function add()
		{
			$data = [];

			if ($this->request->method() == 'POST' && $this->formValidate()) {

				$this->robo_model->addRobot($this->request->post());

				return $this->response->redirect('/');
			}

			$data['error'] = $this->error;

			if ($this->request->post('name')) {
				$data['name'] = $this->request->post('name');
			} else {
				$data['name'] = '';
			}

			if ($this->request->post('type')) {
				$data['type'] = $this->request->post('type');
			} else {
				$data['type'] = '';
			}

			if ($this->request->post('power')) {
				$data['power'] = $this->request->post('power');
			} else {
				$data['power'] = 1;
			}


			$data['types'] = $this->types;

			return $this->response->view('common.robot_form', $data);
		}


		/**
		 * Edit Robot
		 * @param int $id
		 * @return \Src\Engine\Response
		 */
		public function edit(int $id)
		{
			$data = [];

			if ($this->request->method() == 'POST' && $this->formValidate()) {

				$this->robo_model->editRobot($id, $this->request->post());

				return $this->response->redirect('/');
			}

			$data['error'] = $this->error;

			$robot = $this->robo_model->getRobot($id);

			if ($this->request->post('name')) {
				$data['name'] = $this->request->post('name');
			} elseif($robot){
				$data['name'] = $robot['name'];
			}

			if ($this->request->post('type')) {
				$data['type'] = $this->request->post('type');
			} elseif($robot) {
				$data['type'] = $robot['type'];
			}

			if ($this->request->post('power')) {
				$data['power'] = $this->request->post('power');
			} elseif($robot) {
				$data['power'] = $robot['power'];
			}

			$data['types'] = $this->types;

			return $this->response->view('common.robot_form', $data);
		}


		/**
		 * Delete Robot
		 * @param int $id
		 * @return \Src\Engine\Response
		 */
		public function delete(int $id)
		{

			$this->robo_model->deleteRobot($id);

			return $this->response->redirect('/');
		}


		/**
		 * Fight
		 * @param int $robot1_id
		 * @param int $robot2_id
		 * @return \Src\Engine\Response
		 */
		public function fight()
		{
			$json = [];

			$robo1 = $this->robo_model->getRobot($this->request->post('robot1_id'));
			$robo2 = $this->robo_model->getRobot($this->request->post('robot2_id'));

			if ($robo1 && $robo2) {

				$robo1IsStronger = $robo1['power'] > $robo2['power'];
				$powerIsEqual = $robo1['power'] == $robo2['power'];
				$roboi1IsYounger = strtotime($robo1['created_at']) < strtotime($robo1['created_at']);

				$winner = $powerIsEqual ? ($roboi1IsYounger ? $robo1 : $robo2) : ($robo1IsStronger ? $robo1 : $robo2);


				if ($this->request->isApi()){
					$json['status'] = 'success';
					$json['data'] = $winner;
				}else{
					$json['winner'] = $winner;
				}

			} else {
				if (!$this->request->post('robot1_id') || !$this->request->post('robot2_id')){
					$json['error'] = 'Missing parameter : robot1_id or robot2_id';
				}else{
					$json['error'] = 'Robot not found!';
				}

			}

			return $this->response->json($json);
		}


		public function showDocument($fileName){

			switch ($fileName){
				case 'dok' :
				$file = 'robofight_dokumentacio.pdf';
				break;
				case 'task' :
					$file = 'feladat.pdf';
					break;
					default;
					$this->response->redirect('/');

			}

			header("Content-type: application/pdf");
			header("Content-Disposition: inline; filename=" . $file);
			@readfile(STORAGE_PATH  . $file);
		}

		/**
		 * Validate form
		 * @return bool
		 */
		private function formValidate()
		{
			if (!$this->request->post('name') || strlen($this->request->post('name')) < 3) {
				$this->error['name'] = 'Névnek minimum 3 karakternek kell lennie';
			}

			if (!$this->request->post('power') || $this->request->post('power') < 1 || $this->request->post('power') > 10) {
				$this->error['power'] = 'Az erőnek 1 és 10 között kell lennie';
			}
			return !$this->error;
		}
	}