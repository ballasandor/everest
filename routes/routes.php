<?php
	/**
	 * Routes
	 */
use Src\Engine\Route;



Route::get('/',[\App\Controller\Common\HomeController::class,'index']);

// Show robot data
Route::get('/robot/edit/{user_id}',[\App\Controller\Common\HomeController::class,'edit']);
// Show Add Robot
Route::post('/robot/add',[\App\Controller\Common\HomeController::class,'add']);
// Insert Robot
Route::get('/robot/add',[\App\Controller\Common\HomeController::class,'add']);
// Update Robot
Route::post('/robot/edit/{user_id}',[\App\Controller\Common\HomeController::class,'edit']);

// Delete Robot
Route::get('/robot/delete/{user_id}',[\App\Controller\Common\HomeController::class,'delete']);

Route::get('/dokumentation/{file}',[\App\Controller\Common\HomeController::class,'showDocument']);

// Fight
Route::post('/fight',[\App\Controller\Common\HomeController::class,'fight']);

// Api calls
Route::post('/api/fight',[\App\Controller\Common\HomeController::class,'fight']);