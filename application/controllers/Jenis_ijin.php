<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_ijin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jenis_ijin_m');
    }

    public function getJenisIjin() {
        $data = $this->jenis_ijin_m->getListIjin()->result();

        echo json_encode($data);
    }
}