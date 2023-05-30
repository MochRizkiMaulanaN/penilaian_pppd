<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        // if (!$this->session->userdata('email')) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        //         Login Terlebih Dahulu!
        //        </div>');
        //     redirect('Autentikasi');
        // }
    }

    public function index()
    {
        $data['title'] = 'Halaman Dashboard';

        $this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/index');
		$this->load->view('templates/footer');
    }
}
