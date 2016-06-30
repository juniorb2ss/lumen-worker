<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */
$api = app('Dingo\Api\Routing\Router');

$app->get('/', [
	'as' => 'index', 'uses' => 'IndexController@index',
]);

$api->version('v1', function ($api) {
	$api->group([], function ($api) {
		$api->post('send-email', 'App\Http\Controllers\Works\SendEmailController@send');
	});
});
