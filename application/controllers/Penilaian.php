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
        $staff= $this->db->get_where('tb_staff',['nip_staff' => $nip_pengguna])->row_array();

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

        $data['detail_penilaian'] = $this->db->get_where('tb_detail_penilaian',['penilaian_id' => $id_penilaian])->result_array();
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

    public function edit_penilaian($nama_sequrity, $nama_perusahaan, $id_sequrity)
    {

        // var_dump($data['penilaian_ka']); die;

        $this->db->from('tb_subkriteria sk');
        $this->db->join('tb_kriteria k', 'sk.kode_kriteria = k.kode_kriteria ');
        $subkriteria = $this->db->get()->result_array();

        $data = [
            'title' => 'Halaman Form Penilaian',
            'nama_sequrity' => rawurldecode($nama_sequrity),
            'nama_perusahaan' => rawurldecode($nama_perusahaan),
            'subkriteria' => $subkriteria
        ];


        $this->form_validation->set_rules('kehadiran', 'NIlai', 'required|trim', [
            'required' => 'Nilai kehadiran tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('lari', 'NIlai', 'required|trim', [
            'required' => 'Nilai lari tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('pull_up', 'NIlai', 'required|trim', [
            'required' => 'Nilai pull up tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('sit_up', 'NIlai', 'required|trim', [
            'required' => 'Nilai sit up tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('push_up', 'NIlai', 'required|trim', [
            'required' => 'Nilai push up tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('shuttle_run', 'NIlai', 'required|trim', [
            'required' => 'Nilai shuttle run tidak boleh kosong'
        ]);


        if ($this->form_validation->run() == false) {
            $data['penilaian_ka'] = $this->db->get_where('tb_penilaian_ka', ['id_sequrity' => $id_sequrity])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('penilaian_ka/edit_penilaian', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Penilaian_ka_model->simpan_nilai($id_sequrity);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            <h6><i class="fas fa-check"></i><b> Berhasil!</b></h6>
            Sequrity dengan nama ' . rawurldecode($nama_sequrity) . ' dari perusahaan ' . rawurldecode($nama_perusahaan) . ' berhasil diubah! </div>');
            redirect('Penilaian_ka');
        }
    }

    public function hasil_penilaian($id_sequrity, $nama_sequrity, $nama_perusahaan)
    {
        $this->Penilaian_ka_model->hitung_nilai($id_sequrity);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            <h6><i class="fas fa-check"></i><b> Berhasil!</b></h6>
            Sequrity dengan nama ' . rawurldecode($nama_sequrity) . ' dari perusahaan ' . rawurldecode($nama_perusahaan) . ' selesai dinilai! </div>');
        redirect('Penilaian_ka');
    }

    public function hapus()
    {

        $this->form_validation->set_rules('perusahaan', 'NIlai', 'required|trim', [
            'required' => 'Nama perusahaan tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            <h6><i class="fas fa-ban"></i><b> Stop!</b></h6>
            Nama perusahaan tidak boleh kosong! </div>');
            redirect('Penilaian_ka');
        } else {
            $id_perusahaan = $this->input->post('perusahaan');
            $this->db->delete('tb_penilaian_ka', ['id_perusahaan' => $id_perusahaan]);
            $this->db->delete('tb_hasil_penilaian', ['id_perusahaan' => $id_perusahaan]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            <h6><i class="fas fa-check"></i><b> Berhasil!</b></h6>
            Data penilaian berhasil dihapus! </div>');
            redirect('Penilaian_ka');
        }
    }
}
