<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_m');
  }

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
  
  public function auth()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    
    $user = $this->user_m->getUser($username)->row_array();

    if ($user) {
      if (password_verify($password, $user['s_password'])) {
        $pass = password_get_info($user['s_password']);
        var_dump($pass);
        echo "password cocok";
      } else {
        echo "password salah";
      }
    } else {
      echo "username gak ketemu";
    }
  }
}
