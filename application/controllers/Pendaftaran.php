<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('perijinan_m');
    $this->load->library('pagination');
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

  public function ajax_grid($page = 0)
  {
    $post = $this->input->post();
    $cari = $post['cari'];
    $limit = $post['row'];
    // posisi page
    if($page != 0){
      $page = ($page-1) * $limit;
    }

    $count = $this->perijinan_m->countAllData($cari); // total data
    $result = $this->perijinan_m->getAllPerijinan($limit, $page, $cari); // data result

    // Pagination Configuration
    $config['base_url'] = base_url().'pendaftaran/ajax_grid';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $count;
    $config['per_page'] = $limit;
    // page style
    $config['full_tag_open']    = '<div class="pagging"><ul class="pagination justify-content-end">';
    $config['full_tag_close']   = '</ul></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close']  = '</span></li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close']  = '</span></li>';

    // Initialize pagination
    $this->pagination->initialize($config);
    $tr = "";
    foreach ($result as $key => $val) {
      $tombol = "<a href=". $val['id_register'].">Edit</a> | <a href=". $val['id_register'].">Detile</a> | <a href=". $val['id_register'].">Delete</a>";
      $tr .= "<tr>";
      $tr .= "<td>". $val['id_register'] ."</td>";
      $tr .= "<td>". $val['tipe_permohonan'] ."</td>";
      $tr .= "<td>". $val['nama_pemohon'] ."</td>";
      $tr .= "<td>". $val['deskripsi'] ."</td>";
      $tr .= "<td><center>". $tombol ."</center></td>";
      $tr .= "</tr>";
    }

    // Initialize $data Array
    $data['pagination'] = $this->pagination->create_links();
    $data['body_table'] = $tr;
    $data['page'] = $page;
    $data['rows'] = $post['row'];
    $data['info'] = "Tampil ".( $this->pagination->cur_page * $this->pagination->per_page)." data dari ". $config['total_rows'] ." total data";

    echo json_encode($data);
  }
}
