<?php

namespace App\Http\Controllers\Works;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller {

	use Helpers;

	/**
	 * Invalid json response message
	 * @var string
	 */
	private $invalidJsonResponseMessage = 'Not valid json layload.';

	/**
	 * Invalid json response HTTP Code
	 * @var integer
	 */
	private $invalidJsonResponseHttpCode = 404;

	/**
	 * Execute the work
	 *
	 */
	public function send(Request $request) {
		// Valid json request
		if ($request->isJson() && $request->json()->count() && $this->isArrayConteinsData($request)) {

			// prepare data to view
			$data = $request->json();

			// Send email
			Mail::send('emails.welcome', ['data' => $data], function ($m) use ($data) {
				$m->from('hello@app.com', 'Welcome to application!');

				$m->to($data->get('email'), $data->get('name'))->subject('Welcome!');
			});

			// return empty content with http response 200
			return $this->response->noContent()->setStatusCode(200);
		}

		return $this->response->error(
			$this->invalidJsonResponseMessage,
			$this->invalidJsonResponseHttpCode
		);
	}

	/**
	 * Verify in array contains valid data
	 * @param  array $json
	 * @return boolean       [description]
	 */
	private function isArrayConteinsData(Request $request) {
		return $request->json()->has('name') && $request->json()->has('email');
	}
}
