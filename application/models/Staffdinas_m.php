<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Staffdinas_m extends CI_Model
{
    public function getStaffById($id)
    {
        return $this->db->get_where('t_user_dinas', array('t_iduser' => $id))->row_array();
    }
}
