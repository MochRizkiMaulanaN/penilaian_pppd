<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode_m extends CI_Model
{
    public function tampil_penilaian()
    {
        $this->db->select('*, p.id_sequrity , p.id_perusahaan');
        $this->db->from('tb_penilaian_ka p');
        $this->db->join('tb_perusahaan pr', 'p.id_perusahaan = pr.id_perusahaan');
        $this->db->join('tb_sequrity s', 'p.id_sequrity = s.id_sequrity');
        return $this->db->get()->result_array();
    }
    public function tampil_groupby()
    {
        $this->db->select('*');
        $this->db->from('tb_penilaian_ka p');
        $this->db->join('tb_perusahaan pr', 'p.id_perusahaan = pr.id_perusahaan');
        $this->db->group_by('p.id_perusahaan');
        return $this->db->get()->result_array();
    }


    public function tambah_penilaian()
    {
        $nama_perusahaan = $this->input->post('nama_perusahaan', true);
        $tanggal_penilaian = $this->input->post('tanggal_penilaian', true);


        $data_sequrity = $this->db->get_where('tb_sequrity', ['id_perusahaan' => $nama_perusahaan])->result_array();

        $data_ka = [];
        $hasil_penilaian = [];
        foreach ($data_sequrity as $key => $value) {
            $sequrity_ka = [
                'id_perusahaan' => $value['id_perusahaan'],
                'id_sequrity' => $value['id_sequrity'],
                'tanggal_penilaian' => $tanggal_penilaian,
                'status' => 'Belum Dinilai',
                'kehadiran' => 0,
                'lari' => 0,
                'pull_up' => 0,
                'sit_up' => 0,
                'push_up' => 0,
                'shuttle_run' => 0
            ];

            array_push($data_ka, $sequrity_ka);

            $hasil = [
                'id_perusahaan' => $value['id_perusahaan'],
                'id_sequrity' => $value['id_sequrity'],
                'tanggal_penilaian' => $tanggal_penilaian,
                'kehadiran' => 0,
                'lari' => 0,
                'pull_up' => 0,
                'sit_up' => 0,
                'push_up' => 0,
                'shuttle_run' => 0,
                'kedisiplinan' => 0,
                'kesigapan' => 0,
                'penampilan' => 0,
                'penguasaan_pekerjaan' => 0,
                'komunikasi' => 0,
                'responsif' => 0,
                'keramahan' => 0
            ];
            array_push($hasil_penilaian, $hasil);
        }

        $this->db->insert_batch('tb_penilaian_ka', $data_ka);
        $this->db->insert_batch('tb_hasil_penilaian', $hasil_penilaian);
    }

    public function simpan_nilai($id_sequrity)
    {
        $total_hadir = $this->input->post('total_hadir', true);
        $total_tidak_hadir = $this->input->post('total_tidak_hadir', true);

        $kehadiran = 100 - (($total_tidak_hadir / $total_hadir) * 100);
        $lari = $this->input->post('lari', true);
        $pull_up = $this->input->post('pull_up', true);
        $sit_up = $this->input->post('sit_up', true);
        $push_up = $this->input->post('push_up', true);
        $shuttle_run = $this->input->post('shuttle_run', true);

        $data = [
            'status' => 'Sudah Dinilai',
            'kehadiran' => $kehadiran,
            'lari' => $lari,
            'pull_up' => $pull_up,
            'sit_up' => $sit_up,
            'push_up' => $push_up,
            'shuttle_run' => $shuttle_run
        ];

        $this->db->update('tb_penilaian_ka', $data, ['id_sequrity' => $id_sequrity]);
    }

    public function hitung_nilai($id_sequrity)
    {
        $nilai = $this->db->get_where('tb_penilaian_ka', ['id_sequrity' => $id_sequrity])->row_array();

        if ($nilai['kehadiran'] >= 90) {
            $kehadiran = 5;
        } elseif ($nilai['kehadiran'] >= 70 || $nilai['kehadiran'] <= 89) {
            $kehadiran = 4;
        } elseif ($nilai['kehadiran'] >= 50 || $nilai['kehadiran'] <= 69) {
            $kehadiran = 3;
        } elseif ($nilai['kehadiran'] >= 40 || $nilai['kehadiran'] <= 59) {
            $kehadiran = 2;
        } else {
            $kehadiran = 1;
        }

        if ($nilai['lari'] >= 80) {
            $lari = 5;
        } elseif ($nilai['lari'] >= 60 || $nilai['lari'] <= 79) {
            $lari = 4;
        } elseif ($nilai['lari'] >= 40 || $nilai['lari'] <= 59) {
            $lari = 3;
        } elseif ($nilai['lari'] >= 20 || $nilai['lari'] <= 39) {
            $lari = 2;
        } else {
            $lari = 1;
        }

        if ($nilai['pull_up'] >= 80) {
            $pull_up = 5;
        } elseif ($nilai['pull_up'] >= 60 || $nilai['pull_up'] <= 79) {
            $pull_up = 4;
        } elseif ($nilai['pull_up'] >= 40 || $nilai['pull_up'] <= 59) {
            $pull_up = 3;
        } elseif ($nilai['pull_up'] >= 20 || $nilai['pull_up'] <= 39) {
            $pull_up = 2;
        } else {
            $pull_up = 1;
        }

        if ($nilai['sit_up'] >= 80) {
            $sit_up = 5;
        } elseif ($nilai['sit_up'] >= 60 || $nilai['sit_up'] <= 79) {
            $sit_up = 4;
        } elseif ($nilai['sit_up'] >= 40 || $nilai['sit_up'] <= 59) {
            $sit_up = 3;
        } elseif ($nilai['sit_up'] >= 20 || $nilai['sit_up'] <= 39) {
            $sit_up = 2;
        } else {
            $sit_up = 1;
        }

        if ($nilai['push_up'] >= 80) {
            $push_up = 5;
        } elseif ($nilai['push_up'] >= 60 || $nilai['push_up'] <= 79) {
            $push_up = 4;
        } elseif ($nilai['push_up'] >= 40 || $nilai['push_up'] <= 59) {
            $push_up = 3;
        } elseif ($nilai['push_up'] >= 20 || $nilai['push_up'] <= 39) {
            $push_up = 2;
        } else {
            $push_up = 1;
        }

        if ($nilai['shuttle_run'] >= 80) {
            $shuttle_run = 5;
        } elseif ($nilai['shuttle_run'] >= 60 || $nilai['shuttle_run'] <= 79) {
            $shuttle_run = 4;
        } elseif ($nilai['shuttle_run'] >= 40 || $nilai['shuttle_run'] <= 59) {
            $shuttle_run = 3;
        } elseif ($nilai['shuttle_run'] >= 20 || $nilai['shuttle_run'] <= 39) {
            $shuttle_run = 2;
        } else {
            $shuttle_run = 1;
        }

        $bobot_kriteria = $this->db->get('tb_kriteria')->result_array();
        foreach ($bobot_kriteria as $key => $value) {
            if ($value['kode_kriteria'] == 'K') {
                $nilai_kehadiran = $kehadiran * $value['bobot_kriteria'];
            }
        }

        $bobot_global = $this->db->get('tb_subkriteria')->result_array();
        foreach ($bobot_global as $key => $value) {

            if ($value['kode_subkriteria'] == 'S1') {
                $nilai_lari = $lari * $value['bobot_global'];
            } elseif ($value['kode_subkriteria'] == 'S2') {
                $nilai_pull_up = $pull_up * $value['bobot_global'];
            } elseif ($value['kode_subkriteria'] == 'S3') {
                $nilai_sit_up = $sit_up * $value['bobot_global'];
            } elseif ($value['kode_subkriteria'] == 'S4') {
                $nilai_push_up = $push_up * $value['bobot_global'];
            } elseif ($value['kode_subkriteria'] == 'S5') {
                $nilai_shuttle_run = $shuttle_run * $value['bobot_global'];
            }
        };

        $data = [
            'kehadiran' => $nilai_kehadiran,
            'lari' => $nilai_lari,
            'pull_up' => $nilai_pull_up,
            'sit_up' => $nilai_sit_up,
            'push_up' => $nilai_push_up,
            'shuttle_run' => $nilai_shuttle_run
        ];

        $this->db->update('tb_hasil_penilaian', $data, ['id_sequrity' => $id_sequrity]);

        $this->db->from('tb_penilaian_ka pka');
        $this->db->join('tb_perusahaan pr', 'pka.id_perusahaan = pr.id_perusahaan');
        $cek_penilaian_ka = $this->db->get()->num_rows();

        if ($cek_penilaian_ka == 1) {

            $this->db->from('tb_penilaian_ka pka');
            $this->db->where('id_sequrity', $id_sequrity);
            $this->db->join('tb_perusahaan pr', 'pka.id_perusahaan = pr.id_perusahaan');
            $penilaian_ka = $this->db->get()->row_array();

            $this->sendmail();
        }

        $this->db->delete('tb_penilaian_ka', ['id_sequrity' => $id_sequrity]);

        // $tgl_stamp = strtotime('+14 day', strtotime('now'));
        // $taggal_tutup = date('y-m-d', $tgl_stamp);

        $sequrity_mo = [
            'id_perusahaan' => $nilai['id_perusahaan'],
            'id_sequrity' => $nilai['id_sequrity'],
            'tanggal_penilaian' => $nilai['tanggal_penilaian'],
            'status' => 'Belum Dinilai',
            // 'form_ditutup'=> $taggal_tutup,
            'kedisiplinan' => 0,
            'kesigapan' => 0,
            'penampilan' => 0,
            'penguasaan_pekerjaan' => 0,
            'komunikasi' => 0,
            'responsif' => 0,
            'keramahan' => 0
        ];

        $this->db->insert('tb_penilaian_mo', $sequrity_mo);
    }

    private function sendmail()
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.tjoutsource.com',
            'smtp_user' => 'trengginasjaya@tjoutsource.com',
            'smtp_pass' => 'trengginasjaya',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);

        $this->email->from('trengginasjaya@tjoutsource.com', 'PT Trengginas Jaya');
        $this->email->to('mochrizkimaulananurisman@gmail.com');
        $this->email->subject('Penilaian Akhir Tahun');
        $this->email->message('Silahkan login ke aplikasi untuk melakukan penilaian pegawai, klik link ini untuk login : <a href="' . base_url() . '" >Login Aplikasi</a>');


        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }
}
