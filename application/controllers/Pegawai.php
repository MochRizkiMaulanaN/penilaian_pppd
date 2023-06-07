<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_m');

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Pegawai';
        $data['pegawai'] = $this->Pegawai_m->tampil_pegawai();
        $data['jabatan'] = $this->db->get('tb_jabatan')->result_array();
        $data['staff'] = $this->db->get('tb_staff')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('pegawai/index', $data);
        $this->load->view('templates/footer');
    }


    public function tambah()
    {
        if ($this->input->is_ajax_request()) {
            $this->Pegawai_m->tambah_pegawai();
            $status = 1;
            echo json_encode($status);
        }
    }

    public function tampil_pegawai_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_pegawai = $this->input->post('id_pegawai');
            $pegawai = $this->Pegawai_m->tampil_pegawai_id($id_pegawai);

            $data = [
                'nama_jabatan' => $this->db->get('tb_jabatan')->result_array(),
                'nama_staff' => $this->db->get('tb_staff')->result_array(),
                'id_pegawai' => $pegawai['id_pegawai'],
                'id_jabatan' => $pegawai['jabatan_id'],
                'id_staff' => $pegawai['staff_id'],
                'nama_pegawai' => $pegawai['nama_pegawai'],
                'nip_pegawai' => $pegawai['nip_pegawai'],
                'alamat_pegawai' => $pegawai['alamat'],
                'no_telp' => $pegawai['no_telp'],
                'email_pegawai' => $pegawai['email'],
                'status' => 1
            ];
            echo json_encode($data);
        }
    }

    public function ubah()
    {
        if ($this->input->is_ajax_request()) {
            $this->Pegawai_m->ubah_pegawai();
            $status = 1;
            echo json_encode($status);
        }
    }

    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_pegawai = $this->input->post('id_pegawai');
            $this->db->delete('tb_pegawai', ['id_pegawai' => $id_pegawai]);

            $status = 1;
            echo json_encode($status);
        }
    }
}
