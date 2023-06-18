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
        $this->db->order_by('tgl_penilaian', 'desc');
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

    public function detail_penilaianID($id_penilaian)
    {
        $this->db->select('*');
        $this->db->from('tb_detail_penilaian dp');
        $this->db->join('tb_subkriteria sb', 'dp.subkriteria_id = sb.id_subkriteria');
        $this->db->join('tb_kriteria kr', 'sb.kriteria_id = kr.id_kriteria');
        $this->db->where('penilaian_id', $id_penilaian);
        return $this->db->get()->result_array();
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
        $this->db->where('pegawai_id', $pegawai_id);
        $this->db->where('periode_id', $periode_id);
        $this->db->update('tb_penilaian', ['status' => 1]);

        //cek keseluruhan pegawai yang dinilai oleh satu staff
        $this->db->select('*');
        $this->db->from('tb_penilaian');
        $this->db->where('staff_id', $staff_id);
        $this->db->where('status', 0);
        $this->db->where('periode_id', $periode_id);
        $cek_detail_periode = $this->db->get()->result_array();
        if (!$cek_detail_periode) {
            //update status detail periode penilaian di staff tersebut
            $this->db->where('staff_id', $staff_id);
            $this->db->where('periode_id', $periode_id);
            $this->db->update('tb_detail_periode', ['status' => 'selesai']);
        }

       

        $this->hitung_nilai_vektor($penilaian_id, $pegawai_id, $periode_id);
    }

    public function hitung_nilai_vektor($penilaian_id, $pegawai_id, $periode_id)
    {
        // $penilaian_id = $this->input->post('idPenilaian');
        // $pegawai_id = $this->input->post('idPegawai');
        // $periode_id = $this->input->post('idPeriode');

        $this->db->select('*');
        $this->db->from('tb_detail_penilaian dp');
        $this->db->join('tb_subkriteria sb', 'dp.subkriteria_id = sb.id_subkriteria');
        $this->db->where('penilaian_id', $penilaian_id);
        $this->db->where('pegawai_id', $pegawai_id);
        $detail_penilaian = $this->db->get()->result_array();


        $vektor_s = 1;
        foreach ($detail_penilaian as $key => $value) {

            $vektor_s *= ($value['nilai'] ** $value['bobot_subkriteria']);
        }


        $data_hasil = [
            'pegawai_id' => $pegawai_id,
            'periode_id' => $periode_id,
            'vektor_s' => $vektor_s,
            'vektor_v' => 0
        ];

        $this->db->insert('tb_hasil_penilaian', $data_hasil);
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
