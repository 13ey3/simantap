<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$view_data = [
			"page_title" => "Dashboard",
			"content" => "dashboard/index",
			"custom_js" => "_block/custom_js",
      "layout" => 1
		];
		
		$this->load->view('main', $view_data);
	}
}
