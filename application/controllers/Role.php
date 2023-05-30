<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Role_m');

        // if (!$this->session->userdata('email')) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        //         Login Terlebih Dahulu!
        //        </div>');
        //     redirect('Autentikasi');
        // }
    }

    public function index()
    {
        $data['title'] = 'Halaman Role';
        $data['role'] = $this->Role_m->tampil_role();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('role/index', $data);
        $this->load->view('templates/footer');
    }

    public function tampil_role_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_role = $this->input->post('id_role');
            $data_role = $this->db->get_where('tb_user_role', ['id_role' => $id_role])->row_array();

            $data = [
                'status' => 1,
                'id_role' => $data_role['id_role'],
                'nama_role' => $data_role['nama_role']
            ];

            echo json_encode($data);
        }
    }

    public function tambah()
    {

        if ($this->input->is_ajax_request()) {
            $nama_role = $this->input->post('nama_role');
            $this->db->insert('tb_user_role', ['nama_role' => $nama_role]);

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function ubah()
    {

        if ($this->input->is_ajax_request()) {
            $id_role = $this->input->post('id_role');
            $nama_role = $this->input->post('nama_role');

            $this->db->update('tb_user_role', ['nama_role' => $nama_role], ['id_role' => $id_role]);

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_role = $this->input->post('id_role');
            $this->db->delete('tb_user_role', ['id_role' => $id_role]);

            $data['status'] = 1;
            echo json_encode($data);
        }
    }
}
