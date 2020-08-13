<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pemohon_m extends CI_Model {

    public function addOrUpdate($post, $nip = null)
    {
        $data = [
            'c_id_pemohon' => (isset($post['id_pemohon'])) ? $post['id_pemohon'] : null,
            'c_nip' => (isset($post['nip'])) ? $post['nip'] : null,
            'c_nama_pemohon' => (isset($post['nama_pemohon'])) ? $post['nama_pemohon'] : null,
            'c_nama_badan_usaha' => (isset($post['nama_badan_usaha'])) ? $post['nama_badan_usaha'] : null,
            'c_nama_penanggung_jawab' => (isset($post['nama_penanggung_jawab'])) ? $post['nama_penanggung_jawab'] : null,
            'c_jbt_penanggung_jawab' => (isset($post['c_jbt_penanggung_jawab'])) ? $post['c_jbt_penanggung_jawab'] : null,
            'c_id_usaha' => (isset($post['id_usaha'])) ? $post['id_usaha'] : null,
            'c_alamat_usaha' => (isset($post['alamat_usaha'])) ? $post['alamat_usaha'] : null,
            'c_id_kelurahan' => (isset($post['id_kelurahan'])) ? $post['id_kelurahan'] : null,
            'c_id_kecamatan' => (isset($post['id_kecamatan'])) ? $post['id_kecamatan'] : null,
            'c_id_kota' => (isset($post['id_kota'])) ? $post['id_kota'] : null,
            'c_telpon' => (isset($post['no_telp'])) ? $post['no_telp'] : null,
            'c_email' => (isset($post['email'])) ? $post['email'] : null,
            'c_no_identitas' => (isset($post['nik'])) ? $post['nik'] : null,
            'c_id_jenis_identitas' => (isset($post['id_jenis_identitas'])) ? $post['id_jenis_identitas'] : null,
            'c_id_warga' => (isset($post['id_warga'])) ? $post['id_warga'] : null,
            'c_npwp' => (isset($post['npwp'])) ? $post['npwp'] : null,
            'c_npwpd' => (isset($post['npwpd'])) ? $post['npwpd'] : null,
            'c_foto_pemilik_usaha' => (isset($post['photo'])) ? $post['photo'] : null
        ];

        if ($nip == null) {
            $this->db->insert('t_pemohon', $data);
        } else {
            $this->db->update('t_pemohon', array('c_nip' => $nip));
        }
    }

    public function getMaxId()
    {
        $this->db->select_max('c_id_pemohon');
        return $this->db->get('t_pemohon')->row();
    }
}