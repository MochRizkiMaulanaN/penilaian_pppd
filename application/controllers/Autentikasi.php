<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pengguna_m');
	}

	public function index()
	{
		$this->form_validation->set_rules('nip_pengguna', 'NIP', 'required|trim|exact_length[8]', [
			'required' => 'NIP tidak boleh kosong',
			'exact_length' => 'NIP harus 8 digit angka'
		]);
		$this->form_validation->set_rules('password', 'Passoword', 'required|trim', [
			'required' => 'Password tidak boleh kosong'
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
		$this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim', [
			'required' => 'Nama tidak boleh kosong'
		]);
		$this->form_validation->set_rules('nip_pengguna', 'NIP', 'required|trim|exact_length[8]|is_unique[tb_pengguna.nip_pengguna]', [
			'required' => 'NIP tidak boleh kosong',
			'exact_length' => 'NIP harus 8 digit angka',
			'is_unique' => 'NIP sudah ada'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required' => 'Email tidak boleh kosong',
			'valid_email' => 'Email tidak valid'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required' => 'Password tidak boleh kosong'
		]);

		$this->form_validation->set_rules('konf_password', 'Konfirmasi Password', 'required|trim|matches[password]', [
			'required' => 'Konfirmasi Password tidak boleh kosong',
			'matches' => 'Password tidak sama',
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Halaman Registrasi';
			$this->load->view('templates/header_login', $data);
			$this->load->view('autentikasi/registrasi');
			$this->load->view('templates/footer_login');
		} else {
			$this->Pengguna_m->tambah_registrasi();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Akun telah dibuat, silahkan login!
               </div>');
			redirect('Autentikasi');
		}
	}

	public function masuk()
	{
		$nip_pengguna = $this->input->post('nip_pengguna');
		$password = $this->input->post('password');

		$this->db->select('*');
		$this->db->from('tb_pengguna pg');
		$this->db->join('tb_user_role ur', 'pg.role_id = ur.id_role');
		$this->db->where('nip_pengguna', $nip_pengguna);
		$pengguna = $this->db->get()->row_array();

		// var_dump($pengguna); die;


		if ($pengguna) {
			//cek password
			if ($password == $pengguna['password']) {
				// var_dump('password benar'); die;

				//cek status aktif
				if ($pengguna['aktif'] == '1') {
					$data = [
						'nama_pengguna' => $pengguna['nama_pengguna'],
						'nip_pengguna' => $pengguna['nip_pengguna'],
						'role_id' => $pengguna['role_id'],
						'nama_role' => $pengguna['nama_role'],
					];
					$this->session->set_userdata($data);
					redirect('Dashboard');
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Maaf akun anda belum aktif!
               </div>');
					redirect('Autentikasi');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                NIP dan Password tidak sesuai!
               </div>');
				redirect('Autentikasi');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
               Silahkan registrasi terlebih dahulu!
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
		$this->session->unset_userdata('ni_pengguna');
		$this->session->unset_userdata('nama_pengguna');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('nama_role');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Berhasil keluar aplikasi</div>');
		redirect('Autentikasi');
	}
}
