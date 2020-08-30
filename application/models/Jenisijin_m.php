<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Jenisijin_m extends CI_Model
{

    public function getAllIjin($rows, $pages, $cari)
    {
        if ($cari != null || $cari != "") {
            $where = "a.nama_singkat LIKE '%" . $cari . "%' OR b.deskripsi LIKE '%" . $cari . "%' OR a.deskripsi LIKE '%" . $cari . "%'";
            $this->db->where($where);
        }

        // if ($jenis_usaha != null || $jenis_usaha != "") {
        //     $where = "a.c_id_usaha = $jenis_usaha";
        //     $this->db->where($where);
        // }

        $this->db->select('a.id_jenis_ijin, a.deskripsi as nama_ijin, a.nama_singkat, a.aktif, b.deskripsi as nama_dinas');
        $this->db->from('jenis_perijinan a');
        $this->db->join('dinas b', 'b.id_dinas = a.id_dinas', 'left');
        $this->db->limit($rows, $pages);
        $this->db->order_by('id_jenis_ijin', 'ASC');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function countAllPerijinan($cari)
    {
        if ($cari != null || $cari != "") {
            $where = "a.nama_singkat LIKE '%" . $cari . "%' OR b.deskripsi LIKE '%" . $cari . "%' OR a.deskripsi LIKE '%" . $cari . "%'";
            $this->db->where($where);
        }

        // if ($jenis_usaha != null || $jenis_usaha != "") {
        //     $where = "a.c_id_usaha = $jenis_usaha";
        //     $this->db->where($where);
        // }

        $this->db->select('count(id_jenis_ijin) as allcount');
        $this->db->from('jenis_perijinan a');
        $this->db->join('dinas b', 'b.id_dinas = a.id_dinas', 'left');
        $q = $this->db->get()->result_array();

        return $q[0]['allcount'];
    }
}
