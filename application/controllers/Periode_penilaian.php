<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode_penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Periode_m');

        // if (!$this->session->userdata('email')) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        //         Login Terlebih Dahulu!
        //        </div>');
        //     redirect('Autentikasi');
        // }
    }

    public function index()
    {

        // $data['perusahaan'] = $this->Perusahaan_model->tampil_perusahaan();
        // $data['hapus_perusahaan'] = $this->Periode_penilaian_model->tampil_groupby();
        // $data['periode'] = $this->Periode_penilaian_model->tampil_periode();
        $data['title'] = 'Halaman Periode Penilaian';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('periode_penilaian/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|is_unique[tb_penilaian_ka.id_perusahaan]', [
            'required' => 'Nama perusahaan tidak boleh kosong',
            'is_unique' => 'Sedang proses penilaian'
        ]);
        $this->form_validation->set_rules('tgl_periode', 'Tanggal Periode', 'required|trim', [
            'required' => 'Tanggal Periode tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $response = [
                'nama_perusahaan' => strip_tags(form_error('nama_perusahaan')),
                'tgl_periode' => strip_tags(form_error('tgl_periode')),
                'status' => 'gagal'
            ];
        } else {
            $this->Periode_penilaian_model->tambah_penilaian();
            $response['status'] = 'berhasil';
        }

        echo json_encode($response);
    }

    public function form_penilaian($nama_sequrity, $nama_perusahaan, $id_sequrity)
    {

        $this->db->from('tb_subkriteria sk');
        $this->db->join('tb_kriteria k', 'sk.kode_kriteria = k.kode_kriteria ');
        $subkriteria = $this->db->get()->result_array();

        $data = [
            'title' => 'Halaman Form Penilaian',
            'nama_sequrity' => rawurldecode($nama_sequrity),
            'nama_perusahaan' => rawurldecode($nama_perusahaan),
            'subkriteria' => $subkriteria
        ];


        $this->form_validation->set_rules('total_hadir', 'Total Hadir', 'required|trim', [
            'required' => 'Total hadir tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('total_tidak_hadir', 'Total Tidak Hadir', 'required|trim', [
            'required' => 'Total tidak hadir tidak boleh kosong'
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
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('penilaian_ka/form_penilaian', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Periode_penilaian_model->simpan_nilai($id_sequrity);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            <h6><i class="fas fa-check"></i><b> Berhasil!</b></h6>
            Sequrity dengan nama ' . rawurldecode($nama_sequrity) . ' dari perusahaan ' . rawurldecode($nama_perusahaan) . ' berhasil dinilai! </div>');
            redirect('Penilaian_ka');
        }
    }

    public function tampil_jumlah()
    {
        $perusahaan = $this->input->post('perusahaan');
        $query_jumlah = $this->db->get_where('tb_sequrity', ['id_perusahaan' => $perusahaan])->num_rows();

        echo json_encode($query_jumlah);
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
            $this->Periode_penilaian_model->simpan_nilai($id_sequrity);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            <h6><i class="fas fa-check"></i><b> Berhasil!</b></h6>
            Sequrity dengan nama ' . rawurldecode($nama_sequrity) . ' dari perusahaan ' . rawurldecode($nama_perusahaan) . ' berhasil diubah! </div>');
            redirect('Penilaian_ka');
        }
    }

    public function hasil_penilaian($id_sequrity, $nama_sequrity, $nama_perusahaan)
    {
        $this->Periode_penilaian_model->hitung_nilai($id_sequrity);
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
