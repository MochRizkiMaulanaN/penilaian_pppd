<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode_m extends CI_Model
{
    public function tampil_periode_tahun()
    {
        $this->db->select('*');
        $this->db->from('tb_periode_penilaian pp');
        $this->db->order_by('tgl_penilaian', 'asc');
        $this->db->group_by('Year("tgl_penilaian")');
        return $this->db->get()->result_array();
    }

    public function tampil_periode()
    {
        $this->db->select('*');
        $this->db->from('tb_periode_penilaian');
        $this->db->order_by('tgl_penilaian', 'asc');
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

    public function tambah_periode($tahun)
    {

        $data = array(
            array(
                'tgl_penilaian' => $tahun . '-02-01',
                'status' => 'belum'

            ),
            array(
                'tgl_penilaian' => $tahun . '-05-01',
                'status' => 'belum'
            ),
            array(
                'tgl_penilaian' => $tahun . '-08-01',
                'status' => 'belum'
            ),
            array(
                'tgl_penilaian' => $tahun . '-011-01',
                'status' => 'belum'
            )
        );

        $this->db->insert_batch('tb_periode_penilaian', $data);
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
            $this->db->from('tb_periode_penilaian');
            $this->db->order_by('tgl_penilaian', 'desc');
            $this->db->limit(1);
            $cek_data = $this->db->get()->row_array();
            if ($cek_data) {
                // foreach ($cek_data as $key => $value) {
                if ($cek_data['status'] == 'belum' || $cek_data['status'] == 'sedang dinilai') {
                    return true;
                    // break;
                } else {
                    // $this->db->from('tb_periode_penilaian');
                    // $this->db->group_by('tgl_penilaian');
                    // $this->db->order_by('tgl_penilaian', 'desc');
                    // $this->db->limit(1);
                    // $cek_tanggal = $this->db->get()->row_array();

                    // $tgl_sebelumnya = $cek_tanggal['tgl_penilaian'];
                    $tgl_sebelumnya = $cek_data['tgl_penilaian'];

                    //$tgl_berikutnya = date('Y-m-d', strtotime('+3 month', strtotime($tgl_sebelumnya)));

                    if (strtotime($tgl_penilaian) < strtotime($tgl_sebelumnya)) {
                        return true;
                        // break;
                    } else {
                        $this->tambah_periode($tgl_penilaian);
                        // break;
                    }
                }
                // }
            } else {
                $this->tambah_periode($tgl_penilaian);
            }
        }
    }

    public function cek_statusPeriodeTahun($tahun)
    {
        $this->db->select('*');
        $this->db->from('tb_periode_penilaian');
        $this->db->where('YEAR(tgl_penilaian)', $tahun);
        $this->db->or_where('status', 'belum');
        $this->db->or_where('status', 'sedang dinilai');
        $cek = $this->db->get()->result_array();

        if ($cek) {
            return false;
        } else {
            $this->tambah_periode($tahun);
            return true;
        }
    }


    public function tambah_detail_periode($tgl_penilaian, $id_periode)
    {
        //cek staff ke tabel pegawai
        $this->db->from('tb_pegawai');
        $this->db->group_by('staff_id');
        $staff_id = $this->db->get()->result_array();

        foreach ($staff_id as $key => $value) {
            //tambah data ke tabel detail periode
            $data = [
                'periode_id' => $id_periode,
                'tgl_penilaian' => $tgl_penilaian,
                'staff_id' => $value['staff_id'],
                'status' => 'proses penilaian'
            ];

            $this->db->insert('tb_detail_periode', $data);
        }

        //update status di tabel periode penilaian
        $this->db->update('tb_periode_penilaian', ['status' => 'sedang dinilai'], ['id_periode' => $id_periode]);
    }

    public function tambah_penilaian($id_periode, $tgl_penilaian)
    {

        $data_pegawai = $this->db->get_where('tb_pegawai', ['status_pegawai' => 1])->result_array();

        $data_penilaian = [];
        foreach ($data_pegawai as $key => $value) {
            $pegawai_staff = [
                'periode_id' => $id_periode,
                'pegawai_id' => $value['id_pegawai'],
                'staff_id' => $value['staff_id'],
                'tgl_penilaian' => $tgl_penilaian,
                'status' => 0,
            ];

            array_push($data_penilaian, $pegawai_staff);
        }
        $this->db->insert_batch('tb_penilaian', $data_penilaian);
    }


    public function hitung_nilai_akhir($id_periode)
    {

        $jumlah_vektors = $this->db->query("SELECT SUM(vektor_s) AS jumlah, jabatan_id FROM tb_hasil_penilaian WHERE periode_id = {$id_periode} GROUP BY jabatan_id ORDER BY jabatan_id ASC ")->result_array();


        $subkriteria = $this->db->get('tb_subkriteria')->result_array();

        $vektors_pg = 1;
        foreach ($subkriteria as $key => $value) {
            $vektors_pg *= ($value['passing_grade'] ** $value['bobot_subkriteria']);
        }


        //hitung vektor v dari masing - masing pegawai
        $hasil = $this->db->get_where('tb_hasil_penilaian', ['periode_id' => $id_periode])->result_array();


        foreach ($hasil as $key => $value) {
            $jabatan_id = $value['jabatan_id'];
            $vektor_s = $value['vektor_s'];
            $pegawai_id = $value['pegawai_id'];
            foreach ($jumlah_vektors as $key => $value_vs) {
                if ($jabatan_id == $value_vs['jabatan_id']) {
                    $vektor_v = $vektor_s / $value_vs['jumlah'];
                    $passing_grade =$vektors_pg /$value_vs['jumlah'] ;
                    
                }
            }

            //update nilai vektor v 
            $this->db->where('periode_id', $id_periode);
            $this->db->where('pegawai_id', $pegawai_id);
            $this->db->update('tb_hasil_penilaian', ['vektor_v' => $vektor_v]);

            //simpan ke tabel tb_nilai_akhir
            $staff_id = $this->db->get_where('tb_pegawai', ['id_pegawai' => $pegawai_id])->row_array();

            $tgl_periode = $this->db->get_where('tb_periode_penilaian', ['id_periode' => $id_periode])->row_array();

            $data = [
                'pegawai_id' => $pegawai_id,
                'jabatan_id' => $jabatan_id,
                'staff_id' => $staff_id['staff_id'],
                'tgl_periode' => $tgl_periode['tgl_penilaian'],
                'nilai_akhir' => $vektor_v,
                'passing_grade' => $passing_grade //kolom baru
            ];
            $this->db->insert('tb_nilai_akhir', $data);

            //cek apakah pegawai sudah dilakukan penilaian sebanyak 4 kali (akan dimasukkan ke tabel laporan penilaian)
            $this->db->from('tb_nilai_akhir');
            $this->db->where('pegawai_id', $pegawai_id);
            $this->db->order_by('pegawai_id', 'desc');
            $cek_penilaian = $this->db->get()->num_rows();

            if ($cek_penilaian >= 4) {
                $this->db->from('tb_nilai_akhir');
                $this->db->where('pegawai_id', $pegawai_id);
                $this->db->order_by('pegawai_id', 'desc');
                $this->db->limit(4);
                $nilai_akhir = $this->db->get()->result_array();

                $nilai_akhir_pegawai = 0;
                foreach ($nilai_akhir as $key => $value) {
                    $nilai_akhir_pegawai += $value['nilai_akhir'];
                }


                $data = [
                    'pegawai_id' => $pegawai_id,
                    'jabatan_id' => $jabatan_id,
                    'staff_id' => $staff_id['staff_id'],
                    'periode_tahun' => date('Y', strtotime($tgl_periode['tgl_penilaian'])),
                    'nilai_akhir' => $nilai_akhir_pegawai,
                ];

                $this->db->insert('tb_laporan_penilaian', $data);
            }
        }

        //update status periode penilaian di tabel periode penilaian
        $this->db->update('tb_periode_penilaian', ['status' => 'selesai'], ['id_periode' => $id_periode]);

        //hapus data detail penilaian pegawai ke tabel detail penilaian
        $this->db->query('DELETE FROM tb_detail_penilaian');

       
    }
}
