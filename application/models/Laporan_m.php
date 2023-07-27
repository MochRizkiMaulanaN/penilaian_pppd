<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_m extends CI_Model
{
    public function tampil_laporan()
    {
        $this->db->select('*');
        $this->db->from('tb_laporan_penilaian lp');
        $this->db->join('tb_jabatan j', 'lp.jabatan_id = j.id_jabatan');
        $this->db->order_by('periode_tahun', 'desc');
        $this->db->group_by('periode_tahun');
        $this->db->group_by('lp.jabatan_id');
        return $this->db->get()->result_array();
    }

    public function detail_nilai($periode_tahun,$jabatan)
    {
        $this->db->select('*');
        $this->db->from('tb_laporan_penilaian lp');
        $this->db->join('tb_pegawai p', 'lp.pegawai_id = p.id_pegawai');
        $this->db->where('periode_tahun', $periode_tahun);
        $this->db->where('lp.jabatan_id', $jabatan);
        return $this->db->get()->result_array();
    }

    public function periode_nilai($periode_tahun,$pegawai_id)
    {
        $this->db->select('*');
        $this->db->from('tb_hasil_penilaian hp');
        $this->db->join('tb_pegawai p', 'hp.pegawai_id = p.id_pegawai');
        $this->db->join('tb_periode_penilaian pr', 'hp.periode_id = pr.id_periode');
        $this->db->where('Year(pr.tgl_penilaian)', $periode_tahun);
        $this->db->where('hp.pegawai_id', $pegawai_id);
        return $this->db->get()->result_array();
    }
}