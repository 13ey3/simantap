<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

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
    $user_type = $this->input->post('user_type');

    if ($user_type == null) {
      $user = $this->user_m->getUser($username)->row_array();

      if ($user) {
        if (password_verify($password, $user['s_password'])) {

          $name = ($user['c_id_usaha'] == 3) ? $user['c_nama_pemohon'] : $user['c_nama_badan_usaha'];
          $user_data = [
            'userid' => $username,
            'name' => $name,
            'usertype' => $user['s_jenis_user']
          ];
          
          $this->session->set_userdata($user_data);
          redirect('main');
        } else {

          echo "username atau password salah";
        }
      } else {
        echo "username gak ketemu";
      }
    }
  }
}
