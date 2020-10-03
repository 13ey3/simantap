<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Kelengkapan_dokumen_m extends CI_Model
{
    public function createOrUpdate($data, $data_kelengkapan, $master_dokumen)
    {
        foreach ($master_dokumen as $master) {
            $data_dokumen['id_register'] = $data['c_id_register'];
            $data_dokumen['id_dokumen'] = $master['id_dokumen'];
            $data_dokumen['status'] = (isset($data_kelengkapan[$master['id_dokumen']]))
                                        ? 'Y' : 'N';
            $this->db->set('tgl_create', 'now()', FALSE);
            $this->db->set('tgl_update', 'now()', FALSE);  
            $this->db->set('id_user', $this->session->userdata('userid'), TRUE); 
            $this->db->insert('kelengkapan_dokumen', $data_dokumen); 
        }
    }
}
