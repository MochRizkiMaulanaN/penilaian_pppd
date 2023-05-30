<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required' => 'Email tidak boleh kosong',
			'valid_email' => 'Email tidak valid'
		]);
		$this->form_validation->set_rules('katasandi', 'Kata sandi', 'required|trim', [
			'required' => 'kata sandi tidak boleh kosong'
		]);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Halaman Login';
			$this->load->view('templates/header_login', $data);
			$this->load->view('autentikasi/index');
			$this->load->view('templates/footer_login');
		} else {
			$this->masuk();
		}
	}

	public function registrasi()
	{
		$data['title'] = 'Halaman Registrasi';
		$this->load->view('templates/header_login', $data);
		$this->load->view('autentikasi/registrasi');
		$this->load->view('templates/footer_login');
	}

	public function masuk()
	{
		$email = $this->input->post('email');
		$katasandi = $this->input->post('katasandi');

		$this->db->select('*, pg.email');
		$this->db->from('tb_pengguna pg');
		$this->db->join('tb_jabatan jb', 'pg.id_jabatan = jb.id_jabatan');
		$this->db->join('tb_perusahaan ph', 'pg.id_perusahaan = ph.id_perusahaan');
		$this->db->where('pg.email', $email);
		$pengguna = $this->db->get()->row_array();


		if ($pengguna) {

			//cek katasandi
			if ($katasandi == $pengguna['katasandi']) {
				$data = [
					'id_pengguna' => $pengguna['id_pengguna'],
					'email' => $pengguna['email'],
					'nama_pengguna' => $pengguna['nama_pengguna'],
					'jabatan' => $pengguna['nama_jabatan'],
					'perusahaan' => $pengguna['nama_perusahaan']
				];
				$this->session->set_userdata($data);

				if ($pengguna['nama_jabatan'] == 'Admin' || $pengguna['nama_jabatan'] == 'Koordinator Area' || $pengguna['nama_jabatan'] == 'Manajer Outsource') {
					redirect('Halaman_utama');
				} else {
					redirect('Penilaian_mo');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Email dengan kata sandi tidak sesuai
               </div>');
				redirect('Autentikasi');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
               Email dengan kata sandi tidak sesuai
              </div>');
			redirect('Autentikasi');
		}
	}

	private function sendmail($email, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://mail.tjoutsource.com',
			'smtp_user' => 'trengginasjaya@tjoutsource.com',
			'smtp_pass' => 'trengginasjaya',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);

		$this->email->from('trengginasjaya@tjoutsource.com', 'PT Trengginas Jaya');
		$this->email->to($email);

		if ($type == 'lupakatasandi') {
			$this->email->subject('Reset Katasandi');
			$this->email->message('Klik link ini untuk mengubah katasandi anda : <a href="' . base_url() . 'Autentikasi/reset_katasandi?email=' . $email . '" >Reset Katasandi</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			$this->email->print_debugger();
			die;
		}
	}

	public function lupa_katasandi()
	{

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required' => 'Email tidak boleh kosong',
			'valid_email' => 'Masukkan email yang valid'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Lupa Katasandi';
			$this->load->view('templates/header_login', $data);
			$this->load->view('autentikasi/lupa_katasandi');
			$this->load->view('templates/footer_login');
		} else {
			$email = $this->input->post('email', true);
			$user = $this->db->get_where('tb_pengguna', ['email' => $email])->row_array();

			if ($user) {
				$this->sendmail($email, 'lupakatasandi');
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Silahkan cek email anda untuk mereset katasandi!
              </div>');
				redirect('Autentikasi');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
               Email yang anda masukkan tidak terdaftar!
              </div>');
				redirect('Autentikasi/lupa_katasandi');
			}
		}
	}

	public function reset_katasandi()
	{
		$email = $this->input->get('email');

		$user = $this->db->get_where('tb_pengguna', ['email' => $email])->row_array();

		if ($user) {
			$this->session->set_userdata('reset_email', $email);
			$this->ubah_katasandi();
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
               Reset katasandi gagal! Email salah.
              </div>');
			redirect('Autentikasi');
		}
	}

	public function ubah_katasandi()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('Autentikasi');
		}

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
			'required' => 'Katasandi tidak boleh kosong',
			'matches' => 'Katasandi harus sama'
		]);
		$this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]', [
			'required' => 'Katasandi tidak boleh kosong',
			'matches' => 'Katasandi harus sama'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Ubah Katasandi';
			$this->load->view('templates/header_login', $data);
			$this->load->view('autentikasi/ubah_katasandi');
			$this->load->view('templates/footer_login');
		} else {
			$email = $this->session->userdata('reset_email');
			$katasandi = $this->input->post('password1');

			$this->db->update('tb_pengguna', ['katasandi' => $katasandi], ['email' => $email]);

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Katasandi berhasil diubah! Silahkan Login.
              </div>');
			redirect('Autentikasi');
		}
	}

	public function keluar()
	{
		$this->session->unset_userdata('id_pengguna');
		$this->session->unset_userdata('nama_pengguna');
		$this->session->unset_userdata('jabatan');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('perusahaan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Berhasil keluar aplikasi</div>');
		redirect('Autentikasi');
	}
}
