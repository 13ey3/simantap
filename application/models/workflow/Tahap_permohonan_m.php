<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Tahap_permohonan_m extends CI_Model
{
    public function insert_tahap($data, $data_tahap)
    {
        foreach ($data_tahap as $id) {
            $deskripsi = $this->get_tahap_permohonan($id);
            $data_tahap['id_register'] = $data['c_id_register'];
            $data_tahap['id_tahap'] = $id;
            $data_tahap['deskripsi'] = $deskripsi->nama;

            $this->db->set('tgl_create', 'now()', false);
            $this->db->set('id_user', $this->session->userdata('userid'), TRUE);
			$this->db->insert('task_tahap_permohonan', $data_tahap);
        }
    }

    public function get_tahap_permohonan($id)
    {
        return $this->db->select('*')
                    ->from('tahap_permohonan')
                    ->where('id_tahap', $id)
                    ->get()->row();
    }
}
