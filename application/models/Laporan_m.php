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

    public function tampil_laporan_pegawai($id_pegawai)
    {
        $this->db->select('*');
        $this->db->from('tb_laporan_penilaian lp');
        $this->db->join('tb_jabatan j', 'lp.jabatan_id = j.id_jabatan');
        $this->db->where('lp.pegawai_id', $id_pegawai);
        $this->db->order_by('periode_tahun', 'desc');
        $this->db->group_by('periode_tahun');
        return $this->db->get()->result_array();
    }

    public function tampil_laporan_staff($id_staff)
    {
        $this->db->select('*,lp.staff_id');
        $this->db->from('tb_laporan_penilaian lp');
        $this->db->join('tb_pegawai p', 'lp.pegawai_id = p.id_pegawai');
        $this->db->join('tb_jabatan j', 'lp.jabatan_id = j.id_jabatan');
        $this->db->where('lp.staff_id', $id_staff);
        $this->db->order_by('periode_tahun', 'desc');
        $this->db->group_by('periode_tahun');
        $this->db->group_by('lp.jabatan_id');
        return $this->db->get()->result_array();
    }

    public function detail_penilaian_pegawai($pegawai_id,$periode_tahun)
    {
        $this->db->select('*');
        $this->db->from('tb_nilai_akhir na');
        $this->db->join('tb_pegawai p', 'na.pegawai_id = p.id_pegawai');
        $this->db->where('na.pegawai_id', $pegawai_id);
        $this->db->where('YEAR(tgl_periode)', $periode_tahun);
        $this->db->order_by('tgl_periode', 'asc');
        return $this->db->get()->result_array();
    }

    public function detail_penilaian_staff($id_staff,$periode_tahun,$jabatan_id)
    {
        $this->db->select('*');
        $this->db->from('tb_laporan_penilaian lp');
        $this->db->join('tb_pegawai p', 'lp.pegawai_id = p.id_pegawai');
        $this->db->join('tb_jabatan j', 'lp.jabatan_id = j.id_jabatan');
        $this->db->where('lp.staff_id', $id_staff);
        $this->db->where('periode_tahun', $periode_tahun);
        $this->db->where('lp.jabatan_id', $jabatan_id);
        $this->db->order_by('nilai_akhir', 'desc');
        return $this->db->get()->result_array();
    }

    public function detail_nilai($periode_tahun, $jabatan)
    {
        $this->db->select('*');
        $this->db->from('tb_laporan_penilaian lp');
        $this->db->join('tb_pegawai p', 'lp.pegawai_id = p.id_pegawai');
        $this->db->where('periode_tahun', $periode_tahun);
        $this->db->where('lp.jabatan_id', $jabatan);
        return $this->db->get()->result_array();
    }

    public function periode_nilai($periode_tahun, $pegawai_id)
    {
        $this->db->select('*');
        $this->db->from('tb_nilai_akhir na');
        $this->db->join('tb_pegawai p', 'na.pegawai_id = p.id_pegawai');
        $this->db->where('Year(na.tgl_periode)', $periode_tahun);
        $this->db->where('na.pegawai_id', $pegawai_id);
        return $this->db->get()->result_array();
    }
}
