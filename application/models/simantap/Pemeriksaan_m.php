<?php
defined('BASEPATH') || exit('No direct access script allowed!');

class Pemeriksaan_m extends CI_Model {

    public function get_detile_verifikasi($id_register)
    {
        return $this->db->select('*')
                ->from('t_permohonan a')
                ->join('t_pemohon b', 'a.c_nip = b.c_nip', 'left')
                ->where('a.c_id_register', $id_register)
                ->get();
    }
}