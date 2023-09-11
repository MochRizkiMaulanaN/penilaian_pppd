<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuota_pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KuotaPegawai_m');

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Kuota Pegawai';
        $data['kuota_pegawai'] = $this->KuotaPegawai_m->tampil_kuotaPegawai();
        $data['jabatan'] = $this->db->get('tb_jabatan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kuota_pegawai/index', $data);
        $this->load->view('templates/footer');
    }

    public function tampil_kuotaPegawai_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_kuotaPegawai = $this->input->post('id_kuotaPegawai');
            $kuota = $this->db->get_where('tb_kuota_pegawai', ['id_kuotaPegawai' => $id_kuotaPegawai])->row_array();

            $data = [
                'status' => 1,
                'id_kuotaPegawai' => $kuota['id_kuotaPegawai'],
                'jabatan_id' => $kuota['jabatan_id'],
                'jabatan' => $this->db->get('tb_jabatan')->result_array(),
                'jumlah_kuota' => $kuota['jumlah_kuota']
            ];

            echo json_encode($data);
        }
    }

    public function tambah()
    {

        if ($this->input->is_ajax_request()) {
            $this->KuotaPegawai_m->tambah_kuotaPegawai();

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function ubah()
    {

        if ($this->input->is_ajax_request()) {
            $this->KuotaPegawai_m->ubah_kuotaPegawai();

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_kuotaPegawai = $this->input->post('id_kuotaPegawai');
            $this->db->delete('tb_kuota_pegawai', ['id_kuotaPegawai' => $id_kuotaPegawai]);

            $data['status'] = 1;
            echo json_encode($data);
        }
    }
}
