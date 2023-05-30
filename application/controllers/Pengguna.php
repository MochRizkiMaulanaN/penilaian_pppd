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

        // if (!$this->session->userdata('email')) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        //         Login Terlebih Dahulu!
        //        </div>');
        //     redirect('Autentikasi');
        // }
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
}
