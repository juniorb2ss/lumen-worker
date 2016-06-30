<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class IndexController extends Controller {

	use Helpers;

	/**
	 * Execute the work
	 *
	 */
	public function index(Request $request) {
		return $this->response->noContent()->setStatusCode(200);
	}
}
