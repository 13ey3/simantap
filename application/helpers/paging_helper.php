<?php

function paging($data)
{
    $CI =& get_instance();
    $CI->load->library('pagination');

    // Pagination Configuration
    $config['base_url'] = $data['url'];
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $data['count'];
    $config['per_page'] = $data['limit'];
    // page style
    $config['full_tag_open']    = '<div class="pagging"><ul class="pagination pagination-sm justify-content-end">';
    $config['full_tag_close']   = '</ul></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close']  = '</span></li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close']  = '</span></li>';

    // Initialize pagination
    $CI->pagination->initialize($config);

    return $CI->pagination->create_links();
}
