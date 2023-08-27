<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KuotaPegawai_m extends CI_Model
{
    public function tampil_kuotaPegawai()
    {

        $this->db->from('tb_kuota_pegawai kp');
        $this->db->join('tb_jabatan j','kp.jabatan_id = j.id_jabatan');
        $this->db->order_by('j.id_jabatan', 'ASC');
        return $this->db->get()->result_array();
    }

    public function tambah_kuotaPegawai()
    {
        $jabatan = $this->input->post('jabatan');
        $jumlah_kuota = $this->input->post('jumlah_kuota');

        $data = [
            'jabatan_id' => $jabatan,
            'jumlah_kuota' => $jumlah_kuota
        ];

        $this->db->insert('tb_kuota_pegawai', $data);
    }

    public function ubah_kuotaPegawai()
    {
        $id_kuotaPegawai = $this->input->post('id_kuotaPegawai', true);
        $jabatan = $this->input->post('jabatan', true);
        $jumlah_kuota = $this->input->post('jumlah_kuota', true);

        $data = [
            'jabatan_id' => $jabatan,
            'jumlah_kuota' => $jumlah_kuota
        ];

        $this->db->update('tb_kuota_pegawai', $data, ['id_kuotaPegawai' => $id_kuotaPegawai]);
    }

    
}
