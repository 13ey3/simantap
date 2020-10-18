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

    public function list_kelengkapan_dokumen($id_register, $id_jenis_ijin)
    {
        $dt = $this->db->select()
            ->from('master_kelengkapan_dokumen a')
            ->join('kelengkapan_dokumen b', 'a.id_dokumen = b.id_dokumen', 'left')
            ->where('a.id_jenis_ijin', $id_jenis_ijin)
            ->where('a.aktif', 'Y')
            ->where('b.id_register', $id_register)
            ->get()->result();

        foreach ($dt as $row) {
            $status = (empty($row->status)) ? 'N' : 'Y';

            $result[] = array(
                'id_dokumen' => $row->id_dokumen,
                'deskripsi' => $row->deskripsi,
                'status' => $status
            );
        }

        return $result;
    }
}
