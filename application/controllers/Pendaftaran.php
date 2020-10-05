<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('master_kelengkapan_dokumen_m');
    $this->load->model('kelengkapan_dokumen_m');
    $this->load->model('counter_register_m');
    $this->load->model('permohonan_lama_m');
    $this->load->model('permohonan_m');
    $this->load->model('pemohon_m');
    $this->load->helper('paging');
  }

  public function index()
  {
    $user = $this->session->userdata('usertype');
    $view_data = [
      "page_title" => "Pendaftaran",
      "content" => "pendaftaran/index",
      "custom_js" => ($user == 13) ? "pendaftaran/pemohon_custom_js" : "pendaftaran/custom_js",
      "parent_menu" => 'pendaftaran',
      "usertype" => $user,
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
    foreach ($result as $val) {
      $tombol = "<a href=" . $val['c_nip'] . ">Edit</a> | <a href=" . $val['c_nip'] . ">Detile</a> | <a href=" . $val['c_nip'] . ">Delete</a>";
      $tr .= "<tr>";
      $tr .= "<td>" . $val['c_nip'] . "</td>";
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

  public function permohonan_ajax($page = 0)
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
    $result = $this->permohonan_m->get_antrian_ap($limit, $page, $cari, $jenisIjin, $jenisPermohonan);

    $paging_data = [
      'count' => $count,
      'limit' => $limit,
      'url' => base_url() . 'pendaftaran/permohonan_ajax'
    ];

    $tr = "";
    foreach ($result as $val) {
      $tombol = "<a href=" . $val['c_id_register'] . ">Edit</a> | <a href=" . $val['c_id_register'] . ">Detile</a> | <a href=" . $val['c_id_register'] . ">Delete</a>";
      // $tr .= "<tr>";
      // $tr .= "<td>" . $val['c_id_register'] . "</td>";
      // $tr .= "<td>" . $val['c_status_permohonan'] . "</td>";
      // $tr .= "<td>" . $val['c_nama_pemohon'] . "</td>";
      // $tr .= "<td>" . $val['deskripsi'] . "</td>";
      // $tr .= "<td><center>" . $tombol . "</center></td>";
      // $tr .= "</tr>";
    }

    $data['pagination'] = paging($paging_data);
    $data['body_table'] = $tr;
    $data['page'] = $page;
    $data['rows'] = $post['row'];
    $data['info'] = "Tampil " . count($result) . " data dari " . $count . " total data";

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

    $count = $this->permohonan_lama_m->countAllData($cari, $jenisIjin, $jenisPermohonan);
    $result = $this->permohonan_lama_m->getAllPerijinan($limit, $page, $cari, $jenisIjin, $jenisPermohonan);

    $paging_data = [
      'count' => $count,
      'limit' => $limit,
      'url' => base_url() . 'pendaftaran/permohonan_lama_ajax'
    ];

    $tr = "";
    foreach ($result as $val) {
      $tombol = "<a href=" . $val['id_register'] . ">Edit</a> | <a href=" . $val['id_register'] . ">Detile</a> | <a href=" . $val['id_register'] . ">Delete</a>";
      $tr .= "<tr>";
      $tr .= "<td>" . $val['id_register'] . "</td>";
      $tr .= "<td>" . $val['tipe_permohonan'] . "</td>";
      $tr .= "<td>" . $val['nama_pemohon'] . "</td>";
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

  public function tambah()
  {
    $view_data = [
      "page_title" => "Tambah Permohonan",
      "content" => "pendaftaran/tambah",
      "custom_js" => "pendaftaran/tambah_js",
      "parent_menu" => 'pendaftaran',
      "layout" => 1
    ];

    $this->load->view('main', $view_data);
  }

  public function simpan()
  {
    $post = $this->input->post();
    $session = $this->session->userdata();
    $master_dokumen = $this->master_kelengkapan_dokumen_m->getKelengkapanDokumenByJenisIIjin($post['id_jenis_ijin']);
    // var_dump($post); die; 
    $data = [
      'c_id_register' => $this->create_id_register(),
      'c_nip' => $post['nip'],
      'c_no_surat_permohonan' => $post['no_surat_permohonan'],
      'c_tgl_permohonan' => date('Y-m-d', strtotime($post['tgl_permohonan'])),
      'c_status' => 'Baru',
      'c_id_jenis_ijin' => $post['id_jenis_ijin'],
      'c_id_user' => $session['userid'],
      'c_alamat_usaha' => $post['alamat_usaha'],
      'c_id_kelurahan_usaha' => $post['kel_usaha'],
      'c_id_kecamatan_usaha' => $post['kec_usaha'],
      'c_aktif' => 'Y',
      'c_id_user' => $session['userid']
    ];

    if (is_array($post['kelengkapan_dokumen'])) {
      foreach ($post['kelengkapan_dokumen'] as $key => $val) {
          $data_kelengkapan[$key] = $val;
      }
    } else {
      $data_kelengkapan = array();
    }
    $this->kelengkapan_dokumen_m->createOrUpdate($data, $data_kelengkapan, $master_dokumen);
        
    $data_tahap['id_tahap'] = 1;
    $this->tahap_permohonan_m->insert_tahap($data, $data_tahap);
    $this->permohonan_m->createOrUpdate($data);
    // set param agar load tab permohonan
    $this->session->set_flashdata('tab_active', "1");

    redirect('pendaftaran');
  }

  public function create_id_register()
  {
    $tahun = Date('Y');
    $bulan = Date('m');
    $today = Date('Y-m-d H:i:s');
    $counter_nomor = $this->counter_register_m->getIdRegister($bulan, $tahun);
    $session = $this->session->userdata();
    
    if ($counter_nomor->num_rows() == 0) {
      $nomor = 1;

      $this->counter_register_m->createOrUpdate($nomor, $session, $today, $bulan, $tahun);
    } else {
      $row = $counter_nomor->row();
      $nomor = abs($row->counter_nomor) + 1;
      // var_dump($row); die;
      $this->counter_register_m->createOrUpdate($nomor, $session, $today, $bulan, $tahun, $row->counter_id);
    }

    $nomor_real = '0000';
    return $tahun . $bulan . substr_replace($nomor_real, $nomor, 4 - strlen($nomor), 4);
  }

  public function kelengkapan_dokumen_ajax()
  {
    $post = $this->input->post();
    $output = $this->master_kelengkapan_dokumen_m->getKelengkapanDokumenByJenisIIjin($post['id_jenis_ijin']);

    echo json_encode($output);
  }
}
