<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kriteria_m');

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Kriteria';
        $data['kriteria'] = $this->Kriteria_m->tampil_kriteria();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kriteria/index', $data);
        $this->load->view('templates/footer');
    }

    public function tampil_kriteria_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_kriteria = $this->input->post('id_kriteria');
            $data_kriteria = $this->db->get_where('tb_kriteria', ['id_kriteria' => $id_kriteria])->row_array();

            $data = [
                'status' => 1,
                'id_kriteria' => $data_kriteria['id_kriteria'],
                'nama_kriteria' => $data_kriteria['nama_kriteria'],
                'bobot_kriteria' => $data_kriteria['bobot_kriteria']
            ];

            echo json_encode($data);
        }
    }

    public function tambah()
    {

        if ($this->input->is_ajax_request()) {
            $this->Kriteria_m->tambah_kriteria();

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function ubah()
    {

        if ($this->input->is_ajax_request()) {
            $this->Kriteria_m->ubah_kriteria();

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_kriteria = $this->input->post('id_kriteria');
            $this->db->delete('tb_kriteria', ['id_kriteria' => $id_kriteria]);

            $data['status'] = 1;
            echo json_encode($data);
        }
    }
}
