<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('penduduk_m');
		$this->load->model('user_m');
		$this->load->model('pemohon_m');
	}

	public function index()
	{
		$post = $this->input->post();

		if ($post) {
			$this->form_validation->set_rules($this->validation_rule());
			$this->form_validation->set_rules('kode_captcha', 'Kode Captcha', 'required|callback_cek_captcha');
			$this->form_validation->set_error_delimiters('<div style="border: 1px solid: #999999; background-color: #ffff99;">', '</div>');

			if ($this->form_validation->run() === TRUE) {
				$dt_dukcapil = $this->penduduk_m->getPendudukByNik($post['nik']);
				$getmaxId = $this->pemohon_m->getMaxId();
				$maxId = ($getmaxId->c_id_pemohon == null) ? 0 + 1 : $getmaxId->c_id_pemohon + 1;
				$nip = date("ymd") . str_pad($maxId, 5, "0", STR_PAD_LEFT);

				$data_pemohon = [
					'id_pemohon' => $maxId,
					'nip' => $nip,
					'nama_pemohon' => $dt_dukcapil['nama_lengkap'],
					'nik' => $post['nik'],
					'email' => $post['email'],
					'id_jenis_identitas' => 1,
					'id_warga' => 1
				];

				$pass_option = ['cost' => 10];

				$data_user = [
					'username' => $nip,
					'password' => password_hash($post['password'], PASSWORD_DEFAULT, $pass_option),
					'jenis_user' => 13,
					'userid_detile' => $nip
				];

				$data_email = [
					'nip' => $nip,
					'email' => $post['email'],

				];

				$this->pemohon_m->addOrUpdate($data_pemohon);
				$this->user_m->addOrUpdateUsers($data_user);
				$this->kirim_email($data_email);

				$view_data = [
					"page_title" => "Konfirmasi Registrasi",
					"content" => "auth/success",
					"custom_js" => "auth/custom_js",
					"layout" => 2
				];
				$this->session->unset_userdata('captchaCode');
				return $this->load->view('main', $view_data);
			}
		}
		$cap = $this->generate_captcha();
		$this->session->set_userdata('captchaCode', $cap['word']);

		$view_data = [
			"page_title" => "Register",
			"content" => "auth/register",
			"captcha_img" => $cap['image'],
			"custom_js" => "auth/custom_js",
			"layout" => 2
		];

		$this->load->view('main', $view_data);
	}

	public function aktivasi()
	{
		$nip = $this->input->get('nip');
		$this->user_m->activateUser($nip);

		$view_data = [
			"page_title" => "Aktivasi Akun",
			"content" => "auth/aktivasi_success",
			"custom_js" => "",
			"layout" => 2
		];

		$this->load->view('main', $view_data);
	}

	public function refresh_capcay()
	{
		$cap = $this->generate_captcha();

		$this->session->unset_userdata('captchaCode');
		$this->session->set_userdata('captchaCode', $cap['word']);

		echo $cap['image'];
	}

	public function validation_rule()
	{
		return [
			[
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'required|exact_length[16]|numeric|callback_cek_nik',
				'errors' => [
					'required' => '%s tidak boleh kosong!',
					'exact_length' => '%s tidak benar, mohon cek kembali',
					'numeric' => '%s tidak benar, mohon cek kembali'
				]
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|callback_cek_email',
				'errors' => [
					'required' => '%s tidak boleh kosong!',
					'valid_email' => '%s yang anda masukan tidak valid'
				]
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required',
				'errors' => [
					'required' => '%s tidak boleh kosong!'
				]
			],
			[
				'field' => 'passConf',
				'label' => 'Password Confirm',
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => '%s harus di isi',
					'matches' => '%s tidak sama danegan Password'
				]
			]
		];
	}

	public function cek_captcha($input)
	{
		if ($input === $this->session->userdata('captchaCode')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('cek_captcha', '%s yang anda input salah!');
			return FALSE;
		}
	}

	public function cek_email($input)
	{
		$email_cek = $this->pemohon_m->findEmailPemohon($input)->row();

		if ($email_cek == null) {
			return TRUE;
		} else {
			$this->form_validation->set_message('cek_email', '%s sudah digunakan!');
			return FALSE;
		}
	}

	public function cek_nik($input)
	{
		$nik_cek = $this->pemohon_m->findNikPemohon($input)->row();

		if ($nik_cek == null) {
			return TRUE;
		} else {
			$this->form_validation->set_message('cek_nik', '%s sudah digunakan!');
			return FALSE;
		}
	}

	public function generate_captcha()
	{
		$val = [
			'img_path' => 'captcha/',
			'img_url' => base_url() . 'captcha/',
			'font_path' => FCPATH . 'publik/font/sf.ttf',
			'font_size' => 18,
			'img_width' => '150',
			'img_height' => 30,
			'word_length' => 6,
			'pool' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'expiration' => 7200
		];

		return create_captcha($val);
	}

	public function kirim_email($data)
	{
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_user' => 'simantap.ambon.go.id@gmail.com',
			'smtp_pass'   => 'simantap@12345',
			'smtp_crypto' => 'ssl',
			'smtp_port'   => 465,
			'crlf'    => "\r\n",
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->from('no-reply@simantap.ambon.go.id', 'SIMANTAP');
		$this->email->to($data['email']);
		$this->email->subject('[Simantap Online Kota Ambon - no-replay] Verifikasi pendaftaran');
		$this->email->message("Nomor Induk Perizinan anda adalah : " . $data['nip'] . "<br> ini di gunakan sebagai username untuk login di simantap online<br><br> Klik <strong><a href='" . base_url() . "register/aktivasi?nip=" . $data['nip'] . "' target='_blank' rel='noopener'>disini</a></strong> untuk aktivasi akun anda.");

		if ($this->email->send()) {
			echo 'Sukses! email berhasil dikirim.';
		} else {
			echo $this->email->print_debugger();
			echo 'Error! email tidak dapat dikirim.';
		}
	}
}
