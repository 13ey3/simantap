<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permohonan_m');
    }
    public function index()
    {
        $user = $this->session->userdata('usertype');
        $view_data = [
            "page_title" => "Daftar Permohonan",
            "content" => "pemeriksaan/index",
            "custom_js" => "",
            "parent_menu" => "pemeriksaan",
            "layout" => 1
        ];

        $this->load->view('main', $view_data);
    }

    public function data_ajax()
    {
        $post = $this->input->post();

        $cari = $post['cari'];
        $jenisIjin = $post['jenisIjin'];
        $jenisPermohonan = $post['jenisPermohonan'];
        $limit = $post['row'];

        if ($page != 0) {
            $page = ($page - 1) * $limit;
        }

        $count = $this->permohonan_m->countAllData($cari, $jenisIjin, $jenisPermohonan);
        $result = $this->permohonan_m->getAllPerijinan($limit, $page, $cari, $jenisIjin, $jenisPermohonan);

        $paging_data = [
            'count' => $count,
            'limit' => $limit,
            'url' => base_url() . 'pendaftaran/permohonan_ajax'
        ];

        $tr = "";
        foreach ($result as $val) {
            $tombol = "<a href=" . $val['c_id_register'] . ">Edit</a> | <a href=" . $val['c_id_register'] . ">Detile</a> | <a href=" . $val['c_id_register'] . ">Delete</a>";
            $tr .= "<tr>";
            $tr .= "<td>" . $val['c_id_register'] . "</td>";
            $tr .= "<td>" . $val['c_status_permohonan'] . "</td>";
            $tr .= "<td>" . $val['c_nama_pemohon'] . "</td>";
            $tr .= "<td>" . $val['deskripsi'] . "</td>";
            $tr .= "<td><center>" . $tombol . "</center></td>";
            $tr .= "</tr>";
        }

        $data['pagination'] = paging($paging_data);
        $data['body_table'] = $tr;
        $data['page'] = $page;
        $data['rows'] = $post['row'];
        $data['info'] = "Tampil " . count($result) . " data dari " . $count . " total data";

        echo json_encode($data);
    }
}
