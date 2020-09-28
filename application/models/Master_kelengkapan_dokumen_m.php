<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Master_kelengkapan_dokumen_m extends CI_Model
{
    public function getKelengkapanDokumenByJenisIIjin($id_jenis_ijin)
    {
        return $this->db->select('id_dokumen, deskripsi')
                ->from('master_kelengkapan_dokumen')
                ->where('aktif', 'Y')
                ->where('id_jenis_ijin', $id_jenis_ijin)
                ->get()
                ->result_array();
    }
}
