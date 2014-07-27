<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Generate bootstrap javascript virtual file
	 * 
	 * @return void
	 */
	public function init()
	{
		$contents = View::make('partials.initjs');
		$response = Response::make($contents, 200);
		$response->header('Content-Type', 'application/javascript');
		return $response;
	}

}
