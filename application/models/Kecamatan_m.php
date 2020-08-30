<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Kecamatan_m extends CI_Model
{
    public function getAllKecamatan()
    {
        $this->db->select('id_kecamatan, deskripsi');
        $this->db->from('kecamatan');
        $this->db->where('aktif', 'Y');
        return $this->db->get();
    }
}
