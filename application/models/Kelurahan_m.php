<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Kelurahan_m extends CI_Model
{
    public function getAllKelurahanByKecamtanId($id_kecamatan)
    {
        $this->db->select('id_kelurahan, deskripsi');
        $this->db->from('kelurahan');
        $this->db->where('id_kecamatan', $id_kecamatan);
        $this->db->where('aktif', 'Y');
        return $this->db->get();
    }
}
