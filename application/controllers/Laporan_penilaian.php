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
        $data['laporan'] = $this->Laporan_m->tampil_laporan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/index', $data);
        $this->load->view('templates/footer');
    }

    public function tampil_penilaian_pegawai($id_pegawai)
    {
        $data['title'] = 'Halaman Laporan Penilaian';
        $data['laporan'] = $this->Laporan_m->tampil_laporan_pegawai($id_pegawai);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/laporan_penilaian_pegawai', $data);
        $this->load->view('templates/footer');
    }

    public function detail_penilaian_pegawai($pegawai_id, $periode_tahun)
    {
        $data['title'] = 'Halaman Detail Penilaian';
        $data['detail_penilaian_pegawai'] = $this->Laporan_m->detail_penilaian_pegawai($pegawai_id, $periode_tahun);
        $data['pegawai_id'] = $pegawai_id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/detail_laporan_penilaian_pegawai', $data);
        $this->load->view('templates/footer');
    }

    public function tampil_penilaian_staff($id_staff)
    {
        $data['title'] = 'Halaman Laporan Penilaian';
        $data['laporan'] = $this->Laporan_m->tampil_laporan_staff($id_staff);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/laporan_penilaian_staff', $data);
        $this->load->view('templates/footer');
    }

    public function detail_penilaian_staff($staff_id, $periode_tahun, $jabatan_id, $nama_jabatan)
    {
        $data['title'] = 'Halaman Detail Penilaian';
        $data['detail_penilaian_staff'] = $this->Laporan_m->detail_penilaian_staff($staff_id, $periode_tahun, $jabatan_id);
        $data['jabatan'] = $nama_jabatan;
        $data['staff_id'] = $staff_id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/detail_laporan_penilaian_staff', $data);
        $this->load->view('templates/footer');
    }

    //coba
    function tampil_nilai_staff_perPegawai($periode_tahun, $pegawai_id, $nama_jabatan, $nama_pegawai, $jabatan_id,$staff_id)
    {
        $data['title'] = 'Halaman Detail Penilaian';
        $data['periode_nilai'] = $this->Laporan_m->periode_nilai_staff_perPegawai($periode_tahun, $pegawai_id);
        $data['jabatan'] = $nama_jabatan;
        $data['jabatan_id'] = $jabatan_id;
        $data['tahun'] = $periode_tahun;
        $data['nama_pegawai'] = $nama_pegawai;
        $data['staff_id'] = $staff_id;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/periode_nilai_staff_perPegawai', $data);
        $this->load->view('templates/footer');
    }


    function detail_nilai($periode_tahun, $jabatan_id, $nama_jabatan)
    {
        $data['title'] = 'Halaman Detail Penilaian';
        $data['detail_nilai'] = $this->Laporan_m->detail_nilai($periode_tahun, $jabatan_id);
        $data['jabatan'] = $nama_jabatan;
        $data['jabatan_id'] = $jabatan_id;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/detail_nilai', $data);
        $this->load->view('templates/footer');
    }


    function tampil_nilai_periode($periode_tahun, $pegawai_id, $nama_jabatan, $nama_pegawai, $jabatan_id)
    {
        $data['title'] = 'Halaman Detail Penilaian';
        $data['periode_nilai'] = $this->Laporan_m->periode_nilai($periode_tahun, $pegawai_id);
        $data['jabatan'] = $nama_jabatan;
        $data['jabatan_id'] = $jabatan_id;
        $data['tahun'] = $periode_tahun;
        $data['nama_pegawai'] = $nama_pegawai;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_penilaian/periode_nilai', $data);
        $this->load->view('templates/footer');
    }
}
