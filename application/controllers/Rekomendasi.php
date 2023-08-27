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
            $tahun = $this->input->post('tahun');
            $jabatan = $this->input->post('jabatan');
            $kuota = $this->input->post('kuota');

            //jumlah pegawai rekemndasi
            $query = $this->db->query("SELECT * FROM tb_laporan_penilaian WHERE jabatan_id = $jabatan AND periode_tahun = $tahun");
            $jumlah = $query->num_rows();

            //ambil nama jabatan
            $query_jabatan = $this->db->get_where('tb_jabatan', ['id_jabatan' => $jabatan])->row_array();
            $nama_jabatan = $query_jabatan['nama_jabatan'];


            if ($kuota > $jumlah) {
                // echo $nama_jabatan;
                // die;
                $url = base_url('Rekomendasi/tambah');
                echo "
                <script>
                alert('Maaf, kuota pegawai " . $nama_jabatan . " maksimal sebanyak " . $jumlah . " orang');
                window.location.href='" . $url . "';
                </script>
                ";
            } else {
                $this->Rekomendasi_m->tambah($tahun, $jabatan, $kuota);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Rekomendasi pegawai berhasil ditambahkan
           </div>');
                redirect('Rekomendasi');
            }
        }
    }

    public function keputusan()
    {
        $jabatan_id = $_POST['jabatan_id'];
        $periode_tahun = $_POST['periode_tahun'];
        foreach ($_POST['id_pegawai'] as $key => $id_pegawai) {
            $keputusan = (!empty($_POST['keputusan' . $id_pegawai])) ? $_POST['keputusan' . $id_pegawai] : null;

            // $keputusan = $_POST['keputusan' . $id_pegawai];

            // var_dump($id_pegawai, $keputusan);
            // echo '<br>';
            // if (empty($keputusan)) {
            //     echo "gagal";
            //     var_dump($keputusan);
            //     die;
            // $url = base_url('Rekomendasi/detail/' . $jabatan_id . '/' . $periode_tahun);
            // echo "
            //     <script>
            //     alert('Pilih keputusan untuk semua pegawai');
            //     window.location.href='" . $url . "';
            //     </script>
            //     ";
            //     exit;
            //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            //     Pilih keputusan untuk semua pegawai
            //    </div>');

            //    redirect('Rekomendasi/detail/' . $jabatan_id . '/' . $periode_tahun);
            //} else {

            if ($keputusan == '1') {
                $akhir_kontrak = $this->db->get_where('tb_pegawai', ['id_pegawai' => $id_pegawai])->row_array();

                $AkhirKontrak_berikutnya = date('Y-m-d', strtotime('+1 year', strtotime($akhir_kontrak['akhir_kontrak'])));


                //update masa kontrak
                $this->db->update('tb_pegawai', ['akhir_kontrak' => $AkhirKontrak_berikutnya], ['id_pegawai' => $id_pegawai]);


                //hapus pegawai di tabel rekomendasi
                $this->db->delete('tb_rekomendasi', ['pegawai_id' => $id_pegawai]);

                //hapus pegawai di tabel laporan
                $this->db->where('pegawai_id', $id_pegawai);
                $this->db->where('periode_tahun', $periode_tahun);
                $this->db->delete('tb_laporan_penilaian');
            } else {

                //update status pegawai menjadi non aktif
                $this->db->update('tb_pegawai', ['status_pegawai' => 0], ['id_pegawai' => $id_pegawai]);

                //hapus pegawai di tabel rekomendasi
                $this->db->delete('tb_rekomendasi', ['pegawai_id' => $id_pegawai]);

                //hapus pegawai di tabel laporan
                $this->db->where('pegawai_id', $id_pegawai);
                $this->db->where('periode_tahun', $periode_tahun);
                $this->db->delete('tb_laporan_penilaian');
            }

            // }
        }


        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Keputusan pegawai berhasil ditambahkan
           </div>');
        redirect('Rekomendasi');
    }

    public function detail($jabatan_id, $periode_tahun)
    {
        $this->db->from('tb_rekomendasi r');
        $this->db->join('tb_pegawai pg', 'r.pegawai_id = pg.id_pegawai ');
        $this->db->where('periode_tahun', $periode_tahun);
        $this->db->where('r.jabatan_id', $jabatan_id);
        $data['rekomendasi'] = $this->db->get()->result_array();

        $data['jabatan_id'] = $jabatan_id;
        $data['periode_tahun'] = $periode_tahun;

        $data['title'] = 'Halaman Detail Rekomendasi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('rekomendasi/detail_rekomendasi', $data);
        $this->load->view('templates/footer');
    }

    public function hapus()
    {
        if ($this->input->is_ajax_request()) {
            $jabatan_id = $this->input->post('jabatan_id');
            $tahun = $this->input->post('tahun');

            //hapus data rekomendasi berdasarkan jabatan_id dan tahun
            $this->db->where('jabatan_id', $jabatan_id);
            $this->db->where('periode_tahun', $tahun);
            $this->db->delete('tb_Rekomendasi');

            $status = 1;
            echo json_encode($status);
        }
    }

    public function tampil_kuota_pegawai()
    {
        if ($this->input->is_ajax_request()) {
            $id_jabatan = $this->input->post('id_jabatan');

            $kuota = $this->db->get_where('tb_kuota_pegawai', ['jabatan_id' => $id_jabatan])->row_array();

            $data['kuota'] = $kuota['jumlah_kuota'];

            echo json_encode($data);
        }
    }
}
