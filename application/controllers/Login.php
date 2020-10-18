<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_m');
    $this->load->model('Staffdinas_m');
    $this->load->model('Pemohon_m');
  }

  public function index()
  {
    $view_data = [
      "page_title" => "Log-in",
      "content" => "auth/login",
      "custom_js" => "auth/custom_js",
      "layout" => 2
    ];

    $this->load->view('main', $view_data);
  }

  public function staff()
  {
    $view_data = [
      "page_title" => "Log-in",
      "content" => "auth/login_staff",
      "custom_js" => "auth/custom_js",
      "layout" => 2
    ];

    $this->load->view('main', $view_data);
  }

  public function auth()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->user_m->getUser($username)->row_array();

    if ($user) {
      $userDetile = ($user['s_jenis_user'] == 13)
        ? $this->Pemohon_m->cekRegsitration($user['s_userid_detile'])
        : $this->Staffdinas_m->getStaffById($user['s_userid_detile']);

      if (password_verify($password, $user['s_password'])) {

        if ($user['s_jenis_user'] == 13) {

          $nama_pemohon = ($userDetile['c_id_usaha'] == 3) ? $userDetile['c_nama_pemohon'] : $userDetile['c_nama_badan_usaha'];
        } else {
          $nama_pemohon = '';
        }

        $user_data = [
          'userid' => $user['s_userid'],
          'username' => $username,
          'name' => isset($userDetile['t_nama']) ? $userDetile['t_nama'] : $nama_pemohon,
          'usertype' => $user['s_jenis_user'],
          'idgroup' => $user['s_idgroup']
        ];

        $this->session->set_userdata($user_data);
        redirect('main');
      } else {
        
        $this->session->set_flashdata('login_message', "username atau password salah !");
        redirect('login');
      }
    } else {
      $this->session->set_flashdata('login_message', "username atau password salah !");
      redirect('login');
    }
  }

  public function logout()
  {
    $param_userdata = array('userid', 'name','username', 'usertype', 'idgroup');
    $this->session->unset_userdata($param_userdata);

    redirect('login');
  }
}
