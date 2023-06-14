<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode_penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Periode_m');
        $this->load->model('Staff_m');

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    public function index()
    {

        $data['staff'] = $this->Staff_m->tampil_staff();
        $data['periode'] = $this->Periode_m->tampil_periode();
        // $data['hapus_perusahaan'] = $this->Periode_penilaian_model->tampil_groupby();
        // $data['periode'] = $this->Periode_penilaian_model->tampil_periode();
        $data['title'] = 'Halaman Periode Penilaian';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('periode_penilaian/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail_periode($id_periode)
    {
        $data['staff'] = $this->Staff_m->tampil_staff();
        $data['detail_periode'] = $this->Periode_m->tampil_detail_periode($id_periode);
        // $data['hapus_perusahaan'] = $this->Periode_penilaian_model->tampil_groupby();
        // $data['periode'] = $this->Periode_penilaian_model->tampil_periode();
        $data['title'] = 'Halaman Detail Periode Penilaian';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('periode_penilaian/detail', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->is_ajax_request()) {
            $tgl_penilaian = $this->input->post('tgl_penilaian');
            // $nama_staff = $this->input->post('nama_staff');

            $cek = $this->Periode_m->cek_statusPeriode($tgl_penilaian);
            if ($cek == true) {
                $status = 0;
            } else {
                $status = 1;
            }

            echo json_encode($status);
        }
    }

    public function tambah_detail_periode()
    {
        if ($this->input->is_ajax_request()) {
            $tgl_penilaian = $this->input->post('tgl_penilaian');
            $id_periode = $this->input->post('id_periode');

            $this->Periode_m->tambah_detail_periode($tgl_penilaian, $id_periode);

            //tambah data ke tabel penilaian
            $this->Periode_m->tambah_penilaian($id_periode);

            $status = 1;
            echo json_encode($status);
        }
    }

    // public function tambah_penilaian()
    // {
    //     if ($this->input->is_ajax_request()) {
    //         $this->Periode_m->tambah_penilaian();
    //         $status = 1;
    //         echo json_encode($status);
    //     }
    // }

    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_periode = $this->input->post('id_periode');
            $this->db->delete('tb_periode_penilaian', ['id_periode' => $id_periode]);

            //hapus data detail periode penilaian berdasarkan id periode
            $this->db->delete('tb_detail_periode', ['periode_id' => $id_periode]);

            //hapus data penilaian berdasarkan id periode
            $this->db->delete('tb_penilaian', ['periode_id' => $id_periode]);

            $status = 1;
            echo json_encode($status);
        }
    }
}
