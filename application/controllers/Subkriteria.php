<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Subkriteria_m');

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    public function index($id_kriteria, $nama_kriteria)
    {

        $data = [
            'nama_kriteria' => $nama_kriteria,
            'id_kriteria' => $id_kriteria,
        ];
        $data['subkriteria'] = $this->Subkriteria_m->tampil_subkriteria($id_kriteria);
        $data['title'] = 'Halaman Subkriteria';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('subkriteria/index', $data);
        $this->load->view('templates/footer');
    }

    public function tampil_subkriteria_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_subkriteria = $this->input->post('id_subkriteria');
            $data_subkriteria = $this->db->get_where('tb_subkriteria', ['id_subkriteria' => $id_subkriteria])->row_array();

            $data = [
                'status' => 1,
                'id_subkriteria' => $data_subkriteria['id_subkriteria'],
                'nama_subkriteria' => $data_subkriteria['nama_subkriteria'],
                'passing_grade' => $data_subkriteria['passing_grade']
            ];

            echo json_encode($data);
        }
    }

    public function tambah()
    {

        if ($this->input->is_ajax_request()) {
            $this->Subkriteria_m->tambah_subkriteria();

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function ubah()
    {

        if ($this->input->is_ajax_request()) {
            $this->Subkriteria_m->ubah_subkriteria();

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_subkriteria = $this->input->post('id_subkriteria');
            $this->db->delete('tb_subkriteria', ['id_subkriteria' => $id_subkriteria]);

            $data['status'] = 1;
            echo json_encode($data);
        }
    }
}
