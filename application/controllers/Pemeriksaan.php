<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('simantap/pemeriksaan_m', 'pemeriksaan_m');
        $this->load->model('simantap/attribut_ijin_m', 'attribut_ijin');
        $this->load->model('kelengkapan_dokumen_m');
        $this->load->model('permohonan_m');
        $this->load->helper('paging');
    }

    public function index()
    {
        $user = $this->session->userdata('usertype');
        $view_data = [
            "page_title" => "Daftar Permohonan",
            "content" => "pemeriksaan/index",
            "custom_js" => "pemeriksaan/pemeriksaan_js",
            "parent_menu" => "pemeriksaan",
            "layout" => 1
        ];

        $this->load->view('main', $view_data);
    }

    public function data_ajax($page)
    {
        $post = $this->input->post();

        $cari = $post['cari'];
        $jenisIjin = $post['jenisIjin'];
        // $jenisPermohonan = $post['jenisPermohonan'];
        $limit = $post['row'];

        if ($page != 0) {
            $page = ($page - 1) * $limit;
        }

        $count = $this->permohonan_m->count_antrian_ap($cari, $jenisIjin);
        $result = $this->permohonan_m->get_antrian_ap($limit, $page, $cari, $jenisIjin);
        
        $paging_data = [
            'count' => $count,
            'limit' => $limit,
            'url' => base_url() . 'pendaftaran/permohonan_ajax'
        ];

        $tr = array();
        foreach ($result as $val) {
            $tombol = "<a href='pemeriksaan/verifikasi/" . $val['id_register'] . "' class='btn btn-outline-info btn-sm' style='width: max-content;'>Verifikasi Administrasi</a>";
            
            $tr[] = [$val['id_register'], $val['c_nama_pemohon'], $val['nama_ijin'], $val['target'], $tombol];
        } 
        
        $data['pagination'] = paging($paging_data);
        $data['body_table'] = $tr;
        $data['page'] = $page;
        $data['rows'] = $post['row'];
        $data['info'] = "Tampil " . count($result) . " data dari " . $count . " total data";
        
        echo json_encode($data);
    }

    public function verifikasi($id_register)
    {
        $data_permohonan = $this->pemeriksaan_m->get_detile_verifikasi($id_register)->row_array();
        $data_kelengkapan = $this->kelengkapan_dokumen_m->list_kelengkapan_dokumen($id_register, $data_permohonan['c_id_jenis_ijin']);
        $data_attribut = $this->attribut_ijin->list_attribut_ijin($data_permohonan['c_id_jenis_ijin'])->result_array();
        

        $view_data = [
            "page_title" => "Verifikasi Permohonan",
            "content" => "pemeriksaan/verifikasi",
            "custom_js" => "pemeriksaan/verifikasi_js",
            "parent_menu" => "pemeriksaan",
            "layout" => 1,
            "data_permohoan" => $data_permohonan,
            "data_kelengkapan" => $data_kelengkapan,
            "data_attribut" => json_encode($data_attribut)
        ];

        $this->load->view('main', $view_data);
    }
}
