<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Auth
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('pemohon_m');
    }

    // untuk cek login
    function check_login()
    {
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->pemohon_m->cekRegsitration($user_id);
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

    function is_full_register()
    {
        $nip = $this->ci->session->userdata('userid');
        $user_data = $this->ci->pemohon_m->cekRegsitration($nip);

        if ($user_data['c_complete_reg'] == 0) {
            redirect('user/profile');
        }
    }
}
