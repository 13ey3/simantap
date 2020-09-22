<?php
defined('BASEPATH') || exit('No direct script access allowed');

class User_m extends CI_Model
{

    public function addOrUpdateUsers($post, $userid = null)
    {
        $data = array(
            's_username' => (isset($post['username'])) ? $post['username'] : null,
            's_password' => (isset($post['password'])) ? $post['password'] : null,
            's_jenis_user' => (isset($post['jenis_user'])) ? $post['jenis_user'] : null,
            's_userid_detile' => (isset($post['userid_detile'])) ? $post['userid_detile'] : null,
            's_active' => (isset($post['is_active'])) ? $post['is_active'] : false
        );

        if ($userid == null) {
            $this->db->insert('s_users', $data);
        } else {
            $this->db->update('s_users', $data, array('s_userid' => $userid));
        }
    }

    public function getUser($username = null)
    {
        $this->db->select('*');
        $this->db->from('s_users');
        // $this->db->join('t_pemohon', 't_pemohon.c_nip = s_users.s_userid_detile', 'left');
        $this->db->where('s_username', $username);
        return $this->db->get();
    }


    public function activateUser($nip)
    {
        $data = array(
            's_active' => 1
        );

        $this->db->update('s_users', $data, array('s_username' => $nip));
    }
}
