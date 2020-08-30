<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// menu setting jenis izin
$route['jenis_izin'] = 'setting/JenisIzin';
$route['jenis_izin/(:any)'] = 'setting/JenisIzin/$1';
$route['jenis_izin/(:any)/(:any)'] = 'setting/JenisIzin/$1/$2';

$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
