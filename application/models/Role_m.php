<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_m extends CI_Model
{
    public function tampil_role()
    {
        return $this->db->get('tb_user_role')->result_array();
    }
}