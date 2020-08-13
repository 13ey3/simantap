<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
    $view_data = [
      "page_title" => "Log-in",
      "content" => "auth/login",
      "custom_js" => "auth/custom_js",
      "layout" => 2
    ];

		$this->load->view('portal', $view_data);
	}
}
