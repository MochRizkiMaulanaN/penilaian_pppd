<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekomendasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rekomendasi_m');
        $this->load->library('form_validation');

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    function index()
    {
        $data['title'] = 'Halaman Rekomendasi';
        $data['rekomendasi'] = $this->Rekomendasi_m->tampil();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('rekomendasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('kuota', 'kuota', 'required|trim', [
            'required' => 'Kuota tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $this->db->from('tb_laporan_penilaian');
            $this->db->group_by('periode_tahun');
            $data['tahun'] = $this->db->get()->result_array();

            $this->db->from('tb_laporan_penilaian lp');
            $this->db->join('tb_jabatan jb', 'lp.jabatan_id = jb.id_jabatan ');
            $this->db->group_by('jabatan_id');
            $data['jabatan'] = $this->db->get()->result_array();

            $data['title'] = 'Halaman Rekomendasi';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('rekomendasi/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Rekomendasi_m->tambah();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Rekomendasi pegawai berhasil ditambahkan
           </div>');
            redirect('Rekomendasi');
        }
    }
}
