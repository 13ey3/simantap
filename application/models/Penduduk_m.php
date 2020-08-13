<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Penduduk_m extends CI_Model {

    public function getPendudukByNik($nik)
    {
        $db_penduduk = $this->load->database('penduduk', TRUE);
        $query = $db_penduduk->select('*')
                            ->from('penduduks')
                            ->where('nik', $nik)
                            ->get();
        return $query->row_array();
    }
}
