<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekomendasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rekomendasi_m');

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
        $data['role'] = $this->Rekomendasi_m->tampil_rekomendasi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('rekomendasi/index', $data);
        $this->load->view('templates/footer');
    }
}
