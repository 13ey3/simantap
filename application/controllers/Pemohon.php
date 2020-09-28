<?php
defined('BASEPATH') || exit('No direct script access allowd');

class Pemohon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pemohon_m');
    }

    public function getPemohonByNip()
    {
        $post = $this->input->post();
        $output = $this->pemohon_m->getDetilePemohonByNip($post['nip']);

        echo json_encode($output);
    }
}
