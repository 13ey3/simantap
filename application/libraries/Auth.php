<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Auth
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    // untuk cek login
    function check_login()
    {
        $this->ci->load->model('auth_model');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->auth_model->get($user_id)->row();
        return $user_data;
    }

    // cek login jika belum lempar ke login form
    function check_not_login()
    {
        $user_session = $this->ci->session->userdata('userid');
        if (!$user_session) {
            redirect('login');
        }
    }
}
