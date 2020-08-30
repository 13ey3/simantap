<?php
defined('BASEPATH') || exit('No direct script access allowed');

class JenisIzin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('paging');
        $this->load->model('jenisijin_m');
    }

    public function index()
    {
        $view_data = [
            "page_title" => "Jenis Ijin",
            "content" => "jenis_ijin/index",
            "custom_js" => "jenis_ijin/custom_js",
            "parent_menu" => 'setting',
            "child_menu" => 'jenis_izin',
            "layout" => 1
        ];

        $this->load->view('main', $view_data);
    }

    public function jenisijin_ajax($page)
    {
        $post = $this->input->post();

        $cari = $post['cari'];
        $limit = $post['row'];

        if ($page != 0) {
            $page = ($page - 1) * $limit;
        }

        $count = $this->jenisijin_m->countAllPerijinan($cari);
        $result = $this->jenisijin_m->getAllIjin($limit, $page, $cari);

        $paging_data = [
            'count' => $count,
            'limit' => $limit,
            'url' => base_url() . 'pendaftaran/pemohon_ajax'
        ];

        $tr = "";
        foreach ($result as $index => $val) {
            $no = $index + 1;
            $tombol = "<a href=" . $val['id_jenis_ijin'] . ">Edit</a> | <a href=" . $val['id_jenis_ijin'] . ">Delete</a>";
            $tr .= "<tr>";
            $tr .= "<td>" . $no . "</td>";
            $tr .= "<td>" . $val['nama_ijin'] . "</td>";
            $tr .= "<td>" . $val['nama_dinas'] . "</td>";
            $tr .= "<td>" . $val['aktif'] . "</td>";
            $tr .= "<td><center>" . $tombol . "</center></td>";
            $tr .= "</tr>";
            // var_dump($val);
        }
        // die;

        $data['pagination'] = paging($paging_data);
        $data['body_table'] = $tr;
        $data['page'] = $page;
        $data['rows'] = $post['row'];
        $data['info'] = "Tampil " . count($result) . " data dari " . $count . " total data";

        echo json_encode($data);
    }

    public function tambah()
    {
        echo "menu tambah jenis izin";
    }

    public function edit()
    {
        echo "menu edit jenis izin";
    }
}
