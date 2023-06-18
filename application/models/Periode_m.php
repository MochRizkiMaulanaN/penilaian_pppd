<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode_m extends CI_Model
{
    public function tampil_periode_tahun()
    {
        $this->db->select('*');
        $this->db->from('tb_periode_penilaian pp');
        $this->db->order_by('tgl_penilaian', 'desc');
        $this->db->group_by('Year("tgl_penilaian")');
        return $this->db->get()->result_array();
    }

    public function tampil_periode()
    {
        $this->db->select('*');
        $this->db->from('tb_periode_penilaian pp');
        $this->db->order_by('tgl_penilaian', 'desc');
        return $this->db->get()->result_array();
    }

    public function tampil_detail_periode($id_periode)
    {
        $this->db->select('*');
        $this->db->from('tb_detail_periode dp');
        $this->db->join('tb_staff st', 'dp.staff_id = st.id_staff');
        $this->db->where('periode_id', $id_periode);
        $this->db->order_by('tgl_penilaian', 'desc');
        return $this->db->get()->result_array();
    }

    public function tambah_periode($tgl_penilaian)
    {

        $data = [
            'tgl_penilaian' => $tgl_penilaian,
            'status' => 'belum'
        ];

        $this->db->insert('tb_periode_penilaian', $data);
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
                    if ($value['status'] == 'belum' || $value['status'] == 'proses penilaian') {
                        return true;
                        break;
                    } else {
                        $this->db->group_by('tgl_penilaian');
                        $this->db->order_by('tgl_penilaian', 'desc');
                        $this->db->limit(1);
                        $cek_tanggal = $this->db->get('tb_periode_penilaian')->row_array();

                        $tgl_sebelumnya = $cek_tanggal['tgl_penilaian'];

                        $tgl_berikutnya = date('Y-m-d', strtotime('+3 month', strtotime($tgl_sebelumnya)));

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


    public function tambah_detail_periode($tgl_penilaian, $id_periode)
    {

        //tambah data ke tabel detail periode
        $staff = $this->db->get('tb_staff')->result_array();

        $data_periode = [];
        foreach ($staff as $key => $value) {
            $data = [
                'periode_id' => $id_periode,
                'tgl_penilaian' => $tgl_penilaian,
                'staff_id' => $value['id_staff'],
                'status' => 'proses penilaian'
            ];

            array_push($data_periode, $data);
        }
        $this->db->insert_batch('tb_detail_periode', $data_periode);

        //update status di tabel periode penilaian
        $this->db->update('tb_periode_penilaian', ['status' => 'sedang dinilai'], ['id_periode' => $id_periode]);
    }

    public function tambah_penilaian($id_periode)
    {

        $data_pegawai = $this->db->get_where('tb_pegawai')->result_array();

        // if (!$data_pegawai) {
        //     return true;
        // } else {
        $data_penilaian = [];
        foreach ($data_pegawai as $key => $value) {
            $pegawai_staff = [
                'periode_id' => $id_periode,
                'pegawai_id' => $value['id_pegawai'],
                'staff_id' => $value['staff_id'],
                'status' => 0,
                'nilai' => 0,
                'passing_grade' => 0,
                'keterangan' => 'kosong'
            ];

            array_push($data_penilaian, $pegawai_staff);
        }
        $this->db->insert_batch('tb_penilaian', $data_penilaian);
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

    public function hitung_nilai_akhir($id_periode)
    {

        //ambil hanya tahun nya saja
        $tanggal = $this->db->query("SELECT YEAR(tgl_penilaian) AS tahun FROM tb_periode_penilaian WHERE id_periode =" . $id_periode)->row_array();
        $tahun = $tanggal['tahun'];

        $jumlah_vektors = $this->db->query("SELECT SUM(vektor_s) AS jumlah FROM tb_hasil_penilaian WHERE periode_id =" . $id_periode)->row_array();

        $subkriteria = $this->db->get('tb_subkriteria')->result_array();

        $vektors_pg = 1;
        foreach ($subkriteria as $key => $value) {
            $vektors_pg *= ($value['passing_grade'] ** $value['bobot_subkriteria']);
        }

        $total_vektors = $jumlah_vektors['jumlah'] + $vektors_pg;

        $passing_grade = $vektors_pg / $total_vektors;

        //hitung vektor v dari masing - masing pegawai
        $hasil = $this->db->get_where('tb_hasil_penilaian', ['periode_id' => $id_periode])->result_array();


        foreach ($hasil as $key => $value) {
            $pegawai_id = $value['pegawai_id'];
            $vektor_v = $value['vektor_s'] / $total_vektors;

            //update nilai dan passing grade di tabel penilaian 
            $this->db->where('periode_id', $id_periode);
            $this->db->where('pegawai_id', $pegawai_id);
            $this->db->update('tb_penilaian', ['nilai' => $vektor_v, 'passing_grade' => $passing_grade ]);

            //update nilai vektor v
            $this->db->where('periode_id', $id_periode);
            $this->db->where('pegawai_id', $pegawai_id);
            $this->db->update('tb_hasil_penilaian', ['vektor_v' => $vektor_v]);

            //cek ke tabel tb_nilai_akhir
            $this->db->select('*');
            $this->db->from('tb_nilai_akhir');
            $this->db->where('tahun', $tahun);
            $this->db->where('pegawai_id', $pegawai_id);
            $cek_data = $this->db->get()->row_array();

            if ($cek_data) {
                // $periode_pertama = $cek_data['periode_pertama'];
                $periode_kedua = $cek_data['periode_kedua'];
                $periode_ketiga = $cek_data['periode_ketiga'];
                // $periode_keempat = $cek_data['periode_keempat'];
                if ($periode_kedua == 0) {
                    // var_dump($pegawai_id, $tahun);
                    $data = [
                        'periode_kedua' => $vektor_v
                    ];
                    $this->db->where('pegawai_id', $pegawai_id);
                    $this->db->where('tahun', $tahun);
                    $this->db->update('tb_nilai_akhir', $data);
                } else {
                    if ($periode_ketiga == 0) {
                        $data = [
                            'periode_ketiga' => $vektor_v
                        ];
                        $this->db->where('pegawai_id', $pegawai_id);
                        $this->db->where('tahun', $tahun);
                        $this->db->update('tb_nilai_akhir', $data);
                    } else {
                        $data = [
                            'periode_keempat' => $vektor_v
                        ];
                        $this->db->where('pegawai_id', $pegawai_id);
                        $this->db->where('tahun', $tahun);
                        $this->db->update('tb_nilai_akhir', $data);
                    }
                }
            } else {
                $data = [
                    'pegawai_id' => $pegawai_id,
                    'tahun' => $tahun,
                    'periode_pertama' => $vektor_v,
                    'periode_kedua' => 0,
                    'periode_ketiga' => 0,
                    'periode_keempat' => 0
                ];
                $this->db->insert('tb_nilai_akhir', $data);
            }
        }

        //update status periode penilaian di tabel periode penilaian
        $this->db->update('tb_periode_penilaian', ['status' => 'selesai'], ['id_periode' => $id_periode]);


        //cek keseluruhan status periode penilaian
        // $this->db->from('tb_periode_penilaian');
        // $this->db->where('Year("tgl_penilaian")', $tahun);
        // $this->db->where('status', 'selesai');
        // $cek_data = $this->db->get();
        // if ($cek_data->num_rows() == 4) {
        //     var_dump('penilaian di tahun' . $tahun . 'sudah dilakukan');
        //     die;
        // }
    }
}
