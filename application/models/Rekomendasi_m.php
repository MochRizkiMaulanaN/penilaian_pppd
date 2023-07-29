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

        $this->db->from('tb_laporan_penilaian');
        $this->db->where('jabatan_id', $jabatan);
        $this->db->where('periode_tahun', $tahun);
        $this->db->order_by('nilai_akhir', 'desc');
        $rekomendasi = $this->db->get()->result_array();

        // var_dump($rekomendasi);die;

        $i = 0;
        foreach ($rekomendasi as $key => $value) {
            if ($i < $kuota) {
                $keterangan = 'Perpanjangan Kontrak';
            } else {
                $keterangan = 'Pemutusan Kontrak';
            }

            $data = [
                'pegawai_id' => $value['pegawai_id'],
                'jabatan_id' => $value['jabatan_id'],
                'staff_id' => $value['staff_id'],
                'periode_tahun' => $value['periode_tahun'],
                'nilai_akhir' => $value['nilai_akhir'],
                'keterangan' => $keterangan
            ];
            $this->db->insert('tb_rekomendasi', $data);

            $i++;
        }
    }
}
