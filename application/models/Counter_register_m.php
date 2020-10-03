<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Counter_register_m extends CI_Model
{
    public function getIdRegister($bulan, $tahun)
    {
        return $this->db->select('counter_id, counter_nomor')
            ->from('counter_register')
            ->where('counter_bulan', $bulan)
            ->where('counter_tahun', $tahun)
            ->get();
    }

    public function createOrUpdate($nomor, $session, $today, $bulan, $tahun, $id = null)
    {
        if ($id == null) {
            $data = array(
                'counter_tahun' => $tahun,
                'counter_bulan' => $bulan,
                'counter_nomor' => $nomor,
                'tgl_update'    => $today,
                'user_update'   => $session['name'],
                'id_user'       => $session['userid'],
            );

            $this->db->insert('counter_register', $data);
        } else {
            $data = array(
                'counter_nomor' => $nomor,
                'tgl_update'    => $today,
                'user_update'   => $session['name'],
            );
            
            $this->db->where('counter_id', $id);
            $this->db->update('counter_register', $data);
        }
    }
}
