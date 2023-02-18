<?php
require '../vendor/autoload.php';

require '../config/app.php';

require '../src/functions.php';
require '../routes/routes.php';


	try {
		$app = new \Src\Application();
		$app->start();
	}catch (Exception $exception){
		echo $exception->getMessage();
	}
