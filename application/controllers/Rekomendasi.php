<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekomendasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rekomendasi_m');
        $this->load->library('form_validation');

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
        $data['rekomendasi'] = $this->Rekomendasi_m->tampil();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('rekomendasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('kuota', 'kuota', 'required|trim', [
            'required' => 'Kuota tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $this->db->from('tb_laporan_penilaian');
            $this->db->group_by('periode_tahun');
            $data['tahun'] = $this->db->get()->result_array();

            $this->db->from('tb_laporan_penilaian lp');
            $this->db->join('tb_jabatan jb', 'lp.jabatan_id = jb.id_jabatan ');
            $this->db->group_by('jabatan_id');
            $data['jabatan'] = $this->db->get()->result_array();

            $data['title'] = 'Halaman Rekomendasi';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('rekomendasi/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Rekomendasi_m->tambah();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Rekomendasi pegawai berhasil ditambahkan
           </div>');
            redirect('Rekomendasi');
        }
    }

    public function detail($jabatan_id, $periode_tahun)
    {
        $this->db->from('tb_rekomendasi r');
        $this->db->join('tb_pegawai pg', 'r.pegawai_id = pg.id_pegawai ');
        $this->db->where('periode_tahun', $periode_tahun);
        $this->db->where('r.jabatan_id', $jabatan_id);
        $data['rekomendasi'] = $this->db->get()->result_array();

        $data['title'] = 'Halaman Detail Rekomendasi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('rekomendasi/detail_rekomendasi', $data);
        $this->load->view('templates/footer');
    }

    public function perpanjangan()
    {
        if ($this->input->is_ajax_request()) {
            $nip = $this->input->post('nip');
            $pegawai_id = $this->input->post('id');

            $akhir_kontrak = $this->db->get('tb_pegawai', ['nip_pegawai' => $nip])->row_array();

            $AkhirKontrak_berikutnya = date('Y-m-d', strtotime('+1 year', strtotime($akhir_kontrak['akhir_kontrak'])));

            //update masa kontrak
            $this->db->update('tb_pegawai', ['akhir_kontrak' => $AkhirKontrak_berikutnya], ['nip_pegawai' => $nip]);
           

            //hapus pegawai di tabel rekomendasi
            $this->db->delete('tb_rekomendasi', ['pegawai_id' => $pegawai_id]);

            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function pemutusan()
    {
        if ($this->input->is_ajax_request()) {
            $nip = $this->input->post('nip');
            $pegawai_id = $this->input->post('id');

            //update status pegawai menjadi non aktif
            $this->db->update('tb_pegawai', ['status_pegawai' => 0], ['nip_pegawai' => $nip]);
           
            //hapus pegawai di tabel rekomendasi
            $this->db->delete('tb_rekomendasi', ['pegawai_id' => $pegawai_id]);

            $data['status'] = 1;
            echo json_encode($data);
        }
    }
}
