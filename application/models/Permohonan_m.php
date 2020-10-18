<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Permohonan_m extends CI_Model
{
  public function getAllPerijinan($rows, $pages, $cari, $jenis_ijin, $jenis_permohonan)
  {
    if ($cari != null || $cari != "") {
      $where = "c_id_register LIKE '%" . $cari . "%' OR c_nama_pemohon LIKE '%" . $cari . "%' OR c_status_permohonan LIKE '%" . $cari . "%' OR deskripsi LIKE '%" . $cari . "%'";
      $this->db->where($where);
    }

    if ($jenis_ijin != null || $jenis_ijin != "") {
      $where = "a.c_id_jenis_ijin = $jenis_ijin";
      $this->db->where($where);
    }

    if ($jenis_permohonan != null || $jenis_permohonan != "") {
      $where = "a.c_status_permohonan = '$jenis_permohonan'";
      $this->db->where($where);
    }

    $this->db->select('*');
    $this->db->from('t_permohonan a');
    $this->db->join('jenis_perijinan b', 'b.id_jenis_ijin = a.c_id_jenis_ijin', 'left');
    $this->db->join('t_pemohon c', 'c.c_nip = a.c_nip', 'left');
    $this->db->limit($rows, $pages);
    $this->db->order_by('c_id_register', 'DESC');
    $q = $this->db->get();
    return $q->result_array();
  }

  public function countAllData($cari, $jenis_ijin, $jenis_permohonan)
  {
    if ($cari != null || $cari != "") {

      $where = "c_id_register LIKE '%" . $cari . "%' OR c_nama_pemohon LIKE '%" . $cari . "%' OR c_status_permohonan LIKE '%" . $cari . "%' OR deskripsi LIKE '%" . $cari . "%'";
      $this->db->where($where);
    }

    if ($jenis_ijin != null || $jenis_ijin != "") {
      $where = "a.c_id_jenis_ijin = $jenis_ijin";
      $this->db->where($where);
    }

    if ($jenis_permohonan != null || $jenis_permohonan != "") {
      $where = "a.c_status_permohonan = '$jenis_permohonan'";
      $this->db->where($where);
    }

    $this->db->select('count(c_id_register) as allcount');
    $this->db->from('t_permohonan a');
    $this->db->join('jenis_perijinan b', 'b.id_jenis_ijin = a.c_id_jenis_ijin', 'left');
    $this->db->join('t_pemohon c', 'c.c_nip = a.c_nip', 'left');
    $query = $this->db->get();
    $result = $query->result_array();

    return $result[0]['allcount'];
  }

  public function get_antrian_ap($rows, $pages, $cari, $jenis_ijin)
  {
    $this->db->select("a.`task_id`, a.`id_register`, b.`c_id_jenis_ijin`, c.`deskripsi` as nama_ijin, d.`lama_proses`, e.`c_nama_pemohon`, a.`task_state` as status, DATE_FORMAT(b.`c_tgl_create`, '%d-%m-%Y %H:%i:%s') as tgl_mulai, DATE_FORMAT(DATE_ADD(b.`c_tgl_create`, INTERVAL d.`lama_proses` DAY_HOUR), '%d-%m-%Y %H:%i:%s') as target, DATEDIFF(CURDATE(),DATE_ADD(b.`c_tgl_create`, INTERVAL d.`lama_proses` DAY_HOUR)) as kondisi");
    $this->db->from('simantap_task a');
    $this->db->join('t_permohonan b', 'b.c_id_register = a.id_register', 'right');
    $this->db->join('jenis_perijinan c', 'b.c_id_jenis_ijin = c.id_jenis_ijin', 'left');
    $this->db->join('simantap_workflow d', 'a.workflow_id = d.workflow_id', 'left');
    $this->db->join('t_pemohon e', 'e.c_nip = b.c_nip', 'left');
    $this->db->where('a.task_status', TRUE);
    $this->db->where('a.task_start', 1);
    $this->db->limit($rows, $pages);
    $this->db->order_by('b.c_tgl_create', 'DESC');
    $query = $this->db->get();

    return $query->result_array();
  }

  public function count_antrian_ap($cari, $jenis_ijin)
  {
    $this->db->select("count(c_id_register) as allcount");
    $this->db->from('simantap_task a');
    $this->db->join('t_permohonan b', 'b.c_id_register = a.id_register', 'right');
    $this->db->join('jenis_perijinan c', 'b.c_id_jenis_ijin = c.id_jenis_ijin', 'left');
    $this->db->join('simantap_workflow d', 'a.workflow_id = d.workflow_id', 'left');
    $this->db->join('t_pemohon e', 'e.c_nip = b.c_nip', 'left');
    $this->db->where('a.task_status', TRUE);
    $this->db->where('a.task_start', 1);
    $query = $this->db->get()->result_array();

    return $query[0]['allcount'];
  }

  public function createOrUpdate($data)
  {
    $this->db->set('c_tgl_create', 'now()', FALSE);
    $this->db->insert('t_permohonan', $data);
  }
}
