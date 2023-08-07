<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('nip_pengguna')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu!
               </div>');
            redirect('Autentikasi');
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Jabatan';

        $this->db->from('tb_jabatan');
        $this->db->order_by('nama_jabatan','asc');
        $data['jabatan'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('jabatan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->is_ajax_request()) {
            $nama_jabatan = $this->input->post('nama_jabatan');
            $this->db->insert('tb_jabatan', ['nama_jabatan' => $nama_jabatan]);
            $status = 1;
            echo json_encode($status);
        }
    }

    public function tampil_jabatan_id()
    {
        if ($this->input->is_ajax_request()) {
            $id_jabatan = $this->input->post('id_jabatan');
            $jabatan = $this->db->get_where('tb_jabatan',['id_jabatan'=>$id_jabatan])->row_array();

            $data = [
                'id_jabatan' => $jabatan['id_jabatan'],
                'nama_jabatan' => $jabatan['nama_jabatan'],
                'status' => 1
            ];
            echo json_encode($data);
        }
    }

    public function ubah()
    {
        if ($this->input->is_ajax_request()) {
            $nama_jabatan = $this->input->post('nama_jabatan');
            $id_jabatan = $this->input->post('id_jabatan');
            $this->db->update('tb_jabatan', ['nama_jabatan' => $nama_jabatan],['id_jabatan'=>$id_jabatan]);
            $status = 1;
            echo json_encode($status);
        }
    }


    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $id_jabatan = $this->input->post('id_jabatan');
            $this->db->delete('tb_jabatan', ['id_jabatan' => $id_jabatan]);

            $status = 1;
            echo json_encode($status);
        }
    }
}
