<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Menus_m extends CI_Model
{
    public function get_parent_menu()
    {
        $q = $this->db->where('s_parent_menu', 0)
            ->order_by('s_nourut_utama', 'asc')
            ->get('s_menus');
            
        return $q->result_array();
    }

    function get_child_menu($id)
    {
        $q = $this->db->where('s_parent_menu', $id)
            ->order_by('s_nourut_child', 'asc')
            ->get('s_menus');

        return $q->result_array();
    }
}
