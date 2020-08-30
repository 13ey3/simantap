<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Jenis_usaha_m extends CI_Model
{
    public function getALlJenisUsaha()
    {
        $q = $this->db->select("id_usaha, deskripsi")
            ->from("jenis_usaha")
            ->where('aktif', 'Y')
            ->get();

        return $q->result_array();
    }
}
