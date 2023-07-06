<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekomendasi_m extends CI_Model
{
    public function tampil()
    {


        $this->db->from('tb_rekomendasi r');
        $this->db->join('tb_pegawai p', 'r.pegawai_id = p.id_pegawai');
        $this->db->join('tb_jabatan j', 'r.jabatan_id = j.id_jabatan');
        return $this->db->get()->result_array();
    }

    public function tambah()
    {
        $tahun = $this->input->post('tahun');

        $jumlah_vektor_v = $this->db->query("SELECT pegawai_id,p.nama_pegawai,p.nip_pegawai,na.staff_id, na.jabatan_id, tgl_periode, SUM(nilai_akhir) AS jumlah FROM tb_nilai_akhir AS na JOIN tb_pegawai AS p ON na.pegawai_id = p.id_pegawai WHERE YEAR(tgl_periode) = {$tahun}  GROUP BY pegawai_id ORDER BY tgl_periode ")->result_array();

        // $this->db->select('*');
        // $this->db->from('tb_nilai_akhir na');
        // $this->db->join('tb_pegawai p', 'na.pegawai_id = p.id_pegawai');
        // $this->db->order_by('tgl_penilaian', 'asc');
        // $nilai_akhir = $this->db->get()->result_array();

        //passing grade 4 kali penilaian
        $subkriteria = $this->db->get('tb_subkriteria')->result_array();
        $passing_grade = 1;
        foreach ($subkriteria as $key => $value) {
            $passing_grade *= (($value['passing_grade'] + 9) ** $value['bobot_subkriteria']);
        }

        foreach ($jumlah_vektor_v as $key => $value) {
            $nilai_akhir_pegawai = $value['jumlah'];
            if ($nilai_akhir_pegawai > $passing_grade) {
                $keterangan = 'Perpanjangan Kontrak';
            } else {
                $keterangan = 'Pemutusan Kontrak';
            }

            $data = [
                'pegawai_id' => $value['pegawai_id'],
                'jabatan_id' => $value['jabatan_id'],
                'staff_id' => $value['staff_id'],
                'periode_tahun' => date('Y', strtotime($value['tgl_periode'])),
                'nilai_akhir' => $value['jumlah'],
                'keterangan' => $keterangan,
            ];

            $this->db->insert('tb_rekomendasi', $data);
        }
    }
}
