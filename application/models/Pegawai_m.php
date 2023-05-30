<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_m extends CI_Model
{
    public function tampil_pegawai()
    {
        $this->db->from('tb_pegawai pw');
        $this->db->join('tb_jabatan jb', 'pw.jabatan_id = jb.id_jabatan');
        $this->db->join('tb_staff st', 'pw.staff_id = st.id_staff');
        $this->db->order_by('jb.nama_jabatan', 'ASC');
        $this->db->order_by('st.nama_staff', 'ASC');
        return $this->db->get()->result_array();
    }

    public function tampil_pegawai_id($id_pegawai)
    {
        $this->db->from('tb_pegawai pw');
        $this->db->join('tb_jabatan jb', 'pw.jabatan_id = jb.id_jabatan');
        $this->db->join('tb_staff st', 'pw.staff_id = st.id_staff');
        $this->db->where('id_pegawai', $id_pegawai);
        return $this->db->get()->row_array();
    }

    public function tambah_pegawai()
    {
        $nama_pegawai = $this->input->post('nama_pegawai');
        $nip_pegawai = $this->input->post('nip_pegawai');
        $email_pegawai = $this->input->post('email_pegawai');
        $alamat_pegawai = $this->input->post('alamat_pegawai');
        $nama_jabatan = $this->input->post('nama_jabatan');
        $nama_staff = $this->input->post('nama_staff');
        $no_telp = $this->input->post('no_telp');

        $data = [
            'jabatan_id' => $nama_jabatan,
            'staff_id' => $nama_staff,
            'nama_pegawai' => $nama_pegawai,
            'nip_pegawai' => $nip_pegawai,
            'alamat' => $alamat_pegawai,
            'no_telp' => $no_telp,
            'email' => $email_pegawai
        ];

        $this->db->insert('tb_pegawai', $data);
    }

    public function ubah_pegawai()
    {
        $id_pegawai = $this->input->post('id_pegawai');
        $nama_pegawai = $this->input->post('nama_pegawai');
        $nip_pegawai = $this->input->post('nip_pegawai');
        $email_pegawai = $this->input->post('email_pegawai');
        $alamat_pegawai = $this->input->post('alamat_pegawai');
        $nama_jabatan = $this->input->post('nama_jabatan');
        $nama_staff = $this->input->post('nama_staff');
        $no_telp = $this->input->post('no_telp');

        $data = [
            'jabatan_id' => $nama_jabatan,
            'staff_id' => $nama_staff,
            'nama_pegawai' => $nama_pegawai,
            'nip_pegawai' => $nip_pegawai,
            'alamat' => $alamat_pegawai,
            'no_telp' => $no_telp,
            'email' => $email_pegawai
        ];


        $this->db->update('tb_pegawai', $data, ['id_pegawai' => $id_pegawai]);
    }
}
