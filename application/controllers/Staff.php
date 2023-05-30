<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Staff_m');
        // if (!$this->session->userdata('email')) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        //         Login Terlebih Dahulu!
        //        </div>');
        //     redirect('Autentikasi');
        // }
    }

    public function index()
    {
        $data['title'] = 'Halaman Staff';
        $data['staff'] = $this->Staff_m->tampil_staff();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('staff/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->is_ajax_request()) {
            $this->Staff_m->tambah_staff();
            $status = 1;
            echo json_encode($status);
        }
    }

    public function tampil_staff_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_staff = $this->input->post('id_staff');
            $staff = $this->Staff_m->tampil_staff_id($id_staff);

            $data = [
                'id_staff' => $staff['id_staff'],
                'nama_penilai' => $staff['nama_penilai'],
                'nama_staff' => $staff['nama_staff'],
                'nip_staff' => $staff['nip_staff'],
                'status' => 1
            ];
            echo json_encode($data);
        }
    }

    public function ubah()
    {
        if ($this->input->is_ajax_request()) {
            $this->Staff_m->ubah_staff();
            $status = 1;
            echo json_encode($status);
        }
    }


    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_staff = $this->input->post('id_staff');
            $this->db->delete('tb_staff', ['id_staff' => $id_staff]);

            $status = 1;
            echo json_encode($status);
        }
    }
}
