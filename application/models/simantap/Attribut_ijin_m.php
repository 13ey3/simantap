<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Attribut_ijin_m extends CI_Model
{
    public function list_attribut_ijin($id_jenis_ijin)
    {
        return $this->db->get_where('master_atribut_perijinan', array('id_jenis_ijin' => $id_jenis_ijin, 'aktif' => 'Y'));
    }
}