<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_m');

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    function index()
    {
        $data['title'] = 'Halaman Laporan Penilaian';
        $data['role'] = $this->Laporan_m->tampil_laporan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/index', $data);
        $this->load->view('templates/footer');
    }
}
