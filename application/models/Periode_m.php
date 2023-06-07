<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode_m extends CI_Model
{
    public function tampil_periode()
    {
        $this->db->select('*');
        $this->db->from('tb_periode_penilaian pp');
        $this->db->join('tb_staff st', 'pp.staff_id = st.id_staff');
        return $this->db->get()->result_array();
    }

    public function tambah_periode($tgl_penilaian)
    {
        $staff = $this->db->get('tb_staff')->result_array();

        $data_periode = [];
        foreach ($staff as $key => $value) {
            $data = [
                'tgl_penilaian' => $tgl_penilaian,
                'staff_id' => $value['id_staff'],
                'status' => 'belum'
            ];

            array_push($data_periode, $data);
        }


        $this->db->insert_batch('tb_periode_penilaian', $data_periode);
    }

    public function cek_statusPeriode($tgl_penilaian)
    {
        $this->db->select('*');
        $this->db->from('tb_periode_penilaian');
        $this->db->where('tgl_penilaian', $tgl_penilaian);
        $cek = $this->db->get()->result_array();

        if ($cek) {
            return true;
        } else {
            $this->db->order_by('tgl_penilaian', 'desc');
            $cek_data = $this->db->get('tb_periode_penilaian')->result_array();
            if ($cek_data) {
                foreach ($cek_data as $key => $value) {
                    if ($value['status'] == 'belum' || $value['status'] == 'sedang dinilai') {
                        return true;
                        break;
                    } else {
                        $this->db->group_by('tgl_penilaian');
                        $this->db->order_by('tgl_penilaian', 'desc');
                        $this->db->limit(1);
                        $cek_tanggal = $this->db->get('tb_periode_penilaian')->result_array();

                        $tgl_sebelumnya = $cek_tanggal['tgl_penilaian'];

                        $tgl_berikutnya = date('d F Y', strtotime('+3 month', strtotime($tgl_sebelumnya)));

                        if (strtotime($tgl_penilaian) >= strtotime($tgl_berikutnya)) {
                            $this->tambah_periode($tgl_penilaian);
                            break;
                        } else {
                            return true;
                            break;
                        }
                    }
                }
            } else {
                $this->tambah_periode($tgl_penilaian);
            }
        }
    }


    public function tambah_penilaian()
    {
        $id_periode = $this->input->post('id_periode');
        $staff_id = $this->input->post('staff_id');

        $data_pegawai = $this->db->get_where('tb_pegawai', ['staff_id' => $staff_id])->result_array();

        $data_penilaian = [];
        foreach ($data_pegawai as $key => $value) {
            $pegawai_staff = [
                'periode_id' => $id_periode,
                'pegawai_id' => $value['id_pegawai'],
                'staff_id' => $staff_id,
                'status' => 0,
                'nilai' => 0,
                'passing_grade' => 0,
                'keterangan' => 'kosong'
            ];

            array_push($data_penilaian, $pegawai_staff);
        }


        $this->db->insert_batch('tb_penilaian', $data_penilaian);

        //update status di tabel periode penilaian
        $this->db->update('tb_periode_penilaian', ['status' => 'sedang dinilai'], ['id_periode' => $id_periode]);
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
