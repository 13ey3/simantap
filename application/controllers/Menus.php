<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Menus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menus_m');
    }

    public function menu_ajax()
    {
        $parent_menus = [];
        $child_menus = array();
        $parents = $this->menus_m->get_parent_menu();

        foreach ($parents as $parent) {
            $childs = $this->menus_m->get_child_menu($parent['s_idmenu']);

            if (count($childs) > 0) {
                $parent_menus[] = [
                    'id' => $parent['s_idmenu'],
                    'nama' => $parent['s_nama_menu'],
                    'link' => $parent['s_url_menu'],
                    'icon' => $parent['s_icon_menu'],
                    'have_child' => true
                ];

                foreach ($childs as $child) {

                    $child_menus[] = [
                        'nama' => $child['s_nama_menu'],
                        'link' => $child['s_url_menu'],
                        'icon' => $child['s_icon_menu'],
                        'parent_id' => $parent['s_idmenu']
                    ];
                }
            } else {
                $parent_menus[] = [
                    'id' => $parent['s_idmenu'],
                    'nama' => $parent['s_nama_menu'],
                    'link' => $parent['s_url_menu'],
                    'icon' => $parent['s_icon_menu'],
                    'have_child' => false
                ];
            }
        }

        $output = [
            'parent_menu' => $parent_menus,
            'child_menu' => $child_menus
        ];

        echo json_encode($output);
    }
}
