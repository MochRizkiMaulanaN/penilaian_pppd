<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_m extends CI_Model
{

    public function tampil_staff()
    {
        return $this->db->get('tb_staff')->result_array();
    }
   
    public function tambah_staff()
    {
        $nama_staff = $this->input->post('nama_staff');
        $nip_staff = $this->input->post('nip_staff');
        $jabatan_staff = $this->input->post('jabatan_staff');
        $nama_penilai = $this->input->post('nama_penilai');

        $data = [
            'nama_penilai' => $nama_penilai,
            'nip_staff' => $nip_staff,
            'jabatan_staff' => $jabatan_staff,
            'nama_staff' => $nama_staff
        ];
        $this->db->insert('tb_staff', $data);
    }

    public function tampil_staff_id($id_staff)
    {
        return $this->db->get_where('tb_staff',['id_staff' => $id_staff])->row_array();
    }

    public function ubah_staff()
    {
        $id_staff = $this->input->post('id_staff');
        $nama_staff = $this->input->post('nama_staff');
        $nip_staff = $this->input->post('nip_staff');
        $jabatan_staff = $this->input->post('jabatan_staff');
        $nama_penilai = $this->input->post('nama_penilai');

        $data = [
            'nama_penilai' => $nama_penilai,
            'nip_staff' => $nip_staff,
            'jabatan_staff' => $jabatan_staff,
            'nama_staff' => $nama_staff
        ];
        $this->db->update('tb_staff', $data, ['id_staff' => $id_staff]);
    }

    public function tampil_export($id_perusahaan)
    {
        $this->db->select('*');
        $this->db->from('tb_hasil_penilaian p');
        $this->db->join('tb_perusahaan pr', 'p.id_perusahaan = pr.id_perusahaan');
        $this->db->join('tb_sequrity s', 'p.id_sequrity = s.id_sequrity');
        $this->db->where('p.id_perusahaan', $id_perusahaan);
        return $this->db->get()->result_array();
    }


}
