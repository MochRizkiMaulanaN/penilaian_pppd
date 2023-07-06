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
        // $data['periode'] = $this->Periode_penilaian_model->tampil_periode();
        $data['title'] = 'Halaman Detail Periode Penilaian';
        $data['id_periode'] = $id_periode;

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

    public function hitung_nilaiAkhir($id_periode)
    {
        // if ($this->input->is_ajax_request()) {
        //     $id_periode = $this->input->post('id_periode');
        $this->Periode_m->hitung_nilai_akhir($id_periode);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Penilaian pegawai berhasil dihitung
              </div>');
        redirect('Periode_penilaian');
        //     $status = 1;
        //     echo json_encode($status);
        // }
    }

    public function detail_penilaian_staff($id_periode, $id_staff)
    {
        $this->db->select('*');
        $this->db->from('tb_penilaian pn');
        $this->db->join('tb_pegawai pg', 'pn.pegawai_id = pg.id_pegawai');
        $this->db->join('tb_jabatan jb', 'pg.jabatan_id = jb.id_jabatan');
        $this->db->where('pn.staff_id', $id_staff);
        $this->db->where('periode_id', $id_periode);
        $data['detail_penilaian'] = $this->db->get()->result_array();
        // $data['periode'] = $this->Periode_penilaian_model->tampil_periode();
        $data['title'] = 'Halaman Detail Penilaian Staff';
        $data['id_periode'] = $id_periode;
        $data['id_staff'] = $id_staff;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('periode_penilaian/detail_penilaian_staff', $data);
        $this->load->view('templates/footer');
    }

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
