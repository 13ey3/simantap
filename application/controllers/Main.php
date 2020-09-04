<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
	}

	public function index()
	{
		$this->auth->check_not_login();
		$this->auth->is_full_register();

		$view_data = [
			"page_title" => "Dashboard",
			"content" => "dashboard/index",
			"custom_js" => "_block/custom_js",
			"parent_menu" => 'main',
			"layout" => 1
		];

		$this->load->view('main', $view_data);
	}
}
