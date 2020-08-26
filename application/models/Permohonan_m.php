<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Permohonan_m extends CI_Model
{
  public function getAllPerijinan($rows, $pages, $cari, $jenis_ijin, $jenis_permohonan)
  {
    if ($cari != null || $cari != "") {
      $where = "id_register LIKE '%" . $cari . "%' OR nama_pemohon LIKE '%" . $cari . "%' OR tipe_permohonan LIKE '%" . $cari . "%' OR deskripsi LIKE '%" . $cari . "%'";
      $this->db->where($where);
    }

    if ($jenis_ijin != null || $jenis_ijin != "") {
      $where = "a.id_jenis_ijin = $jenis_ijin";
      $this->db->where($where);
    }

    if ($jenis_permohonan != null || $jenis_permohonan != "") {
      $where = "a.tipe_permohonan = '$jenis_permohonan'";
      $this->db->where($where);
    }

    $this->db->select('*');
    $this->db->from('perijinan a');
    $this->db->join('jenis_perijinan b', 'b.id_jenis_ijin = a.id_jenis_ijin', 'left');
    $this->db->limit($rows, $pages);
    $this->db->order_by('id_register', 'DESC');
    $q = $this->db->get();
    return $q->result_array();
  }

  public function countAllData($cari, $jenis_ijin, $jenis_permohonan)
  {
    if ($cari != null || $cari != "") {

      $where = "id_register LIKE '%" . $cari . "%' OR nama_pemohon LIKE '%" . $cari . "%' OR tipe_permohonan LIKE '%" . $cari . "%' OR deskripsi LIKE '%" . $cari . "%'";
      $this->db->where($where);
    }

    if ($jenis_ijin != null || $jenis_ijin != "") {
      $where = "a.id_jenis_ijin = $jenis_ijin";
      $this->db->where($where);
    }

    if ($jenis_permohonan != null || $jenis_permohonan != "") {
      $where = "a.tipe_permohonan = '$jenis_permohonan'";
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
