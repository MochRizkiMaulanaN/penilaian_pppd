<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penilaian_m');
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
        $nip_pengguna = $this->session->userdata('nip_pengguna');
        $staff = $this->db->get_where('tb_staff', ['nip_staff' => $nip_pengguna])->row_array();

        $data['penilaian'] = $this->Penilaian_m->tampil_penilaian($staff['id_staff']);

        $data['title'] = 'Halaman Penilaian';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('penilaian/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_form($id_penilaian)
    {

        $data['title'] = 'Halaman Tambah Penilaian';
        $data['pegawai'] = $this->Penilaian_m->pegawai_idpenilaian($id_penilaian);
        $data['kriteria'] = $this->Kriteria_m->tampil_kriteria();
        $data['subkriteria'] = $this->db->get('tb_subkriteria')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('penilaian/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function ubah_form($id_penilaian)
    {

        $data['title'] = 'Halaman Ubah Penilaian';
        $data['pegawai'] = $this->Penilaian_m->pegawai_idpenilaian($id_penilaian);
        $data['kriteria'] = $this->Kriteria_m->tampil_kriteria();
        $data['subkriteria'] = $this->db->get('tb_subkriteria')->result_array();
    
        $data['detail_penilaian'] = $this->Penilaian_m->detail_penilaianID($id_penilaian);
        $data['level_nilai'] = $this->db->get('tb_level_nilai')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('penilaian/ubah', $data);
        $this->load->view('templates/footer');
    }



    public function tambah()
    {
        if ($this->input->is_ajax_request()) {
            $this->Penilaian_m->tambah_penilaian();
            $status = 1;
            echo json_encode($status);
        }
    }

    public function edit_penilaian()
    {
    }

    public function hitung()
    {
        if ($this->input->is_ajax_request()) {
            $this->Penilaian_m->hitung_nilai_vektors();
            $status = 1;
            echo json_encode($status);
        }
    }
}
