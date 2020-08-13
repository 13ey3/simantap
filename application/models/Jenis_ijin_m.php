<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_ijin_m extends CI_Model {

    public function getListIjin()
    {
        $this->db->select('id_jenis_ijin, deskripsi');
        $this->db->from('jenis_perijinan');
        $this->db->where('aktif', 'Y');
        $query = $this->db->get();
        return $query;
    }
}
