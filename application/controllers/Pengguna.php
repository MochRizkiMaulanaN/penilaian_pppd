<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Role_m');
        $this->load->model('Pengguna_m');

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Pengguna';
        $data['pengguna'] = $this->Pengguna_m->tampil_pengguna();
        $data['role'] = $this->Role_m->tampil_role();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('pengguna/index', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $nip_pengguna = $this->session->userdata('nip_pengguna');

        $this->form_validation->set_rules('password_now', 'Password', 'required|trim', [
            'required' => 'password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password_new', 'Password', 'required|trim', [
            'required' => 'password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password_konf', 'Password', 'required|trim|matches[password_new]', [
            'required' => 'password tidak boleh kosong',
            'matches' => 'password harus sama'
        ]);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Profile';
            $data['pengguna'] = $this->Pengguna_m->tampil_pengguna_nip($nip_pengguna);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('pengguna/profile', $data);
            $this->load->view('templates/footer');
        } else {
            $nip = $this->input->post('nip');
            $password_now = $this->input->post('password_now');
            $password_new = $this->input->post('password_new');


            $cek_pengguna = $this->db->get_where('tb_pengguna', ['nip_pengguna' => $nip])->row_array();

            if ($cek_pengguna) {
                //cek password sekarang
                $cek_password_now = $this->db->get_where('tb_pengguna', ['password' => $password_now])->row_array();

                if ($cek_password_now) {
                    $data = [
                        'password' => $password_new
                    ];

                    $this->db->update('tb_pengguna', $data, ['nip_pengguna' => $nip]);

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Password berhasil diubah.
              </div>');
                    redirect('Pengguna/profile');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
               Password sekarang salah.
              </div>');
                    redirect('Pengguna/profile');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
               Pengguna tidak terdaftar.
              </div>');
                redirect('Pengguna/profile');
            }
        }
    }

    public function tambah()
    {
        if ($this->input->is_ajax_request()) {
            $this->Pengguna_m->tambah_pengguna();
            $status = 1;
            echo json_encode($status);
        }
    }


    public function tampil_pengguna_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_pengguna = $this->input->post('id_pengguna');
            $pengguna = $this->Pengguna_m->tampil_pengguna_id($id_pengguna);

            $data = [
                'role' => $this->Role_m->tampil_role(),
                'id_pengguna' => $pengguna['id_pengguna'],
                'nama_pengguna' => $pengguna['nama_pengguna'],
                'nip_pengguna' => $pengguna['nip_pengguna'],
                'email_pengguna' => $pengguna['email'],
                'role_pengguna' => $pengguna['id_role'],
                'aktif_pengguna' => $pengguna['aktif'],
                'status' => 1
            ];
            echo json_encode($data);
        }
    }

    public function tampil_staff_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_role = $this->input->post('id_role');
            if ($id_role == 3) {
                $data = [
                    'staff' => $this->db->get('tb_staff')->result_array(),
                    'id_role' => $id_role
                ];
            } elseif ($id_role == 4) {
                $data = [
                    'pegawai' => $this->db->get('tb_pegawai')->result_array(),
                    'id_role' => $id_role
                ];
            } else {
                $data['id_role'] = $id_role;
            }


            echo json_encode($data);
        }
    }

    public function ubah()
    {
        if ($this->input->is_ajax_request()) {
            $this->Pengguna_m->ubah_pengguna();
            $status = 1;
            echo json_encode($status);
        }
    }

    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_pengguna = $this->input->post('id_pengguna');
            $this->db->delete('tb_pengguna', ['id_pengguna' => $id_pengguna]);

            $status = 1;
            echo json_encode($status);
        }
    }

    public function ubah_password()
    {

        $this->form_validation->set_rules('password_now', 'Password', 'required|trim', [
            'required' => 'password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password_new', 'Password', 'required|trim|matches[password_konf]', [
            'required' => 'password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password_konf', 'Password', 'required|trim|matches[password_new]', [
            'required' => 'password tidak boleh kosong',
            'matches' => 'password harus sama'
        ]);


        if ($this->form_validation->run() == false) {
            $nip_pengguna = $this->session->userdata('nip_pengguna');

            $data['title'] = 'Halaman Profile';
            $data['pengguna'] = $this->Pengguna_m->tampil_pengguna_nip($nip_pengguna);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('pengguna/profile', $data);
            $this->load->view('templates/footer');
        } else {
            $nip = $this->input->post('nip');
            $password_now = $this->input->post('password_now');
            $password_new = $this->input->post('password_new');


            $cek_pengguna = $this->db->get_where('tb_pengguna', ['nip_pengguna' => $nip])->row_array();

            if ($cek_pengguna) {
                //cek password sekarang
                $cek_password_now = $this->db->get_where('tb_pengguna', ['password' => $password_now])->row_array();

                if ($cek_password_now) {
                    $data = [
                        'password' => $password_new
                    ];

                    $this->db->update('tb_pengguna', $data, ['nip_pengguna' => $nip]);
                }
            }


            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Password berhasil diubah.
              </div>');
            redirect('Pengguna/profile');
        }
    }
}
