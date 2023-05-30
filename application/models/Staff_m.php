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
        $nama_penilai = $this->input->post('nama_penilai');

        $data = [
            'nama_penilai' => $nama_penilai,
            'nip_staff' => $nip_staff,
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
        $nama_penilai = $this->input->post('nama_penilai');

        $data = [
            'nama_penilai' => $nama_penilai,
            'nip_staff' => $nip_staff,
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

    public function tambah_staffdasd()
    {
        $nama_perusahaan = $this->input->post('nama_perusahaan', true);
        $tanggal_penilaian = $this->input->post('tanggal_penilaian', true);


        $data_sequrity = $this->db->get_where('tb_sequrity', ['id_perusahaan' => $nama_perusahaan])->result_array();

        $data_ka = [];
        $data_mo = [];
        foreach ($data_sequrity as $key => $value) {
            $sequrity_ka = [
                'id_perusahaan' => $value['id_perusahaan'],
                'id_sequrity' => $value['id_sequrity'],
                'tanggal_penilaian' => $tanggal_penilaian,
                'status' => 'Belum Dinilai',
                'lari' => 0,
                'pull_up' => 0,
                'sit_up' => 0,
                'push_up' => 0,
                'shuttle_run' => 0
            ];

            array_push($data_ka, $sequrity_ka);

            $sequrity_mo = [
                'id_perusahaan' => $value['id_perusahaan'],
                'id_sequrity' => $value['id_sequrity'],
                'tanggal_penilaian' => $tanggal_penilaian,
                'status' => 'Belum Dinilai',
                'kedisiplinan' => 0,
                'kesigapan' => 0,
                'penampilan' => 0,
                'penguasaan_pekerjaan' => 0,
                'komunikasi' => 0,
                'responsif' => 0,
                'keramahan' => 0
            ];

            array_push($data_mo, $sequrity_mo);
        }

        $this->db->insert_batch('tb_penilaian_ka', $data_ka);
        $this->db->insert_batch('tb_penilaian_mo', $data_mo);
    }

    public function simpan_nilai($id_sequrity)
    {

        $kehadiran = $this->input->post('kehadiran', true);
        $lari = $this->input->post('lari', true);
        $pull_up = $this->input->post('pull_up', true);
        $sit_up = $this->input->post('sit_up', true);
        $push_up = $this->input->post('push_up', true);
        $shuttle_run = $this->input->post('shuttle_run', true);

        $data = [
            'status' => 'Sudah Dinilai',
            'kehadiran' => $kehadiran,
            'lari' => $lari,
            'pull_up' => $pull_up,
            'sit_up' => $sit_up,
            'push_up' => $push_up,
            'shuttle_run' => $shuttle_run
        ];

        $this->db->update('tb_penilaian_ka', $data, ['id_sequrity' => $id_sequrity]);
    }
}
