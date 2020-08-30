<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Kelurahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kelurahan_m');
    }

    public function getKelurahanAjax()
    {
        $post = $this->input->post();
        $output = $this->kelurahan_m->getAllKelurahanByKecamtanId($post['id_kecamatan'])->result_array();
        
        echo json_encode($output);
    }
}
