<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_m extends CI_Model
{
    public function tampil_pengguna()
    {
        $this->db->select('*');
        $this->db->from('tb_pengguna pg');
        $this->db->join('tb_user_role r', 'pg.role_id = r.id_role');
        return $this->db->get()->result_array();
    }

    public function tampil_pengguna_id($id_pengguna)
    {
        $this->db->select('*');
        $this->db->from('tb_pengguna pg');
        $this->db->join('tb_user_role r', 'pg.role_id = r.id_role');
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->get()->row_array();
    }

    public function tambah_pengguna()
    {
        $nama_pengguna = $this->input->post('nama_pengguna');
        $nip_pengguna = $this->input->post('nip_pengguna');
        $email_pengguna = $this->input->post('email_pengguna');
        $role_pengguna = $this->input->post('role_pengguna');
        $password = $this->input->post('password');

        $data = [
            'role_id' => $role_pengguna,
            'nama_pengguna' => $nama_pengguna,
            'nip_pengguna' => $nip_pengguna,
            'email' => $email_pengguna,
            'password' => $password,
            'aktif' => '1'
        ];

        $this->db->insert('tb_pengguna', $data);
    }

    public function ubah_pengguna()
    {
        $id_pengguna = $this->input->post('id_pengguna');
        $nama_pengguna = $this->input->post('nama_pengguna');
        $nip_pengguna = $this->input->post('nip_pengguna');
        $email_pengguna = $this->input->post('email_pengguna');
        $role_pengguna = $this->input->post('role_pengguna');
        $aktif_pengguna = $this->input->post('aktif_pengguna');

        $data = [
            'role_id' => $role_pengguna,
            'nama_pengguna' => $nama_pengguna,
            'nip_pengguna' => $nip_pengguna,
            'email' => $email_pengguna,
            'aktif' => $aktif_pengguna
        ];
        $this->db->update('tb_pengguna', $data, ['id_pengguna' => $id_pengguna]);
    }
}
