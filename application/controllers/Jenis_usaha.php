<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Jenis_usaha extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jenis_usaha_m');
    }

    public function getJenisUsahaAjax()
    {
        $output = $this->jenis_usaha_m->getALlJenisUsaha();
        
        echo json_encode($output);
    }
}
