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
			$data['fb_url'] = 'test';
			$this->layout = View::make($this->layout, $data);
		}
	}

}