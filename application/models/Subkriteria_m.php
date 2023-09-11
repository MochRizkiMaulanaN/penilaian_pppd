<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkriteria_m extends CI_Model
{
    public function tampil_subkriteria($id_kriteria)
    {

        return $this->db->get_where('tb_subkriteria',['kriteria_id' => $id_kriteria])->result_array();
    }

    public function tambah_subkriteria()
    {
        $nama_subkriteria = $this->input->post('nama_subkriteria');
        $id_kriteria = $this->input->post('id_kriteria');
        $passing_grade = $this->input->post('passing_grade');

        $ambil_bobot = $this->db->get_where('tb_kriteria', ['id_kriteria' => $id_kriteria])->row_array();

        $data = [
            'kriteria_id' => $id_kriteria,
            'nama_subkriteria' => $nama_subkriteria,
            'passing_grade' => $passing_grade,
            'bobot_subkriteria' => $ambil_bobot['bobot_kriteria'],
        ];

        $this->db->insert('tb_subkriteria', $data);
    }

    public function ubah_subkriteria()
    {
        $id_subkriteria = $this->input->post('id_subkriteria', true);
        $nama_subkriteria = $this->input->post('nama_subkriteria', true);
        $passing_grade = $this->input->post('passing_grade', true);

        $data = [
            'nama_subkriteria' => $nama_subkriteria,
            'passing_grade' => $passing_grade
        ];

        $this->db->update('tb_subkriteria', $data, ['id_subkriteria' => $id_subkriteria]);
    }

    
}
