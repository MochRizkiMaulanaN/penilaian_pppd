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

    public function tambah()
    {
        $tahun = $this->input->post('tahun');
        $jabatan = $this->input->post('jabatan');
        $kuota = $this->input->post('kuota');

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

        $this->db->from('tb_laporan_penilaian');
        $this->db->where('jabatan_id', $jabatan);
        $this->db->order_by('periode_tahun', 'desc');
        $this->db->order_by('nilai_akhir', 'desc');
        $rekomendasi = $this->db->get()->result_array();

        //hitung passing grade
        $subkriteria = $this->db->get('tb_subkriteria')->result_array();

        $vektors_pg = 1;
        foreach ($subkriteria as $key => $value) {
            $vektors_pg *= (($value['passing_grade'] + 9) ** $value['bobot_subkriteria']);
        }
        //var_dump($vektors_pg);die;

        $this->db->select('*,SUM(vektor_s) AS jumlah');
        $this->db->from('tb_hasil_penilaian hp');
        $this->db->join('tb_periode_penilaian pp', 'hp.periode_id = pp.id_periode');
        $this->db->where('jabatan_id', $jabatan);
        $this->db->where('YEAR(pp.tgl_penilaian)', $tahun);
        $this->db->group_by('hp.jabatan_id');
        $jumlah_vektors = $this->db->get()->row_array();



        $passing_grade = $jumlah_vektors['jumlah'] / $vektors_pg;



        //var_dump($passing_grade);die;
        $i = 1;
        foreach ($rekomendasi as $key => $value) {
            if ($i <= $kuota) {
                $keterangan = 'Perpanjangan Kontrak';
            } else {
                $keterangan = 'Pemutusan Kontrak';
            }

            if ($value['nilai_akhir'] >= $passing_grade) {
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
