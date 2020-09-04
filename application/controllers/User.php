<?php
defined('BASEPATH') || exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('pemohon_m');
        $this->load->library('auth');
    }

    public function index()
    {
        $view_data = [
            "page_title" => "Pendaftaran",
            "content" => "user/index",
            "custom_js" => "",
            "parent_menu" => 'setting',
            "child_menu" => 'user',
            "layout" => 1
        ];

        $this->load->view('main', $view_data);
    }

    public function profile()
    {
        $this->auth->check_not_login();
        $user = $this->session->userdata();
        
        $data_user = $this->user_m->getUser($user['userid'])->row_array();

        $view_data = [
            "page_title" => "User Profile",
            "content" => "user/profile",
            "custom_js" => "user/custom_js",
            "parent_menu" => 'setting',
            "child_menu" => 'user',
            "layout" => 1,
            "data_user" => $data_user
        ];

        $this->load->view('main', $view_data);
    }

    public function save()
    {
        $post = $this->input->post();
        $post['id_jenis_identitas'] = 1;
        $post['id_warga'] = 1;
        $status = $this->pemohon_m->addOrUpdate($post, $post['nip']);
        
        if ($status > 0) {
            $this->session->set_flashdata('success', '<strong>Success!</strong> Data berhasil di perbaharui.');
        }

        redirect('user/profile');
    }
}
