<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekomendasi_m extends CI_Model
{
    public function tampil_rekomendasi()
    {
        $this->db->select('*');
        $this->db->from('tb_periode_penilaian pp');
        $this->db->order_by('tgl_penilaian', 'desc');
        return $this->db->get()->result_array();
    }
}