<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekomendasi_m extends CI_Model
{
    public function tampil()
    {


        $this->db->from('tb_rekomendasi r');
        $this->db->join('tb_pegawai p', 'r.pegawai_id = p.id_pegawai');
        $this->db->join('tb_jabatan j', 'r.jabatan_id = j.id_jabatan');
        $this->db->group_by('periode_tahun');
        $this->db->group_by('r.jabatan_id');
        return $this->db->get()->result_array();
    }

    public function tambah($tahun, $jabatan, $kuota)
    {
        
        $this->db->from('tb_rekomendasi');
        $this->db->where('jabatan_id', $jabatan);
        $this->db->where('periode_tahun', $tahun);
        $cek_rekomendasi = $this->db->get()->result_array();

        if ($cek_rekomendasi) {
            //hapus data rekomendasi sebelumnya
            $this->db->where('jabatan_id', $jabatan);
            $this->db->where('periode_tahun', $tahun);
            $this->db->delete('tb_rekomendasi');
        }

        // ambil data ke tabel laporan penilaian
        $this->db->from('tb_laporan_penilaian');
        $this->db->where('jabatan_id', $jabatan);
        $this->db->where('periode_tahun', $tahun);
        $this->db->order_by('periode_tahun', 'desc');
        $this->db->order_by('nilai_akhir', 'desc');
        $rekomendasi = $this->db->get()->result_array();

        //ambil data ke tabel nilai akhir
        $passing_grade = $this->db->query("SELECT * FROM tb_nilai_akhir WHERE jabatan_id = {$jabatan} AND YEAR(tgl_periode) = {$tahun} GROUP BY jabatan_id,tgl_periode ORDER BY jabatan_id ASC ")->result_array();

        $jumlah_pg = 0;
        foreach ($passing_grade as $key => $value) {
            $jumlah_pg += $value['passing_grade'];
        }

        $i = 1;
        foreach ($rekomendasi as $key => $value) {
            if ($i <= $kuota) {
                $keterangan = 'Perpanjangan Kontrak';
            } else {
                $keterangan = 'Pemutusan Kontrak';
            }

            if ($value['nilai_akhir'] >= $jumlah_pg) {
                $rekomen = 'Direkomendasikan';
            } else {
                $rekomen = 'Tidak Direkomendasikan';
            }



            $data = [
                'pegawai_id' => $value['pegawai_id'],
                'jabatan_id' => $value['jabatan_id'],
                'staff_id' => $value['staff_id'],
                'periode_tahun' => $value['periode_tahun'],
                'nilai_akhir' => $value['nilai_akhir'],
                'ranking' => $i,
                'rekomendasi' => $rekomen,
                'keterangan' => $keterangan
            ];
            $this->db->insert('tb_rekomendasi', $data);

            $i++;
        }
    }
}
