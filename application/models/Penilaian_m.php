<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian_m extends CI_Model
{
    public function tampil_penilaian($id_staff)
    {
        $this->db->select('*, p.status');
        $this->db->from('tb_penilaian p');
        $this->db->join('tb_periode_penilaian pp', 'p.periode_id = pp.id_periode');
        $this->db->join('tb_pegawai pg', 'p.pegawai_id = pg.id_pegawai');
        $this->db->join('tb_staff st', 'p.staff_id = st.id_staff');
        $this->db->join('tb_jabatan jb', 'pg.jabatan_id = jb.id_jabatan');
        $this->db->where('pg.staff_id', $id_staff);
        // $this->db->where('p.status', 0);
        return $this->db->get()->result_array();
    }

    public function pegawai_idpenilaian($id_penilaian)
    {
        $this->db->select('*,p.staff_id');
        $this->db->from('tb_penilaian p');
        $this->db->join('tb_pegawai pg', 'p.pegawai_id = pg.id_pegawai');
        $this->db->join('tb_jabatan jb', 'pg.jabatan_id = jb.id_jabatan');
        $this->db->join('tb_staff st', 'pg.staff_id = st.id_staff');
        $this->db->where('id_penilaian', $id_penilaian);
        return $this->db->get()->row_array();
    }


    public function tambah_penilaian()
    {
        $penilaian_id = $this->input->post('penilaian_id');
        $pegawai_id = $this->input->post('pegawai_id');
        $staff_id = $this->input->post('staff_id');
        $periode_id = $this->input->post('periode_id');

        $data_detail_penilaian = [];
        for ($i = 1; $i <= 12; $i++) {
            $subkriteria_id = $this->input->post('subkriteria' . $i);
            $nilaisub = $this->input->post('nilaisub' . $i);
            $data = [
                'penilaian_id' => $penilaian_id,
                'pegawai_id' => $pegawai_id,
                'subkriteria_id' => $subkriteria_id,
                'nilai' => $nilaisub
            ];
            array_push($data_detail_penilaian, $data);
        }
        $this->db->insert_batch('tb_detail_penilaian', $data_detail_penilaian);

        //update status penilaian pegawai ke tabel penilaian
        $this->db->update('tb_penilaian', ['status' => 1], ['pegawai_id' => $pegawai_id]);

        //cek keseluruhan pegawai yang dinilai oleh satu staff
        $this->db->select('*');
        $this->db->from('tb_penilaian');
        $this->db->where('staff_id', $staff_id);
        $this->db->where('status', 0);
        $cek_detail_periode = $this->db->get()->result_array();
        if (!$cek_detail_periode) {
            //update status detail periode penilaian di staff tersebut
            $this->db->update('tb_detail_periode', ['status' => 'selesai'], ['staff_id' => $staff_id]);

        }

        //cek keseluruhan penilaian, apakah semua pegawai sudah dinilai oleh masing2 stafnya
        $cek_periode = $this->db->get_where('tb_penilaian', ['status' => 0])->result_array();
        if (!$cek_periode) {
            //update status periode penilaian di tabel periode penilaian
            $this->db->update('tb_periode_penilaian', ['status' => 'selesai'], ['id_periode' => $periode_id]);

            $this->hitung_nilai_akhir();
        }
    }

    public function hitung_nilai_akhir()
    {

        $detail_penilaian = $this->db->get_where('tb_detail_penilaian')->result_array();

        $kriteria = $this->db->get('tb_kriteria')->result_array();
        $subkriteria = $this->db->get('tb_subkriteria')->result_array();
    }

    public function simpan_nilai($id_sequrity)
    {
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
