<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha');
	}

	public function index()
	{
		$capcay_conf = array(
				'word'          => $this->capcay_words(),
				'img_path'      => './publik/captcha_images/',
				'img_url'       => base_url().'publik/captcha_images/',
				'font_path'     => './path/to/fonts/texb.ttf',
				'img_width'     => '150',
				'img_height'    => 40,
				'font_size'     => 18,
				'expiration'    => 7200,
				
				// White background and border, black text and red grid
				'colors'        => array(
								'background' => array(255, 128, 200),
								'border' => array(75, 255, 128),
								'text' => array(0, 75, 75),
								'grid' => array(255, 60, 40)
				)
			);
		$capcay = create_captcha($capcay_conf);

		$this->session->unset_userdata('captchaCode');
		$this->session->set_userdata('captchaCode', $capcay['word']);

		$view_data = [
			"page_title" => "Register",
			"content" => "auth/register",
			"captcha_img" => $capcay['image'],
			"custom_js" => "auth/custom_js",
      "layout" => 2
    ];

		$this->load->view('main', $view_data);
	}
	
	public function Register_confirm()
	{
		$view_data = [
			"page_title" => "Konfirmasi Registrasi",
			"content" => "auth/success",
			"custom_js" => "",
			"layout" => 2
		];
	
		$this->load->view('main', $view_data);
	}

	public function Refresh_capcay()
	{
		$capcay_conf = array(
				'word'          => $this->capcay_words(),
				'img_path'      => './captcha/',
				'img_url'       => base_url().'publik/captcha_images/',
				'font_path'     => './path/to/fonts/texb.ttf',
				'img_width'     => '200',
				'img_height'    => 10,
				'word_length'   => 8,
				'font_size'     => 20,
			);
		$capcay = create_captcha($capcay_conf);

		$this->session->unset_userdata('captchaCode');
		$this->session->set_userdata('captchaCode', $capcay['word']);
		
		echo $capcay['image'];
	}

	public function capcay_words()
	{
		//Menampilkan huruf acak untuk dijadikan captcha
        $word = array_merge(range('0', '9'), range('A', 'Z'));
        $acak = shuffle($word);
		$str  = substr(implode($word), 0, 5);
		
		return $str;
	}
}
