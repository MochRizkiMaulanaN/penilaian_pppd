<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria_m extends CI_Model
{
    public function tampil_kriteria()
    {

        return $this->db->get('tb_kriteria')->result_array();
    }

    public function tambah_kriteria()
    {
        $nama_kriteria = $this->input->post('nama_kriteria');
        $bobot_kriteria = $this->input->post('bobot_kriteria');

        $data = [
            'nama_kriteria' => $nama_kriteria,
            'bobot_kriteria' => $bobot_kriteria
        ];

        $this->db->insert('tb_kriteria', $data);
    }

    public function ubah_kriteria()
    {
        $id_kriteria = $this->input->post('id_kriteria', true);
        $nama_kriteria = $this->input->post('nama_kriteria', true);
        $bobot_kriteria = $this->input->post('bobot_kriteria', true);

        $data = [
            'nama_kriteria' => $nama_kriteria,
            'bobot_kriteria' => $bobot_kriteria
        ];

        $this->db->update('tb_kriteria', $data, ['id_kriteria' => $id_kriteria]);
        $this->db->update('tb_subkriteria', ['bobot_subkriteria' => $bobot_kriteria], ['kriteria_id' => $id_kriteria]);
    }

    
}
