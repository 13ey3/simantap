<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('permohonan_m');
    $this->load->model('pemohon_m');
    $this->load->helper('paging');
  }

  public function index()
  {
    $view_data = [
      "page_title" => "Pendaftaran",
      "content" => "pendaftaran/index",
      "custom_js" => "pendaftaran/custom_js",
      "layout" => 1
    ];

    $this->load->view('main', $view_data);
  }

  public function pemohon_ajax($page = 0)
  {
    $post = $this->input->post();

    $cari = $post['cari'];
    $jenis_usaha = $post['jenis_usaha'];
    $limit = $post['row'];

    if ($page != 0) {
      $page = ($page - 1) * $limit;
    }

    $count = $this->pemohon_m->countAllPemohon($cari, $jenis_usaha);
    $result = $this->pemohon_m->getAllPemohon($limit, $page, $cari, $jenis_usaha);

    $paging_data = [
      'count' => $count,
      'limit' => $limit,
      'url' => base_url() . 'pendaftaran/pemohon_ajax'
    ];

    $tr = "";
    foreach ($result as $key => $val) {
      $tombol = "<a href=" . $val['c_nip'] . ">Edit</a> | <a href=" . $val['c_nip'] . ">Detile</a> | <a href=" . $val['c_nip'] . ">Delete</a>";
      $tr .= "<tr>";
      $tr .= "<td>" . $val['c_nip'] . "</td>";
      $tr .= "<td>" . $val['c_nama_pemohon'] . "</td>";
      $tr .= "<td>" . $val['deskripsi'] . "</td>";
      $tr .= "<td><center>" . $tombol . "</center></td>";
      $tr .= "</tr>";
    }
    // Initialize $data Array
    $data['pagination'] = paging($paging_data);
    $data['body_table'] = $tr;
    $data['page'] = $page;
    $data['rows'] = $post['row'];
    $data['info'] = "Tampil " . ($this->pagination->cur_page * $this->pagination->per_page) . " data dari " . $count . " total data";

    echo json_encode($data);
  }

  public function permohonan_lama_ajax($page = 0)
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
      'url' => base_url() . 'pendaftaran/permohonan_lama_ajax'
    ];

    $tr = "";
    foreach ($result as $key => $val) {
      $tombol = "<a href=" . $val['id_register'] . ">Edit</a> | <a href=" . $val['id_register'] . ">Detile</a> | <a href=" . $val['id_register'] . ">Delete</a>";
      $tr .= "<tr>";
      $tr .= "<td>" . $val['id_register'] . "</td>";
      $tr .= "<td>" . $val['tipe_permohonan'] . "</td>";
      $tr .= "<td>" . $val['nama_pemohon'] . "</td>";
      $tr .= "<td>" . $val['deskripsi'] . "</td>";
      $tr .= "<td><center>" . $tombol . "</center></td>";
      $tr .= "</tr>";
    }
    // Initialize $data Array
    $data['pagination'] = paging($paging_data);
    $data['body_table'] = $tr;
    $data['page'] = $page;
    $data['rows'] = $post['row'];
    $data['info'] = "Tampil " . ($this->pagination->cur_page * $this->pagination->per_page) . " data dari " . $count . " total data";

    echo json_encode($data);
  }

  public function tambah()
  {
    $post = $this->input->post();

    $view_data = [
      "page_title" => "Tambah Permohonan",
      "content" => "pendaftaran/tambah",
      "custom_js" => "pendaftaran/custom_js",
      "layout" => 1
    ];

    $this->load->view('main', $view_data);
  }
}
