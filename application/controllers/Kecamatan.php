<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kecamatan_m');
    }

    public function getKecamatanAjax()
    {
        $output = $this->kecamatan_m->getAllKecamatan()->result_array();

        echo json_encode($output);
    }
}