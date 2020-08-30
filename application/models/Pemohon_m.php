<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pemohon_m extends CI_Model
{
    public function getAllPemohon($rows, $pages, $cari, $jenis_usaha)
    {
        if ($cari != null || $cari != "") {
            $where = "c_nip LIKE '%" . $cari . "%' OR c_nama_pemohon LIKE '%" . $cari . "%' OR deskripsi LIKE '%" . $cari . "%'";
            $this->db->where($where);
        }

        if ($jenis_usaha != null || $jenis_usaha != "") {
            $where = "a.c_id_usaha = $jenis_usaha";
            $this->db->where($where);
        }

        $this->db->select('*');
        $this->db->from('t_pemohon a');
        $this->db->join('jenis_usaha b', 'b.id_usaha = a.c_id_usaha', 'left');
        $this->db->limit($rows, $pages);
        $this->db->order_by('c_nip', 'ASC');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function countAllPemohon($cari, $jenis_usaha)
    {
        if ($cari != null || $cari != "") {
            $where = "c_nip LIKE '%" . $cari . "%' OR c_nama_pemohon LIKE '%" . $cari . "%' OR deskripsi LIKE '%" . $cari . "%'";
            $this->db->where($where);
        }

        if ($jenis_usaha != null || $jenis_usaha != "") {
            $where = "a.c_id_usaha = $jenis_usaha";
            $this->db->where($where);
        }

        $this->db->select('count(c_id_pemohon) as allcount');
        $this->db->from('t_pemohon a');
        $this->db->join('jenis_usaha b', 'b.id_usaha = a.c_id_usaha', 'left');
        $q = $this->db->get()->result_array();

        return $q[0]['allcount'];
    }

    public function addOrUpdate($post, $nip = null)
    {
        $data = [
            'c_id_pemohon' => (isset($post['id_pemohon'])) ? $post['id_pemohon'] : null,
            'c_nip' => (isset($post['nip'])) ? $post['nip'] : null,
            'c_nama_pemohon' => (isset($post['nama_pemohon'])) ? $post['nama_pemohon'] : null,
            'c_nama_badan_usaha' => (isset($post['nama_badan_usaha'])) ? $post['nama_badan_usaha'] : null,
            'c_nama_penanggung_jawab' => (isset($post['nama_penanggung_jawab'])) ? $post['nama_penanggung_jawab'] : null,
            'c_jbt_penanggung_jawab' => (isset($post['jbt_penanggung_jawab'])) ? $post['jbt_penanggung_jawab'] : null,
            'c_id_usaha' => (isset($post['jenis_usaha'])) ? $post['jenis_usaha'] : null,
            'c_alamat_pemohon' => (isset($post['alamat_pamohon'])) ? $post['alamat_pamohon'] : null,
            'c_id_kelurahan_pemohon' => (isset($post['id_kelurahan_pemohon'])) ? $post['id_kelurahan_pemohon'] : null,
            'c_id_kecamatan_pemohon' => (isset($post['id_kecamatan_pemohon'])) ? $post['id_kecamatan_pemohon'] : null,
            'c_kota' => (isset($post['kota_pemohon'])) ? $post['kota_pemohon'] : null,
            'c_telpon' => (isset($post['telpon'])) ? $post['telpon'] : null,
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
            $this->db->update('t_pemohon', $data, array('c_nip' => $nip));
        }
    }

    public function findEmailPemohon($email)
    {
        return $this->db->get_where('t_pemohon', array('c_email' => $email));
    }

    public function findNikPemohon($nik)
    {
        return $this->db->get_where('t_pemohon', array('c_no_identitas' => $nik));
    }

    public function getMaxId()
    {
        $this->db->select_max('c_id_pemohon');
        return $this->db->get('t_pemohon')->row();
    }
}
