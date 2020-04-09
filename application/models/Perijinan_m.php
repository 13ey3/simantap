<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perijinan_m extends CI_Model {
  
  public $table = 'perijinan';
  public $table2 = 'jenis_perijinan';

  public function getAllPerijinan($rows, $pages, $cari) {
    if ($cari != null || $cari != "") {

      $where = "id_register LIKE '%". $cari ."%' OR nama_pemohon LIKE '%". $cari ."%' OR tipe_permohonan LIKE '%". $cari ."%' OR deskripsi LIKE '%". $cari ."%'";
      $this->db->where($where);
    }

    $this->db->select('*');
    $this->db->from('perijinan a');
    $this->db->join('jenis_perijinan b', 'b.id_jenis_ijin = a.id_jenis_ijin', 'left');
    $this->db->limit($rows, $pages);  
    return $q = $this->db->get()->result_array();
  }

  public function countAllData($cari = null) {
    if ($cari != null || $cari != "") {

      $where = "id_register LIKE '%". $cari ."%' OR nama_pemohon LIKE '%". $cari ."%' OR tipe_permohonan LIKE '%". $cari ."%' OR deskripsi LIKE '%". $cari ."%'";
      $this->db->where($where);
    }

    $this->db->select('count(id_register) as allcount');
    $this->db->from('perijinan a');
    $this->db->join('jenis_perijinan b', 'b.id_jenis_ijin = a.id_jenis_ijin', 'left');
    $query = $this->db->get();
    $result = $query->result_array();
 
    return $result[0]['allcount'];
  }
}
