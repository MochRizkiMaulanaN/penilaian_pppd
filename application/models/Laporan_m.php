<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_m extends CI_Model
{
    public function tampil_laporan()
    {
        $this->db->select('*');
        $this->db->from('tb_nilai_akhir na');
        $this->db->join('tb_jabatan j', 'na.jabatan_id = j.id_jabatan');
        $this->db->order_by('tgl_periode', 'desc');
        $this->db->group_by('YEAR(tgl_periode)');
        $this->db->group_by('na.jabatan_id');
        return $this->db->get()->result_array();
    }

    public function tampil_laporan_pegawai($id_pegawai)
    {
        $this->db->select('*');
        $this->db->from('tb_nilai_akhir na');
        $this->db->join('tb_jabatan j', 'na.jabatan_id = j.id_jabatan');
        $this->db->where('na.pegawai_id', $id_pegawai);
        $this->db->order_by('tgl_periode', 'desc');
        $this->db->group_by('Year(tgl_periode)');
        return $this->db->get()->result_array();
    }

    public function tampil_laporan_staff($id_staff)
    {
        $this->db->select('*,na.staff_id');
        $this->db->from('tb_nilai_akhir na');
        $this->db->join('tb_pegawai p', 'na.pegawai_id = p.id_pegawai');
        $this->db->join('tb_jabatan j', 'na.jabatan_id = j.id_jabatan');
        $this->db->where('na.staff_id', $id_staff);
        $this->db->order_by('tgl_periode', 'desc');
        $this->db->group_by('Year(tgl_periode)');
        $this->db->group_by('na.jabatan_id');
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
        $this->db->select('*, na.staff_id');
        $this->db->from('tb_nilai_akhir na');
        $this->db->join('tb_pegawai p', 'na.pegawai_id = p.id_pegawai');
        $this->db->join('tb_jabatan j', 'na.jabatan_id = j.id_jabatan');
        $this->db->where('na.staff_id', $id_staff);
        $this->db->where('Year(tgl_periode)', $periode_tahun);
        $this->db->where('na.jabatan_id', $jabatan_id);
        $this->db->order_by('nilai_akhir', 'desc');
        $this->db->group_by('pegawai_id');
        $this->db->group_by('Year(tgl_periode)');
        return $this->db->get()->result_array();
    }

    //coba
    public function periode_nilai_staff_perPegawai($periode_tahun, $pegawai_id)
    {
        $this->db->select('*');
        $this->db->from('tb_nilai_akhir na');
        $this->db->join('tb_pegawai p', 'na.pegawai_id = p.id_pegawai');
        $this->db->where('Year(na.tgl_periode)', $periode_tahun);
        $this->db->where('na.pegawai_id', $pegawai_id);
        return $this->db->get()->result_array();
    }

    public function detail_nilai($periode_tahun, $jabatan)
    {
        $this->db->select('*');
        $this->db->from('tb_nilai_akhir na');
        $this->db->join('tb_pegawai p', 'na.pegawai_id = p.id_pegawai');
        $this->db->where('Year(tgl_periode)', $periode_tahun);
        $this->db->where('na.jabatan_id', $jabatan);
        $this->db->group_by('pegawai_id');
        $this->db->group_by('Year(tgl_periode)');
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
